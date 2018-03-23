<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use Jenssegers\Blade\Blade;
use RapidWeb\GoogleOAuth2Handler\GoogleOAuth2Handler;
use RapidWeb\GooglePeopleAPI\GooglePeople;
use RapidWeb\GooglePeopleAPI\Contact;


class SetupStep3
{
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

    public function get()
    {
        $blade = new Blade(Constants::VIEWS_DIR, Constants::VIEWS_CACHE_DIR);

        echo $blade->make('setup-step-3');
    }

    public function post()
    {
        switch($_POST['action']) {

            case 'gcfw_bulk_create_contacts':
                
                $googleContactsOAuth2Handler = $this->getGoogleOAuth2Handler();

                $people = new GooglePeople($googleContactsOAuth2Handler);

                $users = get_users();

                foreach($users as $user) {
                    
                    $googleContactResourceName = get_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, true);

                    if ($googleContactResourceName) {

                        try {
                            // Try to get existing Google Contact based on the resource name we have stored.
                            $contact = $people->get($googleContactResourceName);
                        } catch (\Exception $e) {

                            $details = json_decode($e->getMessage());

                            // If there is no Google Contact with the resource name we have stored,
                            // assume it needs to be recreated.
                            if (isset($details->error) && isset($details->error->code) && $details->error->code == 404) {
                                update_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, '');
                                $contact = new Contact($people);
                            } else {
                                throw $e;
                            }
                        }
                    } else {
                        // If we have no resource name, create a new contact.
                        $contact = new Contact($people);
                    }

                    $nameParts = explode(' ', $user->data->display_name);

                    if (!isset($contact->names)) {
                        $contact->names = [];
                        $contact->names[0] = new \stdClass();
                    }
                    $contact->names[0]->displayName = $user->data->display_name;
                    $contact->names[0]->givenName = reset($nameParts);
                    $contact->names[0]->familyName = end($nameParts);

                    if (!isset($contact->emailAddresses)) {
                        $contact->emailAddresses = [];
                        $contact->emailAddresses[0] = new \stdClass();
                    }
                    $contact->emailAddresses[0]->value = $user->data->user_email;
                    
                    $contact->save();

                    update_user_meta($user->ID, Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME, $contact->resourceName);

                }

                break;
        }

        wp_redirect(admin_url('options-general.php?page=gcfw_dashboard'));
    }
}