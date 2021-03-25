<?php
    session_start();

    if(isset($_POST))
    {
        header('Content-Type: application/json');
        require_once("database.php");

        $db = new Database();
        $now = new DateTime();

        $_POST = $db->sanitize($_POST);

        if(!$_POST['isCompagny'])
        {

            $SQL = "INSERT INTO prestation (author, presta_type, quantity, final_price, checkout_link, presta_date) VALUES (?, ?, ?, ?, ?, ?)";
        

            if($_POST['type'] <= 3)
            {
                $_POST['price'] = $_POST['price'] + (50*$_POST['quantity']);
            }
            else
            {
                $_POST['price'] = $_POST['price'] * $_POST['quantity'];
            }

            $db->push($SQL, array($_SESSION['id'], $_POST['type'], $_POST['quantity'], $_POST['price'], $_POST['checkout'], $now->format("d-m-y/H:i:s")));

            echo json_encode(["error" => "none"]);
        }
        else //the prestation is a compagny prestation
        {
            $SQL = "INSERT INTO parteners_presta (author, presta_type, quantity, final_price, partener_id, partener_employee, presta_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
            if($_POST['type'] <= 3)
            {
                $_POST['price'] = $_POST['price'] + (50*$_POST['quantity']);
            }
            else
            {
                $_POST['price'] = $_POST['price'] * $_POST['quantity'];
            }

            $db->push($SQL, array($_SESSION['id'], $_POST['type'], $_POST['quantity'], $_POST['price'], $_POST['partener_id'],  $_POST['partener_employee'], $now->format("d-m-y/H:i:s")));

            echo json_encode(["error" => "none"]);
        }   
    }
?>