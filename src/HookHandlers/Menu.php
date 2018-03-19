<?php

namespace RapidWeb\GoogleContactsForWordPress\HookHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;

class Menu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'buildMenu']);
    }

    public function buildMenu()
    {
        add_options_page( __('Google Contacts for WordPress', Constants::TEXT_DOMAIN), 
                      __('Google Contacts for WordPress', Constants::TEXT_DOMAIN),
                      'manage_options', 
                      'gcfw_dashboard', [$this, 'dashboard']);
    }

    public function dashboard()
    {
        echo "hello!";
    }
}
