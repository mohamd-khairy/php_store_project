<?php

class CatModel extends basictable {

    static protected $table_name = "category";
    public $primary_key = "cat_id";
    public $fields = array('cat_name');
    public $cat_id;
    public $cat_name;

}
