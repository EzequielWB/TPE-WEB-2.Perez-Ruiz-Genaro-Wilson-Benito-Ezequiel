<?php

class AuthView {
    private $user = null;

    function showLogin($error = '') {
        require './templates/layout/form_login.phtml';
    }

}