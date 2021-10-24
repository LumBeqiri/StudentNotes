<?php
session_start();
// Include the database configuration file
require_once './core/dbh.php';

$db = new Database;

$statusMsg = '';

// File upload path
$targetDir = "posts/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$row = $db->pdo->prepare("SELECT 1 FROM posts WHERE file_name=?");
$row->execute([$fileName]);
$fileExists= $row->fetchColumn();


$query = $db->pdo->prepare('SELECT course_id from courses where title =:t');
        $query->bindParam(':t', $_POST['selectCourse']);
        $query->execute();
        $ctemp = $query->fetchAll();
        $cres =$ctemp['0']['0'];
     
        $course_id=$cres;

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]&& !$fileExists)){

         // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            
            //query i cili e ben upload postin ne kategorin e zgjedhur
            $query = $db->pdo->prepare('INSERT INTO posts (course,created_by,title, `description`, file_name) VALUES (:course,:created_by,:title,:description,:filenm)');
            $query->bindParam(':course', $course_id);
            $query->bindParam(':created_by', $_SESSION['user_id']);
            $query->bindParam(':title', $_POST['title']);
            $query->bindParam(':description', $_POST['description']);
            $query->bindParam(':filenm', $fileName);

            $query->execute();
            if($query){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }

   
}else{
    $statusMsg = 'Please select a file to upload or there is already a file with that name';
}

// Display status message
echo $statusMsg;
header('Location: ./userpost.php');

?>
