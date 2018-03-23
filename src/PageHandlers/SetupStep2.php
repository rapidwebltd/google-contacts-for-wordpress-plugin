<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use Jenssegers\Blade\Blade;
use RapidWeb\GoogleOAuth2Handler\GoogleOAuth2Handler;


class SetupStep2
{
    private function getGoogleOAuth2Handler()
    {
        $clientId = get_option(Constants::OPTION_CLIENT_ID);
        $clientSecret = get_option(Constants::OPTION_CLIENT_SECRET);

        $scopes = [
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/contacts',
            'https://www.googleapis.com/auth/contacts.readonly',
        ];

        return new GoogleOAuth2Handler($clientId, $clientSecret, $scopes);
    }

    public function get()
    {
        $googleOAuth2Handler = $this->getGoogleOAuth2Handler();

        $blade = new Blade(Constants::VIEWS_DIR, Constants::VIEWS_CACHE_DIR);

        echo $blade->make('setup-step-2', ['authUrl' => $googleOAuth2Handler->authUrl]);
    }

    public function post()
    {
        switch($_POST['action']) {

            case 'gcfw_update_refresh_token':
            
                $googleOAuth2Handler = $this->getGoogleOAuth2Handler();
                $refreshToken = $googleOAuth2Handler->getRefreshToken($_POST['auth_code']);

                update_option(Constants::OPTION_REFRESH_TOKEN, trim($refreshToken));
                break;
        }

        wp_redirect(admin_url('options-general.php?page=gcfw_setup_step_3'));
    }
}