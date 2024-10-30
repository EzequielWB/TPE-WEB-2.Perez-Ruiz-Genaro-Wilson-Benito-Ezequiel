<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';

class AuthController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    function showLogin() {
        // Muestro el formulario de login
        return $this->view->showLogin();
    }

    function login() {
        if (!isset($_POST['usuario']) || empty($_POST['usuario'])) { //comprueba que haya user
            return $this->view->showLogin('Falta completar el nombre de usuario'); //igual es innecesario porque el mismo boton te salta la advertencia
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
    
        $userFromDB = $this->model->getUser($usuario);

        // password: 123456
        // $userFromDB->password: $2y$10$xQop0wF1YJ/dKhZcWDqHceUM96S04u73zGeJtU80a1GmM.H5H0EHC
        if($userFromDB && password_verify($password, $userFromDB->password)){ //password_verify es algo ya de php para verificar contraseñas
            // Guardo en la sesión el ID del usuario
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['usuario_USER'] = $userFromDB->usuario;
    
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }

    function logout() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
}
