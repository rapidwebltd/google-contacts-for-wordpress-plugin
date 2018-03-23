<?php

namespace RapidWeb\GoogleContactsForWordPress;

use RapidWeb\GoogleContactsForWordPress\HookHandlers\Languages;
use RapidWeb\GoogleContactsForWordPress\HookHandlers\Menu;
use RapidWeb\GoogleContactsForWordPress\HookHandlers\Posts;

class GoogleContactsForWordpress
{

    public function __construct()
    {
        new Languages;
        new Menu;
        new Posts;
    }

}