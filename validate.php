<?php //require("util.php"); 
require("db.php");
function find_by_code($code){
    global $db;
    $query = "SELECT sneaker_name FROM sneakers WHERE sneaker_code = :code LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":code",$code);
    $stmt->execute();
    $result = $stmt->rowCount();
    if($result == 1){
        return "N";
    }else{
        return "Y";
    }
    $stmt->closeCursor();
}
$code =filter_input(INPUT_POST,"code");
$result = find_by_code($code);
if($result != null){
    echo $result;
}

?>