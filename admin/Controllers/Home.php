<?php

class Home {

    public $template;

    function __construct() {
        $this->template = new AdminTemplate();
    }

    function indexAction() {
        $this->template->render('Home');
    }

   
    function logoutAction() {
        unset($_SESSION['user_id']);
        $this->template->render('Home');
    }

}
