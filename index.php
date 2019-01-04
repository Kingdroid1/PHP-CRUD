<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
	crossorigin="anonymous"></script>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
	<?php require_once 'process.php'; ?>

	<?php 
		if (isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?>
	<div class="container">
	<?php 
		$mysqli = new mysqli('localhost', 'root', '', 'phpcrud') or die(mysql_error($mysqli));
		$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
	?>

	<div class="row justify-content-center" style="margin-top: 10%;">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Location</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
		<?php 
		while ($row = $result->fetch_assoc()): ?>
		    <tr>
		    	<td><?php echo $row['name']; ?></td>
		    	<td><?php echo $row['location']; ?></td>
		    	<td>
		    		<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a> 
		    		<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a> 
		    	</td>
		    </tr>
		<?php endwhile; ?>
		</table>
	</div>

	<?php
	//function pre_r($array){
		//echo '<pre>';
		//print_r($array);
		//echo '</pre>';
	//}
	?>

	<div class="row justify-content-center">
	<form action="process.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo $name; ?>">
		</div>
		<div class="form-group">
			<label>Location</label>
			<input type="text" name="location" class="form-control" placeholder="Enter your location" value="<?php echo $locat; ?>">
		</div>
		<div class="form-group">
			<?php
			if ($update == true): ?>
			<button type="submit" name="update" class="btn btn-info">Update</button>
			<?php else: ?>
				<button type="submit" name="save" class="btn btn-primary">Save</button>
			<?php endif; ?>
		</div>
	</form>
	</div>
</div>
</body>
</html>