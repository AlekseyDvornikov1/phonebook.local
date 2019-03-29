<?php

namespace App\Classes;

use App\Singleton;

class Db
{
    use Singleton;

    public $dbh;

    /**
     * Db constructor.
     */
    protected function __construct()
    {
        $this->dbh = new \PDO('mysql:host=127.0.0.1;dbname=phonebook','root','');
    }


    /**
     * @param $sql
     * @param array $data
     * @return bool
     */
    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        return $res;
    }

    /**
     * @param $sql
     * @param $class
     * @param array $data
     * @return array
     */
    public function query($sql, $class, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }



}