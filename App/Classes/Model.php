<?php

namespace App\Classes;
/**
 * Class Model
 * @package App\Classes
 */
abstract class Model
{
    const TABLE = '';

    public static function findAll()
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
        return $res;
    }

    public static function findById($id)
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            static::class,
            [':id' => $id]
        );
        if (!empty($res)) {
            return $res[0];
        }
        return null;
    }

    public static function findByLogin($login)
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE login=:login',
            static::class,
            [':login' => $login]
        );
        if (count($res) === 1) {
            return $res[0];
        }
        return null;
    }

    /**
     * @return void
     */
    public function update()
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
        $values[':id'] = (int)$this->id;
        $sql = 'UPDATE `' . static::TABLE . '` SET ' . implode(', ', $places) . ' WHERE `id` = :id';
        $db = Db::instance();
        $db->execute($sql, $values);
    }

    /**
     * @return void
     */
    public function insert()
    {
        $columns = [];
        $values = [];

        foreach ($this as $k => $v) {
            if ('id' == $k || is_null($this->$k)) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }
        $sql = 'INSERT INTO ' . static::TABLE . '(' . implode(',', $columns) . ') VALUES (' . implode(',', array_keys($values)) . ')';
        $db = Db::instance();
        $db->execute($sql, $values);
    }

    /**
     * @return void
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE user_id= :user_id';
        $db = Db::instance();
        $db->execute($sql, [':user_id' => $this->user_id]);
    }

}