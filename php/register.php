<?php
session_start();
if(isset($_POST))
{
    require_once("database.php");
    //require_once("users.php");

    $db = new Database();

    $_POST = $db->sanitize($_POST);

    $SQL = "SELECT username FROM users WHERE employee_id=?";
    $isDouble = $db->check_double_entry($SQL, array($_POST['id']));
    header('Content-Type: application/json');
    if($isDouble == false)
    {

        $SQL = "INSERT INTO users (employee_id, username, account_num, roles, perms, passwd) VALUES (?, ?, ?, ?, ?, ?);";
        $uuid = time();
        $p = $db->hasher("1234");
        $data = array((int) $_POST['id'], $_POST['name'], (int) $_POST['account'], (int) $_POST['grade'], 0, $p);

        $db->push($SQL, $data);

        $db = null;

        echo json_encode(['error' => "none"]);
        //$_SESSION['user'] = new User($_POST['surname'], $_POST['name'], $_POST['email'], (int) $_POST['level'], (int) $_POST['class_'], $uuid, 0);
    }
    else
    {
        echo json_encode(['error' => "Utilisateur déjà existant"]);
    }
}
//$name, $surname, $email, $level, $class_,$password



?>