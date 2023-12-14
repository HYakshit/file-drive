<?php
require_once('Connection.php');
class User extends Connection
{
    private $tablename;
    function __construct()
    {
        parent::__construct();
        $this->tablename = "user";
    }
    public function checkUser($email, $password)
    {
        $query = $this->conn->prepare("select * from  $this->tablename where email = ? and password = ?");
        $query->execute([$email, $password]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result != 0) {
            return $result;
        }
        return null;
    }
}
?>