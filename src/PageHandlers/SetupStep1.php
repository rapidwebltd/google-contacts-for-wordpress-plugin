<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use Jenssegers\Blade\Blade;


class SetupStep1
{
    public function get()
    {
        $clientId = get_option(Constants::OPTION_CLIENT_ID);
        $clientSecret = get_option(Constants::OPTION_CLIENT_SECRET);

        $blade = new Blade(Constants::VIEWS_DIR, Constants::VIEWS_CACHE_DIR);

        echo $blade->make('setup-step-1', [
            'clientId' => $clientId, 
            'clientSecret' => $clientSecret,
            'td' => Constants::TEXT_DOMAIN
            ]);
    }

    public function post()
    {
        switch($_POST['action']) {

            case 'gcfw_update_client_id_and_secret':
                update_option(Constants::OPTION_CLIENT_ID, trim($_POST['client_id']));
                update_option(Constants::OPTION_CLIENT_SECRET, trim($_POST['client_secret']));
                break;
        }

        wp_redirect(admin_url('options-general.php?page=gcfw_setup_step_2'));
    }
}