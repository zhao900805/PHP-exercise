<?php require("db.php");
function get_all(){
    global $db;
    $query = "SELECT * FROM sneakers";
    $stmt = $db->prepare($query);
    $stmt ->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function find_by_code($code){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_code = :code LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":code",$code);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function find_by_name($name){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_name = :name";
    $stmt = $db->prepare($query);
    $stmt ->bindValue(":name",$name);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function find_by_designed_year($year){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_designed_year = :year";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":year",$year);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->CloseCursor();
    return $result;
}
function find_by_amount($amount){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_amount = :amount";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":amount",$amount);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->CloseCursor();
    return $result;
}
function find_by_rate($rate){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_rate = :rate";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":rate",$rate);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->CloseCursor();
    return $result;
}

function add_sneaker($name,$code,$price,$year,$description,$amount,$rate){
    global $db;
    $query = "INSERT INTO sneakers (sneaker_name,sneaker_code,sneaker_price,sneaker_designed_year,sneaker_description,sneaker_amount,sneaker_rate) 
    values (:name, :code ,:price, :year,:description,:amount,:rate)";
    $stmt = $db->prepare($query);
    $stmt ->bindValue(":name",$name);
    $stmt ->bindValue(":code",$code);
    $stmt ->bindValue(":price",$price);
    $stmt->bindValue(":year",$year);
    $stmt ->bindValue(":description",$description);
    $stmt->bindValue(":amount",$amount);
    $stmt->bindValue(":rate",$rate);
    $stmt->execute();
    $stmt->CloseCursor();
}
function delete_sneaker_by_id($id){
    global $db;
    $query = "DELETE FROM sneakers WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt ->bindValue(":id",$id);
    $stmt->execute();
    $stmt->closeCursor();
}
function edit_sneaker_by_id($id,$name,$code,$price,$year,$description,$amount,$rate,$discount){
    global $db;
    $query = "UPDATE sneakers SET sneaker_name = :name ,sneaker_code = :code ,sneaker_price = :price ,sneaker_designed_year = :year ,sneaker_description = :description,sneaker_amount = :amount,sneaker_rate=:rate ,sneaker_discount = :discount WHERE id = :id";
    //$query = "UPDATE sneakers SET sneaker_name = :name,sneaker_code = :code,sneaker_price = :price,sneaker_designed_year = :year,sneaker_description = :desciption WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->bindValue(":name",$name);
    $stmt->bindValue(":code",$code);
    $stmt->bindValue(":price",$price);
    $stmt->bindValue(":year",$year);
    $stmt->bindValue(":description",$description);
    $stmt->bindValue(":amount",$amount);
    $stmt->bindValue(":rate",$rate);
    $stmt->bindValue(":discount",$discount);
    $stmt->execute();
    $stmt->closeCursor();
}
function find_by_price($price){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_price = :price";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":price",$price);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->CloseCursor();
    return $result;
}
function find_by_id($id){
    global $db;
    $query = "SELECT * FROM sneakers WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function admin_is_valid($name,$password){
    global $db;
    $query = "SELECT * FROM admin WHERE name = :name AND password = :password LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name",$name);
    $stmt->bindValue(":password",$password);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $valid = ($result!=null);
    return $valid;
    $stmt->closeCursor;  
}
function sort_by_price_h_l(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_price DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_price_l_h(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_price";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_year_o_n(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_designed_year";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_year_n_o(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_designed_year DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_amount_l_h(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_amount";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_amount_h_l(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_amount DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_rate_h_l(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_rate DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function sort_by_rate_l_h(){
    global $db;
    $query = "SELECT * FROM sneakers ORDER BY sneaker_rate";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $stmt->closeCursor();
    return $result;
}
function find_admin_if_exit($name){
    global $db;
    $query = "SELECT * FROM admin WHERE name = :name";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name",$name);
    $stmt->execute();
    $result = $stmt->rowCount();
    if($result >0){
        $existed  =1;
    }else{
        $existed = 0;
    }
    return $existed;
    $stmt->closeCursor();
}
function add_new_admin($name,$password){
    global $db;
    $query = "INSERT INTO admin (name,password) VALUES (:name,:password)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name",$name);
    $stmt->bindValue(":password",$password);
    $stmt->execute();
    $stmt->closeCursor();
}
function find_amount_by_id($id){
    global $db;
    $query ="SELECT sneaker_amount FROM sneakers WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    while($result = $stmt->fetch()){
        return $result['sneaker_amount'];
    }
    //$result = $stmt->fetch();
    //return $result;
    $stmt->closeCursor();
}
function update_amount_by_id($id,$amount){
    global $db;
    $query = "UPDATE sneakers SET sneaker_amount = :amount WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":amount",$amount);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    $stmt->closeCursor();
}
function update_price_by_discount($price,$discount){
    $new_price =$price*(1-$discount/100);
    return $new_price;
}
function update_admin_balance($balance,$price,$amount,$id){
    global $db;
    $new_balance = $balance-($price*$amount);
    $query = "UPDATE admin SET balance = :balance WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->bindValue(":balance",$new_balance);
    $stmt->execute();
    $stmt->CloseCursor();
}
function find_balance_by_id($id){
    global $db;
    $query ="SELECT balance FROM admin WHERE id = :id LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    while($result = $stmt->fetch()){
        return $result['balance'];
    }
    $stmt->closeCursor();
}
function check_balance_enough($balance,$price,$amount){
    if($balance >= $price*$amount){
        return true;
    }else{
        return false;
    }
}
function find_id_by_name($name){
    global $db;
    $query = "SELECT id from admin where name = :name limit 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name",$name);
    $stmt->execute();
    while($result = $stmt->fetch()){
        return $result['id'];
    }
    $stmt->closeCursor();
}
function find_admin_by_id($id){
    global $db;
    $query = "SELECT * FROM admin WHERE id = :id limit 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    while($result = $stmt->fetch()){
       return $result;
    }
    $stmt->closeCursor();
}
function update_admin_balance_by_charge($new_balance,$id){
    global $db;
    $query = "UPDATE admin SET balance =:balance WHERE id =:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":balance",$new_balance);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    $stmt->CloseCursor();
}
function find_sneaker_rated_count_by_id($id){
    global $db;
    $query = "SELECT sneaker_rated_count FROM sneakers WHERE id=:id limit 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    while($result = $stmt->fetch()){
       return $result['sneaker_rated_count'];
    }
    $stmt->CloseCursor();
}
function edit_sneaker_rate_and_rate_count_by_id($id,$rate_count,$old_rate,$new_rate){
    global $db;
    $new_rate = ($new_rate + $rate_count*$old_rate)/($rate_count+1);
    $rate_count = $rate_count+1;
    $query = "UPDATE sneakers SET sneaker_rate = :rate , sneaker_rated_count =:count WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":rate",$new_rate);
    $stmt->bindValue(":count",$rate_count);
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    $stmt->CloseCursor();
}
function add_sneaker_owner_id($admin_id,$id){
    global $db;
    $query = "UPDATE sneakers SET sneaker_owner_id = :admin_id WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id",$id);
    $stmt->bindValue(":admin_id",$admin_id);
    $stmt->execute();
    $stmt->CloseCursor();
}
function find_admin_all_sneakers($admin_id){
    global $db;
    $query = "SELECT * FROM sneakers WHERE sneaker_owner_id = :admin_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":admin_id",$admin_id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
    $stmt->CloseCursor();
}
function find_purchase_list_by_admin_id($admin_id){
    global $db;
    $query = "SELECT purchase_time,purchase_amount,puchase_price from purchase_list where buyer_id = :admin_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":admin_id",$admin_id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
    $stmt->CloseCursor();
}
function update_purchase_list($admin_id,$time,$amount,$price,$item_name){
    global $db;
    $query = "UPDATE update_purchase_list SET purchase_time=:purchase_time,purchase_amount=:purchase_amount,puchase_price=:puchase_price,
              item_name=:item_name WHERE buyer_id=:admin_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":admin_id",$admin_id);
    $stmt->bindValue(":purchase_time",$time);
    $stmt->bindValue(":purchase_amount",$amount);
    $stmt->bindValue(":puchase_price",$price);
    $stmt->bindValue(":item_name",$item_name);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
    $stmt->CloseCursor();
}
function create_new_purchase_list($admin_id,$time,$amount,$price,$item_name){
    global $db;
    $query = "INSERT INTO purchase_list(buyer_id,purchase_time,purchase_amount,puchase_price,item_name) values(:admin_id,:purchase_time,:purchase_amount,:puchase_price,:item_name)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":admin_id",$admin_id);
    $stmt->bindValue(":purchase_time",$time);
    $stmt->bindValue(":purchase_amount",$amount);
    $stmt->bindValue(":puchase_price",$price);
    $stmt->bindValue(":item_name",$item_name);
    $stmt->execute();
    $stmt->CloseCursor();
}
function get_item_name_by_admin_id($admin_id){
    global $db;
    $query = "SELECT item_name FROM purchase_list WHERE buyer_id = :admin_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":admin_id",$admin_id);
    $stmt->execute();
    $result  =$stmt->fetchAll();
    return $result;
    $stmt->CloseCursor();
}
function insert_sneaker_into_json(){
    global $db;
    $query = "SELECT * FROM sneakers";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $Data = file_get_contents("sneakers.json");
    $Data = json_decode($Data,true);
    while($result = $stmt->fetch()){
        $name = $result["sneaker_name"];
        $code = $result["sneaker_code"];
        $price = $result["sneaker_price"];
        $year = $result["sneaker_designed_year"];
        $desc = $result["sneaker_description"];
        $amount = $result["sneaker_amount"];
        $rate = $result["sneaker_rate"];
        $data = array(
            "sneaker_name"=>$name,
            "sneaker_code"=>$code,
            "sneaker_price"=>$price,
            "sneaker_designed_year"=>$year,
            "sneaker_description"=>$desc,
            "sneaker_amount"=>$amount,
            "sneaker_rate"=>$rate
        );
        $Data[] = $data;
    }
    $Data = json_encode($Data);
    file_put_contents("sneakers.json",$Data);
    $stmt->CloseCursor();
}
function get_all_sneakers_from_json(){
    global $db;
    $Data = file_get_contents("sneakers.json");
    $Data = json_decode($Data,true);
    return $Data;
}



