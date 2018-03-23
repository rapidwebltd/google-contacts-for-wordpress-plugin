<?php

namespace RapidWeb\GoogleContactsForWordPress\HookHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\Dashboard;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\SetupStep1;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\SetupStep2;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\SetupStep3;

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

        add_submenu_page(null, __('Setup 1', Constants::TEXT_DOMAIN), __('Setup 1', Constants::TEXT_DOMAIN), 'manage_options', 'gcfw_setup_step_1', [$this, 'setupStep1']);
        add_submenu_page(null, __('Setup 2', Constants::TEXT_DOMAIN), __('Setup 2', Constants::TEXT_DOMAIN), 'manage_options', 'gcfw_setup_step_2', [$this, 'setupStep2']);
        add_submenu_page(null, __('Setup 3', Constants::TEXT_DOMAIN), __('Setup 3', Constants::TEXT_DOMAIN), 'manage_options', 'gcfw_setup_step_3', [$this, 'setupStep3']);
    }

    public function dashboard()
    {
        (new Dashboard)->get();
    }

    public function setupStep1()
    {
        (new SetupStep1)->get();
    }

    public function setupStep2()
    {
        (new SetupStep2)->get();
    }

    public function setupStep3()
    {
        (new SetupStep3)->get();
    }
}
