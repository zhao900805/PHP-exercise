<?php require_once("util.php"); 
require("header.php");
$action = filter_input(INPUT_POST,"action");
$admin_id = filter_input(INPUT_GET,"admin_id");
$admin = find_admin_by_id($admin_id);
$zcc = get_item_name_by_admin_id($admin_id);
//start of initialization
$err_msg  ="";
$owned_sneakers = "";
$purchase_lists = "";
//end of initialization
$id = filter_input(INPUT_GET,"id");
if($action == null){
    $id = filter_input(INPUT_GET,"id");
    $sneakers = find_by_id($id);
    $owned_sneakers = find_admin_all_sneakers($admin_id);
    $purchase_lists = find_purchase_list_by_admin_id($admin_id);
}else{
    switch($action){
        case "buy":
            $id = filter_input(INPUT_POST,"id");
            $price = filter_input(INPUT_POST,"price");
            $amount_now = find_amount_by_id($id);
            $amount_to_buy = filter_input(INPUT_POST,"number_to_buy",FILTER_VALIDATE_INT);
            $balance = find_balance_by_id($admin_id);
            $item_name = filter_input(INPUT_POST,"item_name");
            if($amount_to_buy>$amount_now){
                $err_msg = "sorry , too many!";
                $sneakers = find_by_id($id);
            }else{
                $enough_balance = check_balance_enough($balance,$price,$amount_to_buy);
                if($enough_balance == true){
                    add_sneaker_owner_id($admin_id,$id);
                    update_admin_balance($balance,$price,$amount_to_buy,$admin_id);
                    $sneaker_left = $amount_now-$amount_to_buy;
                    update_amount_by_id($id,$sneaker_left);
                    $current_time = date("F j, Y, g:i a"); 
                    create_new_purchase_list($admin_id,$current_time,$amount_to_buy,$price,$item_name);
                    $purchase_lists = find_purchase_list_by_admin_id($admin_id);
                    $admin = find_admin_by_id($admin_id);
                    $sneakers = find_by_id($id);
                    $owned_sneakers = find_admin_all_sneakers($admin_id);
                }else{
                    $err_msg = "sorry , balance not enough!";
                    $admin = find_admin_by_id($admin_id);
                    $sneakers = find_by_id($id);
                }
            }
            break;
        case "rate":
            $rate_select = filter_input(INPUT_POST,"rate_select");
            $old_count = find_sneaker_rated_count_by_id($id);
            $old_rate = filter_input(INPUT_POST,"rate");
            edit_sneaker_rate_and_rate_count_by_id($id,$old_count,$old_rate,$rate_select);
            $admin = find_admin_by_id($admin_id);
            $sneakers = find_by_id($id);
            break;
    }
}


?>
<form action = "purchase_sneaker.php?id=<?php echo $id;?>&&admin_id=<?php echo $admin_id;?>" method="post">
    <table border="1">
        <?php foreach($sneakers as $sneaker):?>
        <input type="hidden" name="id" value="<?php echo $sneaker["id"];?>">
        <input type="hidden" name="price" value="<?php echo $sneaker["sneaker_price"];?>">
        <input type="hidden" name="rate" value="<?php echo $sneaker["sneaker_rate"];?>">
        <input type="hidden" name="item_name" value="<?php echo $sneaker["sneaker_name"];?>">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>code</th>
            <th>price</th>
            <th>year</th>
            <th>description</th>
            <th>amount</th>
            <th>rate</th>
            <th>number to buy</th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($sneaker["id"]);?></tdli>
            <td><?php echo htmlspecialchars($sneaker["sneaker_name"]) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_code']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_price']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_designed_year']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_description']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_amount']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_rate']) ;?></td>
            <td><input type="number" name="number_to_buy"></td>
            <td><input type="submit" name="action" value="buy"></td>
            <?php if($sneaker['sneaker_amount']<=5):?>
                <td>low stock</td>
            <?php endif;?>
        </tr>
            <p><?php echo $err_msg ;?></p>
        <tr>
            <label>rate the sneaker:
                <select name="rate_select">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </label>
            <button type="submit" class="btn btn-info btn-sm" name="action" value="rate">go</button>
        </tr>
        <?php endforeach;?>
    </table>
</form>
<hr />
<a href="display_list.php?admin_id=<?php echo $admin_id;?> ">back</a>

<hr />
<h3>welcome back: <?php echo $admin['name'];?></h3>
<h3>now your balance is : <?php echo $admin['balance'] ;?></h3>
<h3>now you have owned: </h3>
<?php if($owned_sneakers):?>
    <ul>
        <?php foreach($owned_sneakers as $sneaker):?>
            <li><?php echo $sneaker['sneaker_name'];?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>
<?php if($purchase_lists):?>
<h3>purchase_list:</h3>
<table border="1">
    <th>purchase_time:</th>
    <th>purchase_amount:</th>
    <th>puchase_price:</th>
    <th>item_name:</th>
    <?php foreach($purchase_lists as $list):?>
    <tr>
        <td><?php echo $list['purchase_time'];?></td>
        <td><?php echo $list['purchase_amount'];?></td>
        <td><?php echo $list['puchase_price'];?></td>
        <td><?php echo $list['item_name'];?></td>
    </tr>
    <?php endforeach;?>
</table>
<?php endif;?>
<?php foreach($zcc as $z):?>
<li><?php echo $z['item_name'];?></li>
<?php endforeach;?>


<?php require("footer.php");?>
<script>
$("button").click(function(){
    var val = $("select").val();
    console.log(val);
});
</script>