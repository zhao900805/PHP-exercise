<?php require("util.php");
$charge_input = filter_input(INPUT_POST,"charge_input");
$admin_id = filter_input(INPUT_POST,"admin_id");
update_admin_balance_by_charge($charge_input,$admin_id);
$admin = find_admin_by_id($admin_id);
$result = $admin['balance'];
echo $result;
?>