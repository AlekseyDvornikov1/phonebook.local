<?php

namespace App\Models;

use App\Classes\Db;
use App\Classes\Model;

class User extends Model
{
    const TABLE = 'users';

    public $id;
    public $first_name;
    public $last_name;
    protected $login;
    protected $passwd;
    public $publish_contact;

    public function checkUser($login,$password)
    {
        $this->login = $login;
        $this->passwd = md5($password);
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . self::TABLE .' WHERE login = :login AND passwd = :password';
        $res = $db->query($sql,self::class, [
            ':login' => $this->login,
            ':password' => $this->passwd,
            ]);
        if(!empty($res)) {
            $_SESSION['user'] = $res[0]->login;
            $_SESSION['user_id'] = $res[0]->id;
            header("Location: /home");
        } else {
            return false;
        }
        return true;
    }

}