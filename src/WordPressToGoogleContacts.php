<?php

namespace RapidWeb\GoogleContactsForWordPress;

use RapidWeb\GoogleOAuth2Handler\GoogleOAuth2Handler;
use RapidWeb\GooglePeopleAPI\Contact;
use RapidWeb\GooglePeopleAPI\GooglePeople;

class WordPressToGoogleContacts
{
    private $people;

    public function __construct()
    {
        $this->people = new GooglePeople($this->getGoogleOAuth2Handler());
    }

    private function getGoogleOAuth2Handler()
    {
        $clientId = get_option(Constants::OPTION_CLIENT_ID);
        $clientSecret = get_option(Constants::OPTION_CLIENT_SECRET);
        $refreshToken = get_option(Constants::OPTION_REFRESH_TOKEN);

        $scopes = [
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/contacts',
            'https://www.googleapis.com/auth/contacts.readonly',
        ];

        return new GoogleOAuth2Handler($clientId, $clientSecret, $scopes, $refreshToken);
    }

    public function createUpdateContact($id)
    {
        $user = get_user_by('id', $id);

        $googleContactResourceName = get_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, true);

        if ($googleContactResourceName) {
            try {
                // Try to get existing Google Contact based on the resource name we have stored.
                $contact = $this->people->get($googleContactResourceName);
            } catch (\Exception $e) {
                $details = json_decode($e->getMessage());

                // If there is no Google Contact with the resource name we have stored,
                // assume it needs to be recreated.
                if (isset($details->error) && isset($details->error->code) && $details->error->code == 404) {
                    update_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, '');
                    $contact = new Contact($this->people);
                } else {
                    throw $e;
                }
            }
        } else {
            // If we have no resource name, create a new contact.
            $contact = new Contact($this->people);
        }

        if (!isset($contact->names)) {
            $contact->names = [];
            $contact->names[0] = new \stdClass();
        }
        $contact->names[0]->displayName = $user->data->display_name;
        $contact->names[0]->givenName = get_user_meta($user->ID, 'first_name', true);
        $contact->names[0]->familyName = get_user_meta($user->ID, 'last_name', true);

        if (!isset($contact->emailAddresses)) {
            $contact->emailAddresses = [];
            $contact->emailAddresses[0] = new \stdClass();
        }
        $contact->emailAddresses[0]->value = $user->data->user_email;

        $contact->save();

        update_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, $contact->resourceName);

        return $contact;
    }

    public function deleteContact($id)
    {
        $user = get_user_by('id', $id);

        $googleContactResourceName = get_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, true);

        if ($googleContactResourceName) {
            try {
                // Try to get existing Google Contact based on the resource name we have stored.
                $contact = $this->people->get($googleContactResourceName);
            } catch (\Exception $e) {
                $details = json_decode($e->getMessage());

                // If there is no Google Contact with the resource name we have stored,
                // then it must have already been deleted, so do nothing.
                if (isset($details->error) && isset($details->error->code) && $details->error->code == 404) {
                    return;
                } else {
                    throw $e;
                }
            }
        }

        $contact->delete();
    }
}
