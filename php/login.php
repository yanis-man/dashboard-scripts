<?php
session_start();
if(isset($_POST))
{
    require_once("database.php");
    require_once("error.php");
    require_once("users.php");

    $SQL = "SELECT id, username, roles, perms, passwd FROM users WHERE employee_id=?;";
    $db = new Database();

    $_POST = $db->sanitize($_POST);
    
    $result = $db->pull($SQL, array($_POST['employee_id']));
    $hashed_password = $db->hasher($_POST['password']);

    if($result)
    {
        header('Content-Type: application/json');
        $result = $result['0'];
        if($result['passwd'] == $hashed_password)
        {
            echo json_encode(['error' => "none"]);
            $_SESSION['user'] = new User($result['username'], $_POST['employee_id'], $result['roles']);
            $role = $db->pull("SELECT display_name FROM roles WHERE id=?;", array($result['roles']));
            $_SESSION['username'] = $result['username'];
            $_SESSION['id'] = $_POST['employee_id'];
            $_SESSION['roles'] = $role['0']['display_name'];
            $_SESSION['perms'] = $result['roles'];
        }
        else
        {
            echo json_encode(['error' => "error"]);
        }
    }
    else
    {
        echo json_encode(["status"=>"error"]);
    }
    $db = null;

}

?>