<?php require_once("util.php"); 
require("header.php");
$action = filter_input(INPUT_POST,"action");
$admin_id = filter_input(INPUT_GET,"admin_id");
if($action==null){
    $action = filter_input(INPUT_GET,"action");
}
$sneakers  = null;
switch($action){
    case "save":
        $id = filter_input(INPUT_POST,"id_stable");
        $name = filter_input(INPUT_POST,"new_name");
        $code = filter_input(INPUT_POST,"new_code");
        $price = filter_input(INPUT_POST,"new_price");
        $year = filter_input(INPUT_POST,"new_year");
        $description = filter_input(INPUT_POST,"new_description");
        $amount = filter_input(INPUT_POST,"new_amount");
        $rate = filter_input(INPUT_POST,"new_rate");
        $discount = filter_input(INPUT_POST,"new_discount");
        if($name!=null && $code !=null && $price!=null && $year!=null && $description!=null && $amount!=null && $rate!=null && $amount!=null){
            $price = update_price_by_discount($price,$discount);
            edit_sneaker_by_id($id,$name,$code,$price,$year,$description,$amount,$rate,$discount);
            header("Location:display_list.php");
        }
        break;
    case "edit":
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        if($id !=null){
            $sneakers = find_by_id($id);
        }
        break;
    case "delete":
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        if($id !=null){
            delete_sneaker_by_id($id);
            header("Location:display_list.php");
        }
        break;
}
?>
<?php require_once("header.php"); ?>
<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
    <tr>
        <th></th>
        <th>name</th>
        <th>code<button type="button">validate</button></th>
        <th>price</th>
        <th>year</th>
        <th>description</th>
        <th>amount</th>
        <th>rate</th>
        <th>discount</th>
    </tr>
    <?php if($sneakers != null) : ?>
    <?php foreach($sneakers as $sneaker): ?>
    <tr>
        <td><input type="hidden" name="id_stable" value="<?php echo htmlspecialchars($sneaker['id']);?>"></td>
        <td><input type="text" name="new_name" value="<?php echo htmlspecialchars($sneaker['sneaker_name']);?>"></td>
        <td><input id="code" type="text" name="new_code" value="<?php echo htmlspecialchars($sneaker['sneaker_code']);?>"></td>
        <td><input type="text" name="new_price" value="<?php echo htmlspecialchars($sneaker['sneaker_price']);?>"></td>
        <td><input type="number" name="new_year" value="<?php echo htmlspecialchars($sneaker['sneaker_designed_year']);?>"></td>
        <td><input type="text" name="new_description" value="<?php echo htmlspecialchars($sneaker['sneaker_description']);?>"></td>
        <td><input type="number" name="new_amount" value="<?php echo htmlspecialchars($sneaker['sneaker_amount']);?>"></td>
        <td><input type="number" name="new_rate" value="<?php echo htmlspecialchars($sneaker['sneaker_rate']);?>"></td>
        <td><input type="number" name="new_discount" value="<?php echo htmlspecialchars($sneaker['sneaker_discount']);?>"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><p  id="alert"></p></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <hr/>
    <input type="submit" name="action" value="save">
    <?php endforeach ;?>
    <?php endif; ?>
    </table>
</form>
<a href="display_list.php?admin_id=<?php echo $admin_id;?>">back</a>
<?php require("footer.php") ;?>


<script>
    $("button").click(function(){
        var code = $("#code").val();
        $.post("validate.php",{code:code},function(data){
            if(data == "N"){
                var alert = "existed,try new one!"
                $("#alert").text(alert);
            }else{
                var alert = "ok!";
                $("#alert").text(alert);
            }
        });
    });
</script>

