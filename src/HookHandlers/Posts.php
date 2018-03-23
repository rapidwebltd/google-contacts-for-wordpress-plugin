<?php

namespace RapidWeb\GoogleContactsForWordPress\HookHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\SetupStep1;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\SetupStep2;
use RapidWeb\GoogleContactsForWordPress\PageHandlers\SetupStep3;

class Posts
{
    public function __construct()
    {
        add_action('admin_post_gcfw_update_client_id_and_secret', [$this, 'setupStep1']);
        add_action('admin_post_gcfw_update_refresh_token', [$this, 'setupStep2']);
        add_action('admin_post_gcfw_bulk_create_contacts', [$this, 'setupStep3']);
    }

    public function setupStep1()
    {
        (new SetupStep1)->post();
    }

    public function setupStep2()
    {
        (new SetupStep2)->post();
    }

    public function setupStep3()
    {
        (new SetupStep3)->post();
    }
}
