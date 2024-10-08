<?php
@session_start();
require_once('Connection.php');
class User extends Connection
{
    private $tablename;
    function __construct()
    {
        parent::__construct();
        $this->tablename = "user";
    }
    // user
    public function checkUser($email, $password)
    {
        $query = $this->conn->prepare("select * from  $this->tablename where email = ? and password = ?");
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

        try {
            $query = $this->conn->prepare("update $this->tablename set status = ? where id = ?");
            $result = $query->execute([$status, $id]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getApprovedUsers()
    {
        try {
            $query = $this->conn->prepare("select * from user where status = 'Approved'");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    // category 
    public function addCategory($category)
    {
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
            $result = $query->execute([$category, $index]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function deleteCategory($index)
    {

        try {
            $query = $this->conn->prepare("delete from category where id= ?");
            $result = $query->execute([$index]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    // files 
    public function storeFile($file_name)
    {
        try {
            $query = $this->conn->prepare("insert into files (name) values(?)");
            $result = $query->execute([$file_name]);
            if ($result) {
                $query = $this->conn->prepare("select id from files order by id desc limit 1");
                $id = $query->execute();
                $id = $query->fetch(PDO::FETCH_ASSOC);
                return $id['id'];
            }
        } catch (Exception $e) {
            return false;
        }
    }
    public function getFiles()
    {
        try {
            $query = $this->conn->prepare("select * from files  INNER JOIN file_categories on  files.id = file_categories.file_id");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $files = [];
            $previous = 0;
            foreach ($result as $key => $row) { //to get unique files
                if ($row['file_id'] !== $previous) {
                    $files[] = $row;
                }
                $previous = $row['file_id'];
            }
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getSharedFiles($id)
    {
        try {
            $query = $this->conn->prepare("select * from files inner join shared_files on files.id = shared_files.file_id where shared_files.user_id = ?");
            $query->execute([$id]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    // file_categories
    public function storeCategory($file_id, $category_id)
    {
        try {
            $query = $this->conn->prepare("insert into file_categories (file_id,category_id) values(?,?)");
            $result = $query->execute([$file_id, $category_id]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getFileCategories($id)
    {
        try {
            $query = $this->conn->prepare("select category_id from file_categories where file_id = ?");
            $query->execute([$id]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $categories = array_column($result, 'category_id');
            return $categories;
        } catch (Exception $e) {
            return false;
        }
    }
    // shared_files
    public function alreadyShared($file_id, $user_id)
    {
        $query = $this->conn->prepare("select * from  shared_files where file_id = ? and user_id = ?");
        $query->execute([$file_id, $user_id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
            return $result;
        }
        return null;
    }
    public function storeFiles($file_id, $user_id)
    {
        try {

            $query = $this->conn->prepare("insert into shared_files (file_id,user_id) values(?,?)");
            $result = $query->execute([$file_id, $user_id]);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}
