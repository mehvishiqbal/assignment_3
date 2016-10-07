<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php
$fid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'database.php';

$sql = 'Delete from clients where `client-id`=?';

$stmt = $link->prepare($sql);
$stmt->bind_param('i', $fid);
$stmt->execute();

if ($stmt->affected_rows >0 ){
	echo 'Client deleted from list';
}
else {
	echo 'No client deleted';
//	echo $stmt->error;
}

?>

<hr>
<a href="index.php">Back to Clientlist</a><br>

</body>
</html>