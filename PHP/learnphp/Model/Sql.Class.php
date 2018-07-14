<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 03/06/2018
 * Time: 21:06
 */

class Sql extends PDO
{
    private $con;

    public function __construct($dsn, $username, $passwd, array $options)
    {
        $this->con = new PDO("mysql:host=localhost;dbname=learnphp", "root","");
    }

    public function setParams($statement, $parameters = array())
    {
        foreach ($parameters as $key => $value)
        {
            $this->setParams($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->con->prepare($rawQuery);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}