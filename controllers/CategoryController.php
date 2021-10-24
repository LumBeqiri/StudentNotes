<?php 

    require_once './core/dbh.php';

class CategoryController{

    protected $ctg;

public function __construct()
{
    $this->ctg = new Database;
}

public function all()
    {
        $query = $this->ctg->pdo->query('SELECT * FROM category');

        return $query->fetchAll();
    }


public function get_courses($id){
    $query=$this->ctg->pdo->prepare('SELECT * FROM courses where category=:id');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll();
}


public function store($request)
{
    
    $query = $this->ctg->pdo->prepare('INSERT INTO category (cname) VALUES (:cname)');
    $query->bindParam(':cname', $request['categoryname']);
    $query->execute();
    
    
}
public function edit($cid)
{
    $query = $this->ctg->pdo->prepare('SELECT * FROM category WHERE cid = :cid');
    $query->execute(['cid' => $cid]);

    return $query->fetch();
}
public function update($cid, $request)
{
    $query = $this->ctg->pdo->prepare('UPDATE category SET cname = :cname WHERE cid = :cid');
    $query->execute([
        'cname' => $request['categoryname'],
        'cid' => $cid
    ]);

    return header('Location: ./categoriespanel.php');
}
public function destroy($cid)
{
    $query = $this->ctg->pdo->prepare('DELETE FROM category WHERE cid = :cid');
    $query->execute(['cid' => $cid]);

    
    return header('Location: ./categoriespanel.php');
}
}