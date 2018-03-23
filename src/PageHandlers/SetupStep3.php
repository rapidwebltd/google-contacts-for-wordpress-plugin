<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use Jenssegers\Blade\Blade;
use RapidWeb\GoogleOAuth2Handler\GoogleOAuth2Handler;
use RapidWeb\GooglePeopleAPI\GooglePeople;
use RapidWeb\GooglePeopleAPI\Contact;
use RapidWeb\GoogleContactsForWordPress\WordPressToGoogleContacts;


class SetupStep3
{
    public function get()
    {
        $blade = new Blade(Constants::VIEWS_DIR, Constants::VIEWS_CACHE_DIR);

        echo $blade->make('setup-step-3');
    }

    public function post()
    {
        switch($_POST['action']) {

            case 'gcfw_bulk_create_contacts':
                
                $wordPressToGoogleContacts = new WordPressToGoogleContacts();

                $users = get_users();

                foreach($users as $user) {
                    $wordPressToGoogleContacts->createUpdateContact($user->ID);
                }

                break;
        }

        wp_redirect(admin_url('options-general.php?page=gcfw_dashboard'));
    }
}