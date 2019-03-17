<?php

namespace Core\DB;


class DbConnect
{
    /**
     * @var \PDO
     */
    private $dbh;

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $con = require_once CONFIG_DIR . '/db.php';

        $options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try{

            $this->dbh = new \PDO($con['dsn'], $con['user'], $con['password'], $options);
            if(!$this->dbh)
            {
                throw new \PDOException();
            }
        }
        catch(\PDOException $pdoError){
            throw new Errors('Соединение с базой даннных не возможно', (int)$pdoError->getCode( ));
        }
        return $this->dbh;
    }

    /**
     * @param $sql
     * @param string $class
     * @param array $params
     * @return array
     */
    public function query($sql, $class = 'stdClass', $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if(false !== $res){
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }

    /**
     * @return \PDO
     */
    public function getDbh() {
        return $this->dbh;
    }
}
