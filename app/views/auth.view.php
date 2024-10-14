<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require './templates/layout/form_login.phtml';
    }

}