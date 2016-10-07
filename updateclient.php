<?php

$cname = filter_input(INPUT_POST, 'cname', FILTER_SANITIZE_STRING) or die('Missing/illegal parameter');
$cadress = filter_input(INPUT_POST, 'cadress', FILTER_SANITIZE_STRING) or die('Missing/illegal parameter');
$cphone = filter_input(INPUT_POST, 'cphone', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
$cidupdate = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

echo $cname;
echo $cadress;
echo $cphone;
echo $cidupdate;


require_once 'database.php';

$sql = "UPDATE Clients
SET `Name` = ?, Adress = ?, `Contact Phone`= ?
WHERE `Client-ID` = ?;";

$stmt = $link->prepare($sql);

//Binding the variables with the placeholders (?) in the correct order e.g. cphone corresponds with the fourth placeholder. The datatypes of the parameters are stated first in the correct order (sssii, which means string and interger)
$stmt->bind_param('ssii', $cname, $cadress, $cphone, $cidupdate);
$stmt->execute();

//If more than one row is affected, echo "this" if not echo "this"
if ($stmt->affected_rows >0 ){
	echo 'Client Updated';
}
else {
	echo 'No change has been made';
}
?>
<hr>