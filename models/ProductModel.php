<?php

class ProductModel extends basictable {

    static protected $table_name = "product";
    public $primary_key = "pro_id";
    public $fields = array('cat_id', 'pro_name', 'pro_price', 'pro_cost', 'pro_num','pro_datetime');
    public $cat_id;
    public $pro_name;
    public $pro_price;
    public $pro_cost;
    public $pro_num;
    public $pro_datetime;
    public $pro_id;
    
    static public function getAllDataby_cat_id($cat_id) {
    return DatabaseManager::getInstance()->dbh->query("select * from product where  cat_id=". $cat_id)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    static public function getAllDataby_id($id) {
    return DatabaseManager::getInstance()->dbh->query("select * from product where pro_id=$id")->fetchAll(PDO::FETCH_ASSOC);
    }
   
}