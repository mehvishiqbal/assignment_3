<?php 

// validating and storing id as variable for later (project id)
$pid = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

//connecting to database
require_once 'database.php';

//creating the SQL request
$sql = 'SELECT name, description, `start date`, `end date`, `project details` from project where `project-id`=?;';

$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($pname, $pdesc, $pstart, $pend, $ptail);

while ($stmt->fetch()) {
	echo '<h1>'.$pname.'</h1>';
	echo '<p>'.$desc.'</p>';
	echo '<p>'.$ptail.'</p>';
	echo '<p>'.$pstart.'-'.$pend.'</p>';
	
}
?>

<hr>

<h2>Resources</h2>
<ul>
<?php
require_once 'database.php';


$sql = 'SELECT r.`Resource-ID`, r.name, rt.`Type Name` 
FROM Project_has_Resource pr, Resource r, `Resource Type` rt 
WHERE pr.`Project_Project-ID` = ? 
AND pr.`Resource_Resource-ID` = r.`Resource-ID` 
AND r.`Resource Type_type-ID` = rt.`type code-ID` ;';

$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($rrid, $rname, $typename);

while($stmt->fetch()) {
	echo '
	<h3>Name</h3>
	<li>'.$rname.'</li>
	<h3>Type</h3>
		<li>'.$typename.'</li>';
}
?>

<hr>	

<a href="index.php">Back to Clientlist</a><br>