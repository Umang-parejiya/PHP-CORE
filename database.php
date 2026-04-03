<?php

class Database
{
    private $server;
    private $username;
    private $password;
    private $dbname;
    private $port;
    private $conn;

    public function __construct($server = "localhost", $username = "root", $password = "", $dbname = "internship_project", $port = 3307)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->port = $port;
    }

    public function connect()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->dbname, $this->port);
            
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (mysqli_sql_exception $e) {
            die("Database Connection Error: " . $e->getMessage() . "<br>Please ensure MySQL is started in XAMPP.");
        }
        return $this;
    }

    // crud oprations
    public function insert($query)
    {
        $result = $this->conn->query($query);

        if ($result) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function update($query)
    {
        $result = $this->conn->query($query);

        return $result ? true : false;
    }

    public function delete($query)
    {
        $result = $this->conn->query($query);

        return $result ? true : false;
    }

    public function fetchRow($query)
    {
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function fetchAll($query)
    {
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        return false;
    }

    public function query($query)
    {
        return $this->conn->query($query);
    }

}


// class database{
//     public $server = "localhost";
//     public $username = "root";
//     public $password = "";
//     public $dbname = "internship_project";
//     public $port = 3307;
    
  

//     public function __construct($server = "localhost", $username = "root", $password = "", $dbname = "internship_project", $port = 3307)
//     {
//         $this->server = $server;
//         $this->username = $username;
//         $this->password = $password;
//         $this->dbname = $dbname;
//         $this->port = $port;
//     }

//     public function connect(){
//         $conn = new mysqli($this->server, $this->username, $this->password, $this->dbname, $this->port);
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }
//         return $conn;
//     }
// }
?>