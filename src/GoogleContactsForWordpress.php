<?php

namespace RapidWeb\GoogleContactsForWordPress;

use RapidWeb\GoogleContactsForWordPress\HookHandlers\Languages;
use RapidWeb\GoogleContactsForWordPress\HookHandlers\Menu;

class GoogleContactsForWordpress
{

    public function __construct()
    {
        new Languages;
        new Menu;
    }

}