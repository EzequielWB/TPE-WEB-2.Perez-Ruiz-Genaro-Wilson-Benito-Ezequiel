<?php

    function sessionAuthMiddleware($response) {
        session_start();
        $user = new stdClass(); //std permite poner distintos items
        if (isset($_SESSION['ID_USER'])) {
            $response->user = new stdClass();
            $response->user->id = $_SESSION['ID_USER']; 
            $response->user->usuario = $_SESSION['usuario_USER'];
            return true;
        } else {
            header ('Location: '. BASE_URL . 'showLogin');
            return false; //returns para verificar la sesion
        }
    }