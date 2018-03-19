<?php

namespace RapidWeb\GoogleContactsForWordPress\HookHandlers;

use RapidWeb\GoogleContactsForWordPress\Constants;


class Languages
{
    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'loadPluginTextDomain']);
    }

    public function loadPluginTextDomain()
    {
        load_plugin_textdomain(Constants::TEXT_DOMAIN, false, __DIR__.'/../../languages/' );
    }
}
