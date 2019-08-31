<?php

class CardModel extends basictable {

    static protected $table_name = "card";
    public $primary_key = "ca_id";
    public $fields = array('ca_net', 'ca_value', 'ca_cost', 'ca_price', 'ca_num', 'ca_datetime');
    public $ca_id;
    public $ca_net;
    public $ca_value;
    public $ca_num;
    public $ca_cost;
    public $ca_price;
    public $ca_datetime;

    
    static public function getAllDataby_id($id) {
    return DatabaseManager::getInstance()->dbh->query("select * from card where ca_id=$id")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updatecard($primary_key, $val) {
        return $this->dbh->exec("update card set " . $this->getFieldsAsString() . " where ca_net=$primary_key and ca_value=$val");
    }

    static public function value_in_or_not($net, $value) {
        return DatabaseManager::getInstance()->dbh->query("select * from card where ca_value=" . $value . " and ca_net=" . $net)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_cards($net) {
        return DatabaseManager::getInstance()->dbh->query("select * from card where ca_net=" . $net)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_card_vodafone() {
        return DatabaseManager::getInstance()->dbh->query("select * from card where ca_net=1")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_card_etisalat() {
        return DatabaseManager::getInstance()->dbh->query("select * from card where ca_net=3")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_card_mobinil() {
        return DatabaseManager::getInstance()->dbh->query("select * from card where ca_net=2")->fetchAll(PDO::FETCH_ASSOC);
    }

}
