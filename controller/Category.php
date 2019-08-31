<?php

class Category {

    private $template;
    private $cat;

    public function __construct() {
        $this->template = new Template();
        $this->cat = new CatModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function savecatAction() {
        $this->cat->cat_name = $_POST['cat_name'];
        if ($this->cat->insert() >= 1) {
            echo 'true';
            die();
        }
    }

}
