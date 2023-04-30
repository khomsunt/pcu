<?php
include "../include/connection.php";
include "../include/function.php";

$a_table=array(
    array("table"=>"","id"=>"","name"=>""),
    array("table"=>"tambon","id"=>"tambon_fullcode","name"=>"tambon_name","where"=>"1")
);

$key = array_search($_POST['table'], array_column($a_table, 'table'));
if ($a_table[$key]['table']){
    $sql="select * from ".$a_table[$key]['table']." where ".$a_table[$key]['where'].(($_POST['where'])?" and ".$_POST['where']:"")." order by ".$a_table[$key]['name'];
    $stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <option value="<?php echo $row[$a_table[$key]['id']]; ?>"><?php echo $row[$a_table[$key]['name']]; ?></option>
        <?php
    }
}

