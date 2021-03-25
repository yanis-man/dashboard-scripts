<?php
if(isset($_POST) || isset($_GET))
{
    header('Content-Type: application/json');
    echo json_encode(["title" => "OKOK", "start"=>"2021-02-12T10:30:00", "end"=>"2021-02-12T11:30:00"]);
}
?>