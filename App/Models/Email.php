<?php

namespace App\Models;

use App\Classes\Db;
use App\Classes\Model;
use PDO;

class Email extends Model
{
    const TABLE = 'emails';

    public $id;
    public $email;
    public $user_id;
    public $publish;

    public function isNew($email)
    {
        $db = Db::instance();
        $stmt = $db->dbh->prepare('SELECT EXISTS(SELECT 1 FROM emails WHERE email =:email LIMIT 1)');
        $stmt->bindValue(':email', $email, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_NUM)[0]) {
            return false;
        }
        return true;
    }

    public function updateEmail()
    {
        $values = [];
        $places = [];
        foreach ($this as $k => $v) {
            if ('id' == $k || empty($this->$k)) {
                continue;
            }
            $values[':' . $k] = $v;
            $places[] = '`' . $k . '` = :' . $k;
        }
        $values[':email'] = $this->email;
        $sql = 'UPDATE `' . static::TABLE . '` SET ' . implode(', ', $places) . ' WHERE `email` = :email';
        $db = Db::instance();
        $db->execute($sql, $values);
    }

}