<?php require_once("util.php");
require("header.php");
session_start();
$session_msg = "";
$err_msg = "";
$data_2  ="";
$action = filter_input(INPUT_POST,"action");
if($action == null){
    $action = filter_input(INPUT_GET,"action");
    if($action == null){
        $action = "display_all_sneakers";
    }
}
switch($action){
    case "display_all_sneakers":
        $sneakers = get_all();
        if(!isset($_SESSION['session'])){
            $_SESSION['session'] = "first";
            $session_msg = $_SESSION['session'];
        }else{
            $_SESSION['session'] = "set!";
            $session_msg = $_SESSION['session'];
        }
        include("1.php");
        break;
    case "submit_select":
        $val = filter_input(INPUT_POST,"select_val");
        switch($val){
            case "price_h_l":
                $sneakers = sort_by_price_h_l();
                include("1.php");
                break;
            case "price_l_h":
                $sneakers = sort_by_price_l_h();
                include("1.php");
                break;
            case "year_o_n":
                $sneakers = sort_by_year_o_n();
                include("1.php");
                break;
            case "year_n_o":
                $sneakers = sort_by_year_n_o();
                include("1.php");
                break;
            case "amount_l_h":
                $sneakers = sort_by_amount_l_h();
                include("1.php");
                break;
            case "amount_h_l":
                $sneakers = sort_by_amount_h_l();
                include("1.php");
                break;
            case "rate_l_h":
                $sneakers = sort_by_rate_l_h();
                include("1.php");
                break;
            case "rate_h_l":
                $sneakers = sort_by_rate_h_l();
                include("1.php");
                break;
        }
        break;
    case "search_by_name":
        $name = filter_input(INPUT_POST,"search_name");
        $sneakers = find_by_name($name);
        include("1.php");
        break;
    case "search_by_code":
        $code = filter_input(INPUT_POST,"search_code");
        $sneakers = find_by_code($code);
        include("1.php");
        break;
    case "search_by_designed_year":
        $year = filter_input(INPUT_POST,"search_year");
        $sneakers = find_by_designed_year($year);
        include("1.php");
        break;
    case "search_by_price":
        $price = filter_input(INPUT_POST,"search_price");
        $sneakers = find_by_price($price);
        include("1.php");
        break;
    case "search_by_amount":
        $price = filter_input(INPUT_POST,"search_amount");
        $sneakers = find_by_price($amount);
        include("1.php");
        break;
    case "search_by_rate":
        $price = filter_input(INPUT_POST,"search_rate");
        $sneakers = find_by_price($rate);
        include("1.php");
        break;
    case "session_get":
        /*if(!isset($_SESSION['session'])){
            $_SESSION['session']="first";
            $session_msg = $_SESSION['session'];
        }else{
            $_SESSION['session'] = "second";
            $session_msg = $_SESSION['session'];
        }*/
        $_SESSION['session'] = "second";
            $session_msg = $_SESSION['session'];
        break;
    case "session_cancel":
        unset($_SESSION['session']);
        //$_SESSION['session'] = array();
        session_destroy();
        break;
    case "save_json":
        $data_1 = file_get_contents("4-27.json");
        $data_1 = json_decode($data_1,true);
        $sneaker_name = filter_input(INPUT_POST,"sneaker_name");
        $sneaker_code = filter_input(INPUT_POST,"sneaker_code");
        $sneaker_price = filter_input(INPUT_POST,"sneaker_price");
        $sneaker_designed_year = filter_input(INPUT_POST,"sneaker_designed_year");
        $sneaker_description = filter_input(INPUT_POST,"sneaker_description");
        $sneaker_amount = filter_input(INPUT_POST,"sneaker_amount");
        $data = array(
            "sneaker_name"=>$sneaker_name,
            "sneaker_code"=>$sneaker_code,
            "sneaker_price"=>$sneaker_price,
            "sneaker_designed_year"=>$sneaker_designed_year,
            "sneaker_description"=>$sneaker_description,
            "sneaker_amount"=>$sneaker_amount
        );
        //array_push($data_1,$data) ;
        $data_1[] = $data;
        $data = json_encode($data_1);
        if(!file_put_contents("4-27.json",$data)){
            $err_msg = "insert json failed!";
        }else{
            $err_msg = "insert json success!";
        }
        break;
    case "get_json":
        if(!file_exists("4-27.json")){
            $err_msg = "json deos not exist!";  
        }else{
            $data_2 = file_get_contents("4-27.json");
            $data_2 = json_decode($data_2,true);
        }
        break;
    case "add":
        $name = filter_input(INPUT_POST,"new_name");
        $code = filter_input(INPUT_POST,"new_code");
        $price = filter_input(INPUT_POST,"new_price");
        $year = filter_input(INPUT_POST,"new_year");
        $amount = filter_input(INPUT_POST,"new_amount");
        $description = filter_input(INPUT_POST,"new_desc");
        $rate = filter_input(INPUT_POST,"new_rate");
        add_sneaker($name,$code,$price,$year,$description,$amount,$rate);
        $sneakers = get_all();
        insert_sneaker_into_json();
        include("1.php");
        break;
    case "print_sneakers_json":
        $sneakers_json = get_all_sneakers_from_json();
        break;
}?>

