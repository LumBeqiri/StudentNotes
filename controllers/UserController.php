<?php
//lidhja me databaz
include './core/dbh.php';

class UserController
{
    protected $db;

  
    public function __construct()
    {
        $this->db = new Database;
    }


    //funksioni qe kthen true/false nese ekzsiton email ne db

    function emailExists($email)
    {
        $row = $this->db->pdo->prepare("SELECT 1 FROM users WHERE email=?");
        $row->execute([$email]);
        return $row->fetchColumn();

    }
    
    //funksioni qe merr gjith userat
    public function all()
    {
        $query = $this->db->pdo->query('SELECT * FROM users');

        return $query->fetchAll();
    }

    //metoda store ruan t'dhenat per nje user
    //$request osht variabla lokale e cila merr njonen prej metodave _GET ose _POST
    //Metodat _GET ose _POST ka nje array me vlera te percaktuara ne <form> shembull fullname,email,password
    //is_admin, submitted

    public function store($request)
    {
        //shikohet se useri a osht admin dhe ruhet vlera
        isset($request['is_admin']) ? $isAdmin = 1 : $isAdmin = 0;
        //mirret passwordi prej metodes _POST ose GET dhe hashohet
        $password = password_hash($request['password'], PASSWORD_DEFAULT);
        //krijohet nje query e cila sherben per te insertuar t'dhena
        //VALUES i ka :name,:email,:password,:is_admin t'cilat varen prej prej elementeve qe ndodhen ne array $request, ($request e ka metoden GET ose POST)
        $query = $this->db->pdo->prepare('INSERT INTO users (name, email, password, is_admin) VALUES (:name, :email, :password, :is_admin)');
        $query->bindParam(':name', $request['fullName']);
        $query->bindParam(':email', $request['email']);
        $query->bindParam(':password', $password);
        $query->bindParam(':is_admin', $isAdmin);
        $query->execute();
        
        
    }

    public function edit($id)
    {
        $query = $this->db->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute(['id' => $id]);

        return $query->fetch();
    }


    public function update($id, $request)
    {
        isset($request['is_admin']) ? $isAdmin = 1 : $isAdmin = 0;

        $query = $this->db->pdo->prepare('UPDATE users SET name = :name, email = :email, is_admin = :is_admin WHERE id = :id');
        $query->execute([
            'name' => $request['fullName'],
            'email' => $request['email'],
            'is_admin' => $isAdmin,
            'id' => $id
        ]);

        return header('Location: ./userspanel.php');
    }



    public function destroy($id)
    {
        $query = $this->db->pdo->prepare('DELETE FROM users WHERE id = :id');
        $query->execute(['id' => $id]);
    
        
        return header('Location: ./userspanel.php');
    }


    
    public function getUserId($email){
        $query = $this->db->pdo->prepare('Select id from users where email =:em');
        $query->bindParam(':em', $email);
        $query->execute();
        $temp = $query->fetchAll();
        $result = $temp['0']['0'];
        return $result;

    }

  
    
}
