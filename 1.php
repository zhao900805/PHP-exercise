<?php require("header.php");?>
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
</table>

<?php require("footer.php");?>