<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base Model Class
 */
abstract class Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Prepared statements
     * 
     * @var \PDOStatement[]
     */
    protected $prepared = [];

    /**
     * Get all records as an associative array
     *
     * @return array
     */
    public function all()
    {
        $db = $this->getDB();
        $attributes = $this->attributes;
        $table = $this->table;
        $sql = 'SELECT ' . implode(' ,', $attributes) . ' FROM ' . $table;
        $statement = $this->execute($sql);

        return $statement->fetchAll();
    }

    /**
     * Get portion of records as an associative array
     *
     * @return array
     */
    public function getPortion($start, $rowLimit)
    {
        $table = $this->table;
        $sql = 'SELECT * FROM ' . $table . ' LIMIT ' . $start . ', ' . $rowLimit;
        $statement = $this->execute($sql);

        return $statement->fetchAll();
    }    

    /**
     * Delete all records
     *
     * @return \PDOStatement
     */
    public function deleteAll()
    {
        $table = $this->table;
        $sql = 'DELETE FROM ' . $table;
        $statement = $this->execute($sql);
        
        return $statement;
    }

    /**
     * Return last insert Id
     *
     * @return string
     */
    public function lastInsertId()
    {
        $db = $this->getDB();

        return $db->lastInsertId();
    }

    /**
     * Return number of rows in the table
     *
     * @return int
     */
    public function count()
    {
        $table = $this->table;
        $statement = $this->execute('SELECT COUNT(*) FROM ' . $table);
        
        return (int) $statement->fetchColumn(0);
    }     

    /**
     * Need for setting preparing and running a database query
     *
     * @param string $query database statement with parameter placeholders
     * @param array $params array of parameters to replace the placeholders in the statement
     * @return \PDOStatement
     */
    public function execute($query, $params = [])
    {
        $statement = $this->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=' . Config::DB_CHARSET;
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            $db->setAttribute(PDO::ATTR_ERRMODE, Config::PDO_ATTR_ERRMODE);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, Config::PDO_ATTR_DEFAULT_FETCH_MODE);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, Config::PDO_ATTR_EMULATE_PREPARES);
        }

        return $db;
    }

    /**
     * Prepare SQL query via PDO
     *
     * @param string $query
     * @return \PDOStatement
     */
    protected function prepare($query)
    {
        $db = $this->getDB();

        if (!isset($this->prepared[$query])) {
            $this->prepared[$query] = $db->prepare($query);
        }

        return $this->prepared[$query];
    }
}
