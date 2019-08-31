<?php

class HomePage {

    private $template;

    public function __construct() {
        $this->template = new Template();
        $this->valid = new Validation();
    }

    function indexAction() {

        if (isset($_SESSION['go']) && $_SESSION['go'] == 'go') {
            $this->template->render("home");
        }  else {
            $this->template->render_ajax('welcome');
        }
    }

    function searchAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $s_name = $_POST['s_name'];
            $_SESSION['data'] = ProductModel::search("pro_name", $s_name);
            ;
            if (empty($result)) {
                echo 'empty';
                die();
            }
        }
        $this->template->render("home");
    }

    function gard_chargeAction() {

        $this->template->render("sell/gard_charge");
    }

    function gard_cardAction() {

        $this->template->render("sell/gard_card");
    }

    function gardAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $_SESSION['date_day'] = $_POST['yd'] . "-" . $_POST['md'] . "-" . $_POST['dd'];
            echo $_SESSION['pro'] = $_POST['pro'];
            die();
        }
        $this->template->render("sell/gard");
    }

    function gard_2dayAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $_SESSION['date_2day1'] = $_POST['yb'] . "-" . $_POST['mb'] . "-" . $_POST['db'];
            $_SESSION['date_2day2'] = $_POST['yn'] . "-" . $_POST['mn'] . "-" . $_POST['dn'];
            echo $_SESSION['pro'] = $_POST['pro'];
            die();
        }
        $this->template->render("sell/gard");
    }

    function get_dateAction() {
        $_SESSION['date'] = $_POST['y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
        echo 0;
    }

    function all_sellsAction() {
        $this->template->render("sell/all");
    }

    function loginAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            if ($_POST['pass'] == '12345') {
                $_SESSION['go'] = 'go';
                echo 'yes';
                die();
            } else {
                echo 'no';
                die();
            }
        }
    }

    function logoutAction() {
        session_destroy();
        unset($_SESSION['go']);
        $this->template->render_ajax("welcome");
    }

}
