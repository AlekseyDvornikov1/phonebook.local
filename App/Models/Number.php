<?php

namespace App\Models;

use App\Classes\Db;
use App\Classes\Model;
use PDO;

class Number extends Model
{
    const TABLE = 'numbers';

    public $id;
    public $number;
    public $user_id;
    public $publish;

    /**
     * @param $number
     * @return bool
     */
    public function isNew($number)
    {
        $db = Db::instance();
        $stmt = $db->dbh->prepare('SELECT EXISTS(SELECT 1 FROM numbers WHERE number =:number LIMIT 1)');
        $stmt->bindValue(':number', $number, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_NUM)[0]) {
            return false;
        }
        return true;
    }

    /**
     * @return void
     */
    public function updateNumber()
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
        $values[':number'] = $this->number;
        $sql = 'UPDATE `' . static::TABLE . '` SET ' . implode(', ', $places) . ' WHERE `number` = :number';
        $db = Db::instance();
        $db->execute($sql, $values);
    }
}