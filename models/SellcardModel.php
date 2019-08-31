<?php

class SellcardModel extends basictable {

    static protected $table_name = "sell_card";
    public $primary_key = "sc_id";
    public $fields = array('sc_net', 'sc_value', 'sc_mony', 'sc_num', 'sc_datetime');
    public $sc_id;
    public $sc_net;
    public $sc_value;
    public $sc_num;
    public $sc_mony;
    public $sc_datetime;

    static public function get_sell_mony_card_vodafone() {
        return DatabaseManager::getInstance()->dbh->query("select sum(sc_mony) as sum from sell_card where sc_net=1")->fetchAll()[0];
    }

    static public function get_sell_mony_card_etisalat() {
        return DatabaseManager::getInstance()->dbh->query("select sum(sc_mony) as sum from sell_card where sc_net=3")->fetchAll()[0];
    }

    static public function get_sell_mony_card_mobinil() {
        return DatabaseManager::getInstance()->dbh->query("select sum(sc_mony) as sum from sell_card where sc_net=2")->fetchAll()[0];
    }
      static public function value_in_or_not($net,$value) {
        return DatabaseManager::getInstance()->dbh->query("select * from sell_card where sc_value=".$value." and sc_net=".$net)->fetchAll(PDO::FETCH_ASSOC);
    }

}
