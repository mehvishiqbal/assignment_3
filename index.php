<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Client List</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<h1>Gotham City Client List</h1>
<table>
<?php
// clientlist.php?cid=2
//$cid = filter_input(INPUT_GET, '', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'database.php';
$sql = 'SELECT name, `Client-ID` FROM test.Clients;';
$result = $link->query($sql);

while($row= $result->fetch_assoc()) { 

echo '<tr>
		<td><a href="clientdetails.php?id='.$row["Client-ID"].'">'.$row["name"].'</a></td>
	 </tr>';
}


?>
</table>

<h2>Create Client</h2>

<form action="insertclient.php" method="post">
	<input type="text" name="cname" value="" placeholder="Name"><br>
    <input type="text" name="cadress" value="" placeholder="Adress"><br>
    <input type="text" name="ccontact" value="" placeholder="Contact name"><br>
    <input type="text" name="cphone" value="" placeholder="Phone"><br>
    <h2>Zipcode</h2>
    <select name="zipcode">
		<?php
		$sql = 'Select `zip-id` from `Zip Code`;';
   		$stmt = $link->prepare($sql);
    	$stmt->execute();
    	$stmt->bind_result($zipcode);
    while ($stmt->fetch()){
   echo '<option value="'.$zipcode.'" placeholder="Zip">'.$zipcode.'</option>'.PHP_EOL;
	}
 ?>
 
 <input type="submit" value="Add to Clientlist">
</select>
 </form>
 
 <h2>Delete Clients</h2>
 <form action="deleteclient.php" method="post">
 <select name="cid">
		<?php
		$sql = 'Select name, `client-id` from Clients;';
   		$stmt = $link->prepare($sql);
    	$stmt->execute();
    	$stmt->bind_result($cname, $cid);
    while ($stmt->fetch()){
   echo '<option value="'.$cid.'" placeholder="Zip">'.$cname.'</option>'.PHP_EOL;
	}
 ?>
 <input type="submit" value="Delete">
 </select>
 </form>
 
 
 

 
</body>
</html>