<?php
    $currentPage=$_SERVER['REQUEST_URI'];
    $title='';
    switch ($currentPage) {
        case "/notes/index.php":
            $title='Home';
            break;
        case "/notes/about.php":
            $title='About';
            break;
        case "/notes/contact.php":
            $title='Contact';
        break;
        case "/notes/categories.php":
            $title='Categories';
            break;
        case "/notes/signin.php":
            $title='Sign In';
            break;
            case "/notes/signup.php":
                $title='Sign Up';
            break;
        default:
            $title= "";
    }


?>