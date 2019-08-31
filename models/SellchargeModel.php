<?php

class SellchargeModel extends basictable {

    static protected $table_name = "sell_charge";
    public $primary_key = "sch_id";
    public $fields = array('sch_mobile', 'sch_net', 'sch_value', 'sch_mony', 'sch_datetime');
    public $sch_id;
    public $sch_net;
    public $sch_value;
    public $sch_mony;
    public $sch_datetime;
    public $sch_mobile;

    static public function get_sell_mony_charge_vodafone() {
        return DatabaseManager::getInstance()->dbh->query("select sum(sch_mony) as sum from sell_charge where sch_net=1")->fetchAll()[0];
    }

    static public function get_sell_mony_charge_etisalat() {
        return DatabaseManager::getInstance()->dbh->query("select sum(sch_mony) as sum from sell_charge where sch_net=3")->fetchAll()[0];
    }

    static public function get_sell_mony_charge_mobinil() {
        return DatabaseManager::getInstance()->dbh->query("select sum(sch_mony) as sum from sell_charge where sch_net=2")->fetchAll()[0];
    }

     static public function value_in_or_not($net) {
        return DatabaseManager::getInstance()->dbh->query("select * from sell_charge where sch_net=".$net)->fetchAll(PDO::FETCH_ASSOC);
    }
}
