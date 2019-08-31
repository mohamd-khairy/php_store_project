<?php

class SellProductModel extends basictable {

    static protected $table_name = "sell_product";
    public $primary_key = "sp_id";
    public $fields = array('sp_mony', 'pro_id', 'sp_num', 'sp_datetime');
    public $sp_id;
    public $pro_id;
    public $sp_num;
    public $sp_mony;
    public $sp_datetime;

    static public function get_charge_sells() {

        return DatabaseManager::getInstance()->dbh->query("select * from sell_charge ")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_product_sells() {
        return DatabaseManager::getInstance()->dbh->query("select * from sell_product,product where product.pro_id=sell_product.pro_id ORDER BY sp_id")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_card_sells() {

        return DatabaseManager::getInstance()->dbh->query("select * from sell_card ")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_id($id) {
    return DatabaseManager::getInstance()->dbh->query("select * from sell_product where pro_id=$id")->fetchAll(PDO::FETCH_ASSOC);
    }
}
