<?php

namespace Core\Model;

use Core\Application\App;

class AbstractModel
{
    const TABLE = '';

    protected $db;

    protected $fields = [];

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = App::getInstance()->get('db');
        $this->fieldsInit();
    }

    protected function fieldsInit()
    {
        $sql = "SHOW COLUMNS FROM " . static::TABLE;
        $res = $this->db->query($sql);

        foreach($res as $item) {
            $this->fields[] = $item->Field;
        }
    }

    /**
     * @param array $data
     */
    public function load(array $data)
    {
        foreach($data as $k => $v)
        {
            $func = $this->funcHandler($k);
            if(method_exists($this, $func)) {
                $this->{$func}($v);
            }
        }
    }

    /**
     * @param $str
     * @param string $action
     * @return string
     */
    protected function funcHandler($str, $action = 'set')
    {
        $setter = $action;

        if (strstr($str, '_')) {
            $arr_tmp = explode('_', $str);
            foreach($arr_tmp as $key => $value) {
                $setter .= ucfirst($value);
            }
            return $setter;
        }
        return $setter . ucfirst($str);

    }

    /**
     * @param $key
     * @return |null
     */
    public function get($key)
    {
        $func = $this->funcHandler($key, 'get');
        if(method_exists($this, $func)) {
            return $this->{$func}();
        }
        return null;
    }

    /**
     * @param $key
     * @param $val
     */
    public function set($key, $val)
    {
        $func = $this->funcHandler($key);
        if(method_exists($this, $func)) {
            $this->{$func}($val);
        }
    }

    /**
     * @return mixed
     */
    public function save()
    {
        if(isset($this->id)) {
            return $this->update();
        }else {
            return $this->insert();
        }
    }

    /**
     * @return mixed
     */
    private function insert()
    {
        $data = [];
        $param = [];

        foreach($this->fields as $field) {
            if($field == 'id') continue;
            $data[$field] = $this->get($field);
            $param[$field] = ':' . $field;
        }

        $sql = "INSERT INTO " . static::TABLE .
            " (" . implode(',', array_keys($param)) .
            ") VALUE (" . implode(',', $param) . ")";

        $this->db->execute($sql, $data);
        return $this->db->getDbh()->lastInsertId();
    }

    /**
     * @return mixed
     */
    private function update()
    {
        $data = [];
        $param = [];

        foreach($this->fields as $field) {
            $data[$field] = $this->get($field);
            if($field == 'id') continue;
            $param[] = $field . '=:' . $field;
        }

        $sql = "UPDATE " . static::TABLE .
            " SET ". implode(',', $param) . " WHERE id=:id";

        return $this->db->execute($sql, $data);
    }

    public function remove()
    {
        $sql = "DELETE FROM " . static::TABLE . " WHERE id=:id";
        return $this->db->execute($sql, ['id' => $this->get('id')]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function find($id)
    {
        $db = App::getInstance()->get('db');
        $sql = "SELECT * FROM " . static::TABLE . " WHERE id=:id";

        $res = $db->query($sql, get_called_class(), ['id' => $id]);
        return $res[0];
    }

    /**
     * @return mixed
     */
    public static function findAll()
    {
        $db = App::getInstance()->get('db');
        $sql = "SELECT * FROM " . static::TABLE;

        return $db->query($sql, get_called_class());
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public static function findByColumn($column, $value)
    {
        $db = App::getInstance()->get('db');
        $sql = "SELECT * FROM " . static::TABLE . " WHERE " . $column . "=:" . $column;

        $res = $db->query($sql, get_called_class(), [$column => $value]);
        return $res[0];
    }

    /**
     * @return mixed
     */
    public static function count()
    {
        $db = App::getInstance()->get('db');
        $sql = "SELECT COUNT(id) AS count FROM " . static::TABLE;
        $res = $db->query($sql, get_called_class());
        return $res[0]->count;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public static function setQuery($sql, $params = [])
    {
        $db = App::getInstance()->get('db');
        return $res = $db->query($sql, get_called_class(), $params);
    }
}
