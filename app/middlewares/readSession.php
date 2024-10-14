<?php

    function() {
        session_star();
        $user = new stdClass(); //std permite poner distintos items
        if (isset($_SESSION['ID_USER'])) {
            $user = new stdClass();
            $user->id = $_SESSION['ID_USER'];
            $user->usuario = $_SESSION['USUARIO']
            return $user;
        }
    }