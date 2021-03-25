<?php

require_once("../database.php");
header('Content-Type: application/json');
if(isset($_POST))
    {
        if(isset($_POST['partenerId']))
        {
            $final_list = display_employees_compId($_POST['partenerId']);
            echo json_encode(["error"=>"none", "employee_list"=> $final_list]);
        }
        if(isset($_POST['refreshData']))
        {
            $final_list = refresh_data();
            echo json_encode(["error"=>"none", "freshData"=> $final_list]);
        }
        else
        {

        }
    }
function display_employees_compId($partenerId)
{
    $db = new Database();
    $result = $db->pull("SELECT * FROM parteners_emp WHERE comp_id=?;", array($partenerId));
    //$result = $result[0];
    $final_list = "";
    foreach($result as $r)
    {
    $final_list = $final_list."<option value=\"" . $r['id']. " \"> ".$r['display_name']. "</option>";
    }   
    $db = null; 
    return $final_list;
}

function refresh_data()
{
    $db = new Database();
    $result = $db->pull("SELECT final_price, quantity, checkout_link, presta_date, presta_type.display_name FROM prestation JOIN presta_type ON presta_type.id = prestation.presta_type;", array());
    //$result = $result[0];
    $final_list = "";
    foreach($result as $r)
    {
    $final_list = $final_list."<tr role=\"row\" class=\"odd\"><td class=\"sorting_1\">".$r['display_name']."</td><td>".$r['final_price']."</td><td>".$r['quantity']."</td><td>".$r['checkout_link']."</td><td>".$r['presta_date']."</td></tr>";
    }   
    $db = null; 
    return $final_list;
}
?>