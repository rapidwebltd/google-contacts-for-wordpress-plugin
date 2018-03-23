<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use Jenssegers\Blade\Blade;


class Dashboard
{
    public function get()
    {
        $clientId = get_option(Constants::OPTION_CLIENT_ID);
        $clientSecret = get_option(Constants::OPTION_CLIENT_SECRET);
        $refreshToken = get_option(Constants::OPTION_REFRESH_TOKEN);

        $setupComplete = true;

        if (!$clientId || !$clientSecret || !$refreshToken) {
            $setupComplete = false;
        }

        $blade = new Blade(Constants::VIEWS_DIR, Constants::VIEWS_CACHE_DIR);

        echo $blade->make('dashboard', [
            'setupComplete' => $setupComplete, 
            'users' => get_users(), 
            'USER_META_GOOGLE_CONTACT_RESOURCE_NAME' => Constants::USER_META_GOOGLE_CONTACT_RESOURCE_NAME
            ]);
    }

    public function post()
    {
        
    }
}