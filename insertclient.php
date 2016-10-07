<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<!--Validating each input and storing the input fields names as variables e.g. cname from input field (in index file) stored in variable $cname-->
<?php
$cname = filter_input(INPUT_POST, 'cname', FILTER_SANITIZE_STRING) or die('Missing/illegal parameter');
$cadress = filter_input(INPUT_POST, 'cadress', FILTER_SANITIZE_STRING) or die('Missing/illegal parameter');
$ccontact = filter_input(INPUT_POST, 'ccontact', FILTER_SANITIZE_STRING) or die('Missing/illegal parameter');
$cphone = filter_input(INPUT_POST, 'cphone', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'database.php';

$sql = 'INSERT INTO `Clients`(`Name`, `Adress`, `Contact Name`, `Contact Phone`, `Zip Code_Zip-ID`) VALUES (?, ?, ?, ?, ?);';
$stmt = $link->prepare($sql);
//Binding the variables with the placeholders (?) in the correct order e.g. cphone corresponds with the fourth placeholder. The datatypes of the parameters are stated first in the correct order (sssii, which means string and interger)

$stmt->bind_param('sssii', $cname, $cadress, $ccontact, $cphone, $zipcode);
$stmt->execute();

//If more than one row is affected, echo "this" if not echo "this"
if ($stmt->affected_rows >0 ){
	echo 'Client added to Client List';
}
else {
	echo 'No change has been made';
//	echo $stmt->error;
}
?>
<hr>
<a href="index.php">Back to Clientlist</a><br>

</body>
</html>