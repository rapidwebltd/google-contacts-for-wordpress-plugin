<?php

namespace RapidWeb\GoogleContactsForWordPress;

abstract class Constants
{
    const TEXT_DOMAIN = 'google-contacts-for-wordpress';
    const VIEWS_DIR = __DIR__.'/views';
    const VIEWS_CACHE_DIR = __DIR__.'/../cache-views';
    const OPTION_CLIENT_ID = 'gcfw_client_id';
    const OPTION_CLIENT_SECRET = 'gcfw_client_secret';
    const OPTION_REFRESH_TOKEN = 'gcfw_refresh_token';
    const USER_META_GOOGLE_CONTACT_RESOURCE_NAME = 'gcfw_google_contact_resource_name';
    const USER_META_GOOGLE_CONTACT_SYNCED_AT = 'gcfw_google_contact_synced_at';
}
