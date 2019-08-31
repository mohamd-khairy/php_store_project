<?php

class Product {

    private $template;
    private $pro;
    private $sp;

    public function __construct() {
        $this->template = new Template();
        $this->pro = new ProductModel();
        $this->sp = new SellProductModel();
    }

    function indexAction() {

        $this->template->render("home");
    }

    function showAction() {
        $this->template->render("product/add");
    }

    function saveproAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $this->pro->cat_id = $_POST['cat_id'];
            $this->pro->pro_cost = $_POST['pro_cost'];
            $this->pro->pro_datetime = date(DateTime::ATOM);
            $this->pro->pro_name = $_POST['pro_name'];
            $this->pro->pro_price = $_POST['pro_price'];
            $this->pro->pro_num = $_POST['pro_num'];
            if ($this->pro->insert() >= 1) {
                echo 'true';
                die();
            }
        }
    }

    function getcatproductAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $products = ProductModel::getAllDataby_cat_id($_POST['cat_id']);
            $_SESSION['product'] = $products;
            $_SESSION['cat_id'] = $_POST['cat_id'];
        }
    }

    
    
     function checkproAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $currentpro = ProductModel::getAllDataby_id ($_POST['pro_id']);
            if (!empty($currentpro)) {
                $currentpro = $currentpro[0];
            }
            if ($_POST['sp_num'] > $currentpro['pro_num']) {
                echo ' عدد الكروت المتاحه  '.$currentpro['pro_num'];
                die();
            } else {
                echo 'true';
                die();
            }
        }
    }
    
    
    function sellAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $products = ProductModel::getAllDataby_id($_POST['pro_id']);
            if (!empty($products)) {
                $p = $products[0];
            }
            $this->sp->pro_id = $_POST['pro_id'];
            $this->sp->sp_datetime = date(DateTime::ATOM);
            $this->sp->sp_mony = $_POST['sp_mony'];
            $this->sp->sp_num = $_POST['sp_num'];
            if ($this->sp->insert() >= 1) {
                $this->pro->pro_id = $p['pro_id'];
                $this->pro->cat_id = $p['cat_id'];
                $this->pro->pro_cost = $p['pro_cost'];
                $this->pro->pro_datetime = $p['pro_datetime'];
                $this->pro->pro_name = $p['pro_name'];
                $this->pro->pro_price = $p['pro_price'];
                $this->pro->pro_num = $p['pro_num'] - $_POST['sp_num'];
                if ($this->pro->update($p['pro_id'])) {
                    echo 'true';
                    die();
                }
            }
        }
        $this->template->render('product/sell_product');
    }

}
