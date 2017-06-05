<?php require("util.php");
$action = filter_input(INPUT_POST,"action");
switch($action){
    case "submit_select":
        $val = filter_input(INPUT_POST,"select_val");
        switch($val){
            case "price_h_l":
                $sneakers = sort_by_price_h_l();
                break;
            case "price_l_h":
                $sneakers = sort_by_price_l_h();
                break;
            case "year_o_n":
                $sneakers = sort_by_year_o_n();
                break;
            case "year_n_o":
                $sneakers = sort_by_year_n_o();
                break;
            case "amount_l_h":
                $sneakers = sort_by_amount_l_h();
                break;
            case "amount_h_l":
                $sneakers = sort_by_amount_h_l();
                break;
            case "rate_l_h":
                $sneakers = sort_by_rate_l_h();
                break;
            case "rate_h_l":
                $sneakers = sort_by_rate_h_l();
                break;
        }
        break;
}?>
<h1>sort_sneaker.php</h1><a href="display_list.php">back</a>
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
            <td><a href="edit_sneaker.php?action=edit&&id=<?php echo $sneaker["id"];?>">edit</a></td>
            <td><a href="edit_sneaker.php?action=delete&&id=<?php echo $sneaker["id"];?>">delete</a></td>
        </tr>
        <?php endforeach;?>
    </form>
<hr/>
