<?php

/**
 * Database
 *
 * Simple database class wrapped around MySQL PDO object
 */
class Database
{
    /**
     * PDO Instance
     *
     * @var \PDO
     */
    protected $pdo;

    /**
     * Construct method
     *
     * @params string $host
     * @params string $username
     * @params string $password
     * @params string $databaseName
     */
    public function __construct($host, $username, $password, $databaseName)
    {
        // instantiate and configure pdo object
        $dsn = "mysql:host={$host};dbname={$databaseName}";
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Simple select method
     *
     * @params string $table
     * @params array $data An associative array where key is field name
     *
     * @return array An array of associative arrays
     */
    public function select($table, array $data = array())
    {
        // build select statement
        $sql = "SELECT * FROM {$table}";
        if (!empty($data)) {
            // add where clause
            $format = function ($field) {return "{$field} = :{$field}";};
            $conditions = array_map($format, array_keys($data));
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        // run query; return records
        return $this->query($sql, $data)->fetchAll();
    }

    /**
     * Simple insert method
     *
     * @params string $table
     * @params array $data An associative array where key is field name
     *
     * @return array Inserted record as associative array
     */
    public function insert($table, array $data)
    {
        // build insert statement
        $format = function ($field) {return "{$field} = :{$field}";};
        $set = implode(', ', array_map($format, array_keys($data)));
        $sql = sprintf('INSERT INTO %s SET %s', $table, $set);

        // run query
        $this->query($sql, $data);

        // return inserted record
        $id = $this->pdo->lastInsertId();
        $records = $this->select($table, array('id' => $id));
        return array_shift($records);
    }

    /**
     * Simple update method
     *
     * @params string $table
     * @params int $id
     * @params array $data An associative array where key is field name
     *
     * @return array Updated record as associative array
     */
    public function update($table, $id, array $data)
    {
        // build update statement
        $format = function ($field) {return "{$field} = :{$field}";};
        $set = implode(', ', array_map($format, array_keys($data)));
        $sql = sprintf('UPDATE %s SET %s WHERE id = :currentId', $table, $set);

        // inject current id into data array for where clause
        // must be done after building set clause or it would appear in set clause
        $data['currentId'] = $id;

        // run query
        $this->query($sql, $data);

        // return updated record
        return array_shift($this->select($table, array('id' => $id)));
    }

    /**
     * Simple delete method
     *
     * @params string $table
     * @params int $id
     */
    public function delete($table, $id)
    {
        // build delete statement
        $sql = "DELETE FROM {$table} WHERE id = :id";

        // run query
        $this->query($sql, array('id' => $id));
    }

    /**
     * Query method to run any kind of sql statement. Uses prepared statements 
     * to prevent SQL injection
     *
     * @params string $sql
     * @params array $data An associative array where key is field name
     *
     * @return \PDOStatement
     */
    public function query($sql, array $data = array())
    {
        $pdoStatement = $this->pdo->prepare($sql);
        foreach ($data as $field => $value) {
            $pdoStatement->bindValue(":{$field}", $value);
        }
        $pdoStatement->execute();
        return $pdoStatement;
    }
}
