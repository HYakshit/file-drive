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
        $query = $this->conn->prepare("select * from  user where email = ? and password = ?");
        $query->execute([$email, $password]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
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
        // echo $id;
        // exit();
        try {
            $query = $this->conn->prepare("update $this->tablename set status = ? where id = ?");
            $result = $query->execute([$status, $id]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function addCategory($category)
    {
        // echo $category;
        // exit();
        try {
            $query = $this->conn->prepare("insert into category (name) values(?)");
            $query->execute([$category]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getCategories()
    {
        try {
            $query = $this->conn->prepare("select * from category");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function editCategory($index, $category)
    { 
        
        try {
            $query = $this->conn->prepare("update category set name= ? where id= ?");
            $result =  $query->execute([$category, $index]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function deleteCategory($index)
    { 
        
        try {
            $query = $this->conn->prepare("delete from category where id= ?");
            $result =  $query->execute([$index]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}
