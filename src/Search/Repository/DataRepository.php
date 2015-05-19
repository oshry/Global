<?php
/**
 * Created by PhpStorm.
 * User: oshry
 * Date: 5/17/15
 * Time: 2:15 PM
 */

namespace Search\Repository;
use PDO;

class DataRepository {
    public static $instances = [];

    public static $default = 'default';

    public function __construct(array $config, $name){
        $this->instance = $name;
        $this->config = $config;
        $this->db = new PDO(
            $config['connection']['dsn'],
            $config['connection']['username'],
            $config['connection']['password']
        );
    }

    public static function instance(array $config, $name = NULL)
    {
        if ($name === NULL)
        {
            $name = static::$default;
        }

        if ( ! isset(static::$instances[$name]))
        {
            static::$instances[$name] = new static($config[$name], $name);
        }
        return static::$instances[$name];
    }

    public function query($sql){
        $query = $this->db->query($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query->fetchAll();
    }
}