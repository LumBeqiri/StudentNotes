<?php 

    require_once './core/dbh.php';

class CourseController{

    protected $ctg;

public function __construct()
{
    $this->ctg = new Database;
}

public function all()
    {
        $query = $this->ctg->pdo->query('SELECT * FROM courses');

        return $query->fetchAll();
    }


    public function allCategories()
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


public function get_categoryNameById($id){
    $query=$this->ctg->pdo->prepare('SELECT * FROM category where cid=:id');
    $query->execute(['id' => $id]);
    return $query->fetchAll();
}


public function store($request)
{
    
    $query = $this->ctg->pdo->prepare('INSERT INTO courses (title,category) VALUES (:title,:cat)');
    $query->bindParam(':title', $request['coursename']);
    $query->bindParam(':cat', $request['selectCategory']);

    $query->execute();
    
}


public function edit($cid)
{
    $query = $this->ctg->pdo->prepare('SELECT * FROM courses WHERE course_id = :cid');
    $query->execute(['cid' => $cid]);

    return $query->fetch();
}


public function update($course_id, $request)
{
    $query = $this->ctg->pdo->prepare('UPDATE courses SET title = :cname, category =:cid WHERE course_id = :id');
    $query->execute([
        'cname' => $request['coursename'],
        'cid' => $request['selectCategory'],
        'id'=> $course_id
    ]);

    return header('Location: ./coursespanel.php');
}
public function destroy($cid)
{
    $query = $this->ctg->pdo->prepare('DELETE FROM courses WHERE course_id = :cid');
    $query->execute(['cid' => $cid]);

    
    return header('Location: ./coursespanel.php');
}
}