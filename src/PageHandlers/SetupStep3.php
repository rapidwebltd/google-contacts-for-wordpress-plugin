<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

use Jenssegers\Blade\Blade;
use RapidWeb\GoogleContactsForWordPress\Constants;
use RapidWeb\GoogleContactsForWordPress\WordPressToGoogleContacts;

class SetupStep3
{
    public function get()
    {
        $blade = new Blade(Constants::VIEWS_DIR, Constants::VIEWS_CACHE_DIR);

        echo $blade->make('setup-step-3', [
            'td' => Constants::TEXT_DOMAIN,
        ]);
    }

    public function post()
    {
        switch ($_POST['action']) {

            case 'gcfw_bulk_create_contacts':

                $wordPressToGoogleContacts = new WordPressToGoogleContacts();

                $users = get_users();

                foreach ($users as $user) {
                    $wordPressToGoogleContacts->createUpdateContact($user->ID);
                }

                break;
        }

        wp_redirect(admin_url('options-general.php?page=gcfw_dashboard'));
    }
}
