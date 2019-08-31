<?php

class Model extends BasicTable {

    static protected $table_name = "--";
    public $primary_key = "--id";
    public $fields = array('--');
    public $_;
 
    static public function getAllcomment() {
        return DatabaseManager::getInstance()->dbh->query("select * from comment,user,post where comment.user_id=user.user_id and comment.post_id=post.post_id ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countcomment($user_id,$post_id) {
        
        $m= DatabaseManager::getInstance()->dbh->query("select count(comment_content) as count from " . static::$table_name . " where post_id=$post_id")->fetchAll(PDO::FETCH_CLASS, get_called_class());
        return $m[0]->count;
        
    }
   

}
