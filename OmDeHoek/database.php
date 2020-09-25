<?php
class DB
{
    private $server;
    private $database;
    private $username;
    private $conn;
    //private $password;

    function __construct($server, $database, $username)
    {
        $this->server = $server;
        $this->database = $database;
        $this->username = $username;
        //$this->password = $this->encrypt($password, $key);
    }

    private function conn()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, "", $this->database);
        } catch (\Throwable $e) {
            die($e);
        }
    }

    public function query($sql, $return = 'fetch_all', $method = MYSQLI_ASSOC)
    {
        $this->conn();
        if (isset($this->conn) && !empty($this->conn)) {
            $result = $this->conn->query($sql);
            if ($return !== 0) {
                if(!empty($method)){
                    return $result->{$return}($method);
                }else{
                    return $result->{$return}();
                }
            }
        }
        $this->conn->close();
    }
}
?>