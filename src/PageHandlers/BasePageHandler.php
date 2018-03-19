<?php

namespace RapidWeb\GoogleContactsForWordPress\PageHandlers;

class BasePageHandler
{
    public function handleRequest()
    {
        if ($_POST) {
            return $this->post();
        }

        return $this->get();
    }

}