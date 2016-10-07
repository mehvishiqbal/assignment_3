<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Client Details</title>
</head>

<body>

<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'database.php';
$sql = 'SELECT Name, Adress,`Contact Name`,`Contact Phone`,`Zip Code_Zip-ID`from Clients where `Client-ID` =?';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($cname, $cadress, $ccontactname, $cphone, $czip);

while($stmt->fetch()) { }
?>
<h1><?=$cname?> </h1>
<p>
Adress: <?=$cadress?><br>
Contact Name: <?=$ccontactname?><br>
Phone: <?=$cphone?><br>
Zip Code: <?=$czip?><br>
</p>

<h2>Projects</h2>
<ul>
<?php
require_once 'database.php';


$sql = 'select Project.Name, `Project-ID` 
from Clients 
inner join Project
on Clients.`Client-ID`=Project.`Clients_Client-ID`
where `Client-ID`=?';

$stmt = $link->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($clientproject, $pid);

while($stmt->fetch()) {
	echo '<li><a href="projectdetails.php?id='.$pid.'">'.$clientproject.'</a></li>';
}
?>


</ul>

<a href="index.php">Back to Clientlist</a><br>

<h2>Update Client</h2>

<form action="updateclient.php" method="post">
	<input type="text" name="cname" value="" placeholder="Name"><br>
    <input type="text" name="cadress" value="" placeholder="Adress"><br>
	<input type="text" name="cphone" value="" placeholder="Phone"><br>
    <input type="hidden" name="cid" value="<?= $id ?>"><br>
    <input type="submit" value="Update">
</form>



</body>
</html>