<?php
	include '../config.php';

	$sql_cat = "SELECT categoryName, categoryID FROM 
		categories ORDER BY categoryName";

	$result = $con->query($sql_cat);
	$options = "";

	while ($row = mysqli_fetch_array($result))
	{
		$options = $options . "<option value='" . $row['categoryID'] .
			"'>" . $row['categoryName'] . "</option>";
	}

	if(isset($_POST['add'])){
		$catid = $_POST['category'];
		$name = mysqli_real_escape_string($con,$_POST['name']);
		$desc = mysqli_real_escape_string($con,$_POST['desc']);
		$price = $_POST['price'];
		$file = $_FILES['image'];
		$filename = $file['name'];

		$filePath = "..\\img\\products\\".basename($filename);

		$sql_add="INSERT INTO products VALUES ('', '$catid', '$name', '$desc',$price,'$filename');";

		$con->query($sql_add);
		move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
		$con->close();
		header('location: index.php');

	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Add a Product</title>
		<link href="http://bootswatch.com/spacelab/bootstrap.min.css"
			rel="stylesheet" />
		<link href="../css/jasny-bootstrap.min.css"
			rel="stylesheet"/>
		<script src='../ckeditor/ckeditor.js'></script>
	</head>
	<body>
		<div class="container">
			<div class="col-lg-offset-3 col-lg-6">
				<h1 class="text-center">Add a Product</h1>
				<form method="POST" class="well form-horizontal" 
					enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label col-lg-4">Category</label>
						<div class="col-lg-8">
							<select name="category" class="form-control" required>
								<option value="">Select one...</option>
								<?php echo $options; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Name</label>
						<div class="col-lg-8">
							<input name="name" type="text" 
								class="form-control" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Description</label>
						<div class="col-lg-8">
							<textarea name="desc" rows="10" class="form-control">

							</textarea>
							<script>
								CKEDITOR.replace('desc');
							</script>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Price</label>
						<div class="col-lg-8">
							<input name="price" type="number" min="0.01"
								max="9999.99" step="0.01" class="form-control"
								required/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Image</label>
						<div class="col-lg-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
 								 <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
 									 <div>
    									<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image" required></span>
    									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  									</div>
								</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-4 col-lg-8">
							<button name="add" class="btn btn-success">
								Add
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script src='https://code.jquery.com/jquery-3.1.1.min.js'>
		</script>
		<script src='../js/jasny-bootstrap.min.js'></script>
		
	</body>
</html>