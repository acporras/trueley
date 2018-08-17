<?php
class MY_security extends CI_Security {

    public function __construct()
    {
        parent::__construct();
    }

    public function csrf_show_error()
    {
        // show_error('The action you have requested is not allowed.');  // default code

        // force redirect to the csrf_redirect function
        // this gives the user a useful message instructing them to login again
        // while the CSRF cookie is also refreshed to allow a new login
        header('Location: /login/logout', TRUE, 302);
    }
}