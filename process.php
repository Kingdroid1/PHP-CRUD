<?php
	session_start();

$mysqli = new mysqli('localhost', 'root', '', 'phpcrud') or die(mysql_error($mysqli));

$id = 0;
$update = false;
$name = '';
$locat = '';

if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$loc = $_POST['location'];

	$mysqli->query("INSERT INTO data(name, location) VALUES('$name', '$loc')") or die($mysql->error);

	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if (count($result) == 1) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$locat = $row['location'];
	}
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$locat = $_POST['location'];

	$mysqli->query("UPDATE data SET name='$name', location='$locat' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";

	header("location: index.php");
}
?>