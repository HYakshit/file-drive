<?php
session_start();
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
            $_SESSION['user'] = $result;
            // print_r($_SESSION['user']);
            // exit();
            return $result;
        }
        return null;
    }
    public function store($name, $email, $password)
    {
        try {
            $query = $this->conn->prepare("insert into $this->tablename (name,email,password,status) values (?,?,?,?)");
            $query->execute([$name, $email, $password, 'pending']);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getUsers()
    {
        try {
            $query = $this->conn->prepare("select * from  $this->tablename");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    function changeStatus($id, $status)
    {
        try {
            $query = $this->conn->prepare("update $this->tablename set status = ? where id = ?");
            $result = $query->execute([$status, $id]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>