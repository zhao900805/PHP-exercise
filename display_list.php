<h1>display_list.php</h1><a href="index.php">back</a>
<?php require_once("util.php");
require_once("header.php");
$sneakers = get_all();
$action = filter_input(INPUT_POST,"action");
$admin_id = filter_input(INPUT_GET,"admin_id");
$admin = find_admin_by_id($admin_id);
if($action != null){
    switch($action){
        case "add":
            $name = filter_input(INPUT_POST,"add_name");
            $code = filter_input(INPUT_POST,"add_code");
            $price = filter_input(INPUT_POST,"add_price");
            $year = filter_input(INPUT_POST,"add_year");
            $description = filter_input(INPUT_POST,"add_description");
            $amount = filter_input(INPUT_POST,"add_amount");
            $rate = filter_input(INPUT_POST,"add_rate");
            add_sneaker($name,$code,$price,$year,$description,$amount,$rate);
            header("Location:display_list.php");
            break;
    }
}
?>
<form action="sort_sneaker.php" method="post">
<label for="select">sort</label>
    <select id="select" name="select_val">
        <option >sort</option>
        <option value="price_h_l">$$~$</option>
        <option value="price_l_h">$~$$</option>
        <option value="year_o_n">1985~now</option>
        <option value="year_n_o">now~1985</option>
        <option value="amount_l_h">!~!!</option>
        <option value="amount_h_l">!!~!</option>
        <option value="rate_l_h">*~**</option>
        <option value="rate_h_l">**~*</option>
    </select>
    <input type="submit" name="action" value="submit_select">
</form>
<a href="display_list_2.php">go to another display_sneaker php</a>
<table border="1">
    <form action = "" method="post">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>code</th>
            <th>price</th>
            <th>year</th>
            <th>description</th>
            <th>amount</th>
            <th>rate</th>
            <th>discount</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($sneakers as $sneaker) :?>
        <tr>
            <td><?php echo htmlspecialchars($sneaker["id"]);?></tdli>
            <td><?php echo htmlspecialchars($sneaker["sneaker_name"]) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_code']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_price']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_designed_year']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_description']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_amount']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_rate']) ;?></td>
            <td><?php echo htmlspecialchars($sneaker['sneaker_discount']) ;?></td>
            <td><a href="edit_sneaker.php?action=edit&&id=<?php echo $sneaker["id"];?>&&admin_id=<?php echo $admin_id;?>">edit</a></td>
            <td><a href="edit_sneaker.php?action=delete&&id=<?php echo $sneaker["id"];?>">delete</a></td>
            <td><a href="purchase_sneaker.php?id=<?php echo $sneaker["id"];?>&&admin_id=<?php echo $admin_id;?>">Purchase</a></td>
            <?php if($sneaker['sneaker_discount']>0) :?>
                <td>on sale</td>
            <?php endif ;?>
        </tr>
        <?php endforeach;?>
    </form>
<hr/>

<h3>add a new sneaker here :</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    name:<input type="text" name="add_name"><br />
    code:<input type="text" name="add_code"><br />
    price:<input type="text" name="add_price"><br />
    year:<input type="number" name="add_year"><br />
    description:<input type="text" name="add_description"><br />
    amount:<input type="number" name="add_amount"><br />
    rate:<input type="number" name="add_rate"><br />
    <input type="submit" name="action" value="add">
</form>
<hr /><br />
</table>
<hr />
<h3>welcome back: <?php echo $admin['name'];?></h3>
<h3>now your balance is : <span id="admin_balance"><?php echo $admin['balance'] ;?></span></h3>
<input type="hidden" id="hidden_id" value="<?php echo $admin['id'];?>">
<lable>charge some balance:
        <input id="charge_input">
        <button id ="charge_btn">submit</button>
</lable>
<?php require_once("footer.php");?>



<script>
$("#charge_btn").click(function(){
    var charge_input = $("#charge_input").val();
    var admin_id = $("#hidden_id").val();
    console.log("charge_input: "+ charge_input);
    console.log("admin_id: "+ admin_id);
    $.post("change_ajax.php",{charge_input:charge_input,admin_id:admin_id},function(data){
        $("#admin_balance").html(data);
        console.log("data:"+data);
    });
});
</script>