<h3>session:<?php echo $session_msg ;?></h3>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="submit" name="action" value="display_all_sneakers">
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

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    search_by_name
    <input name="search_name" type="text">
    <input type="hidden" name="action" value="search_by_name">
    <input type="submit" value="go">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    search_by_code
    <input name="search_code" type="text">
    <input type="hidden" name="action" value="search_by_code">
    <input type="submit" value="go">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    search_by_year
    <input name="search_year" type="number">
    <input type="hidden" name="action" value="search_by_designed_year">
    <input type="submit" value="go">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    search_by_price
    <input name="search_price" type="number">
    <input type="hidden" name="action" value="search_by_price">
    <input type="submit" value="go">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    search_by_amount
    <input name="search_price" type="number">
    <input type="hidden" name="action" value="search_by_amount">
    <input type="submit" value="go">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    search_by_rate
    <input name="search_price" type="number">
    <input type="hidden" name="action" value="search_by_rate">
    <input type="submit" value="go">
</form>
<hr/>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="submit" name="action" value="session_get">
    <input type="submit" name="action" value="session_cancel">
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    sneaker_name:<input type="text" name="sneaker_name">
    sneaker_code:<input type="text" name="sneaker_code">
    sneaker_price:<input type="text" name="sneaker_price">
    sneaker_designed_year:<input type="text" name="sneaker_designed_year">
    sneaker_description:<input type="text" name="sneaker_description">
    sneaker_amount:<input type="text" name="sneaker_amount">
    <input type="submit" name="action" value="save_json">
    <input type="submit" name="action" value="get_json">
    <p><?php echo $err_msg;?></p>
</form>
<?php if($data_2!= null):?>
    <?php for($x=0;$x < count($data_2);$x++):?>
        <ul>
            <li><?php echo $data_2[$x]['sneaker_name'];?></li>
            <li><?php echo $data_2[$x]['sneaker_code'];?></li>
            <li><?php echo $data_2[$x]['sneaker_price'];?></li>
            <li><?php echo $data_2[$x]['sneaker_designed_year'];?></li>
            <li><?php echo $data_2[$x]['sneaker_description'];?></li>
            <li><?php echo $data_2[$x]['sneaker_amount'];?></li>
        </ul>
    <?php endfor;?>
<?php endif;?>
<hr />
<a href="index.php">back</a>
<hr />
<h3>add a new one here:</h3>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    new name:<input tyep="text" name="new_name"><br />
    new code:<input tyep="text" name="new_code"><br />
    new price:<input tyep="text" name="new_price"><br />
    new year:<input tyep="text" name="new_year"><br />
    new desc:<input tyep="text" name="new_desc"><br />
    new amount:<input tyep="text" name="new_amount"><br />
    new rate:<input tyep="text" name="new_rate"><br />
    <input type="submit" name="action" value="add">
    <input type="submit" name="action" value="print_sneakers_json">
</form>
<hr/>
<?php if($sneakers_json):?>
    <table border="1">
    <?php foreach($sneakers_json as $json):?>
    <tr>
        <td><?php echo  $json["sneaker_name"];?></td>
    </tr> 
    <?php endforeach;?>
<?php endif;?>
<?php require("footer.php");?>