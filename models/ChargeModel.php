<?php

class ChargeModel extends basictable {

    static protected $table_name = "charge";
    public $primary_key = "ch_id";
    public $fields = array('ch_net','ch_charge','ch_mony','ch_datetime');
    public $ch_id;
    public $ch_net;
    public $ch_charge;
    public $ch_mony;
    public $ch_datetime;
   
     public function updatecharge($primary_key) {
        return $this->dbh->exec("update charge set " . $this->getFieldsAsString() . " where ch_net=".$primary_key);
    }
    static public function value_in_or_not($net) {
        return DatabaseManager::getInstance()->dbh->query("select * from charge where  ch_net=".$net)->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function get_charge_vodafone(){
        return DatabaseManager::getInstance()->dbh->query("select * from charge where ch_net=1")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function get_charge_etisalat(){
        return DatabaseManager::getInstance()->dbh->query("select * from charge where ch_net=3")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function get_charge_mobinil(){
        return DatabaseManager::getInstance()->dbh->query("select * from charge where ch_net=2")->fetchAll(PDO::FETCH_ASSOC);
    }
}
