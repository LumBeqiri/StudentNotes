<?php

include './core/dbh.php';

class AuthController
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    function emailExists($email)
    {
        $row = $this->db->pdo->prepare("SELECT 1 FROM users WHERE email=?");
        $row->execute([$email]);
        return $row->fetchColumn();
    }

    public function login($request)
    {
        
        $query = $this->db->pdo->prepare('SELECT id,name,email,password,is_admin FROM users WHERE email = :email');
        $query->bindParam(':email', $request['email']);
        $query->execute();

        $user = $query->fetch();

        //echo $user['name'];


        if(count($user) > 0 && password_verify($request['password'], $user['password']) && $user['is_admin']==1){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['is_admin'] = $user['is_admin'];
        
            header("Location: ./admindashboard.php");
        }
        elseif(count($user) > 0 && password_verify($request['password'], $user['password'])&&$user['is_admin']==0){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            header("Location: ./index.php");
        }
    }
}
