<?php

session_start();
session_destroy();
session_unset[$_SESSION['email']];

header('Location: index.php');