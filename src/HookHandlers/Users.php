<?php

namespace RapidWeb\GoogleContactsForWordPress\HookHandlers;

use RapidWeb\GoogleContactsForWordPress\WordPressToGoogleContacts;


class Users
{
    public function __construct()
    {
        add_action('profile_update', [$this, 'profileUpdate'], 10, 2);
        add_action('user_register', [$this, 'userRegister'], 10, 1);
        add_action('delete_user', [$this, 'deleteUser'], 10, 1);
    }

    public function profileUpdate($id, $oldData)
    {
        (new WordPressToGoogleContacts())->createUpdateContact($id);
    }

    public function userRegister($id)
    {
        (new WordPressToGoogleContacts())->createUpdateContact($id);
    }

    public function deleteUser($id)
    {
        (new WordPressToGoogleContacts())->deleteContact($id);
    }

}
