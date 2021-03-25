<?php 

require_once("php/database.php");
function display_roles()
{
    $db = new Database();
    $result = $db->pull("SELECT * FROM roles ORDER BY id DESC;", array());

    foreach($result as $r)
    {
    ?>
    <option value="<?php echo $r['id'] ?>"><?php echo $r['display_name'] ?></option> 
    <?php
    }   
    $db = null;
}

function display_presta()
{
    $db = new Database();
    $result = $db->pull("SELECT * FROM presta_type;", array());
    //$result = $result[0];

    foreach($result as $r)
    {
    ?>
    <option value="<?php echo $r['id'] ?>" price="<?php echo $r['price'] ?>"><?php echo $r['display_name'] ?></option> 
    <?php
    }   
    $db = null; 
}
function display_comp()
{
    $db = new Database();
    $result = $db->pull("SELECT * FROM parteners;", array());
    //$result = $result[0];

    foreach($result as $r)
    {
    ?>
    <option value="<?php echo $r['id'] ?>"><?php echo $r['display_name'] ?></option> 
    <?php
    }   
    $db = null; 
}

?>