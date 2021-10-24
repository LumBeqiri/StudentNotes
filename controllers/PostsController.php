<?php 
include_once './core/dbh.php';

class PostsController{

    protected $pst;

public function __construct()
{
    $this->pst = new Database;
}

public function all()
    {
        $query = $this->pst->pdo->query('SELECT * FROM posts');

        return $query->fetchAll();
    }



//kthen postin bazuar ne id
public function edit($id){
    $query = $this->pst->pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute(['id' => $id]);

    return $query->fetch();
}


public function update($post_id, $request)
{
    $query = $this->pst->pdo->prepare('UPDATE posts SET course = :course, title =:title, description =:description WHERE id = :id');
    $query->execute([
        'course' => $request['selectCourse'],
        'title' => $request['postname'],
        'description' => $request['description'],
        'id'=> $post_id
    ]);

    return header('Location: ./postspanel.php');
}



//kthen te gjitha postimet duke u bazuar ne id e kategorise
public function get_posts($id){
    $query=$this->pst->pdo->prepare('SELECT * FROM posts where course=:id');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll();
}

public function get_post_title($id){
    $query=$this->pst->pdo->prepare('SELECT title FROM posts where id=:id LIMIT 1');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll();
}


//funksioni kthen emrin e perdoruesit me te dhenat qe merr prej tabeles posts
public function get_post_author($id){
    //query i pare kthen id e userit ne tabelen posts
    $query=$this->pst->pdo->prepare('SELECT created_by FROM posts where id=:id LIMIT 1');
    $query->bindParam(':id', $id);
    $query->execute();
    $res = $query->fetchAll();
    $uid = $res['0']['created_by'];
    //query i dyt kthen emrin e userit nga tabela users
    $quest=$this->pst->pdo->prepare('SELECT name FROM users where id=:uid LIMIT 1');
    $quest->bindParam(':uid', $uid);
    $quest->execute();
    $temp = $quest->fetchAll();
    $u_name = $temp['0']['name'];
    return $u_name;


}

//data e postimit
public function get_post_date($id){

    $query=$this->pst->pdo->prepare('SELECT created_at FROM posts where id=:id LIMIT 1');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll();
}

//funksioni qe kthen pershkrimin e postimit
public function get_post_description($id){

    $query=$this->pst->pdo->prepare('SELECT description FROM posts where id=:id LIMIT 1');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll();
}


//funksioni qe kthen emrin e fajllit
public function get_post_file($id){
    $query=$this->pst->pdo->prepare('SELECT file_name FROM posts where id=:id LIMIT 1');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll();

}



//funksioni qe kthen ID e userit per postin e caktuar
function user_in_post($poid,$uid)
    {
        $query = $this->pst->pdo->prepare("SELECT id FROM posts WHERE id=:poid AND created_by=:usid");
        $query->bindParam(':poid', $poid);
        $query->bindParam(':usid', $uid);
        $query->execute();
        return $query->fetchColumn();

    }

//funksioni qe kthen id e userit duke perdorur email
    public function getUserId($email){
        $query = $this->pst->pdo->prepare('Select id from users where email =:em');
        $query->bindParam(':em', $email);
        $query->execute();
        $temp = $query->fetchAll();
        $result = $temp['0']['0'];
        return $result;

    }

    //funksioni qe fshin nje post bashk me file
    public function destroy($id,$img)
    {
        $query = $this->pst->pdo->prepare('DELETE FROM posts WHERE id = :id');
        $query->execute(['id' => $id]);

        if(!unlink($img)){
            echo 'cannot be deleted';

        }
        else{
            echo 'deleted';
        }
        
        return header('Location: ./categories.php');
    }


    public function get_courseNameById($id){
        $query=$this->pst->pdo->prepare('SELECT * FROM courses where course_id=:id');
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

}