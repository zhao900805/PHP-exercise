<?php require("util.php");
require("secure_conn.php");
require("header.php");
session_start();
$action = filter_input(INPUT_POST,"action");
$name = filter_input(INPUT_POST,"name");
$password = filter_input(INPUT_POST,"password");
$err_msg = "";
switch($action){
    case "login":
        if(admin_is_valid($name,$password)){
            $id = find_id_by_name($name);
            header("Location:display_list.php?admin_id=".$id);
        }else{
            $err_msg = "please try again!";
        }
        break;
    case "register":
        $new_name = filter_input(INPUT_POST,"reg_name");
        $new_password = filter_input(INPUT_POST,"reg_password");
        if(find_admin_if_exit($new_name) == 0){
            add_new_admin($new_name,$new_password);
            header("Location:display_list.php");
        }else{
            $err_msg  ="name existed ,try new one!";
        }
        break;
}
?>
<hr />
<h1>login</h1>
<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    name:<input name="name" type="text">
    password:<input name="password" type="password">
    <input type="submit" value="login" name="action">
</form>
<hr />
<h1>register</h1>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    name:<input name="reg_name" type="text">
    password:<input type="password" name="reg_password">
    <input type="submit" value="register" name="action">
</form>
<p><?php echo $err_msg;?></p>


<?php require("footer.php");?>
