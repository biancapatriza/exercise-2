<?php
	include 'config.php';

	if(isset($_REQUEST['id'])){
		$sql_view = "SELECT p.productID, c.categoryName, p.productImage, p.productName, p.productPrice, p.productDesc 
						FROM products p INNER JOIN categories c ON p.categoryID=c.categoryID 
						WHERE p.productID =". $_REQUEST['id'];
		$results =$con->query($sql_view);
		if(mysqli_num_rows($results) > 0){
			while($row = mysqli_fetch_array($results)){
				$name =$row['productName'];
				$image = $row['productImage'];
				$desc = $row['productDesc'];
				$cat = $row['categoryName'];
				$price = $row['productPrice'];
			}
		}
		else{
			header('location: products.php');
		}
	}
	else{
		header('location: products.php');
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $name; ?></title>
		<link href="http://bootswatch.com/darkly/bootstrap.min.css"
			rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="col-lg-6">
				<br/><br/><br/><br/>
				<img src='img/products/<?php echo $image; ?>' class="img-responsive" alt='<?php echo $name; ?>'/>

			</div>
			<div class="col-lg-6">
				<h1><?php echo $name; ?></h1>
				<div class="well">
					<h3>Description</h3>
					<?php echo $desc; ?> 
					<hr/>
					<strong>Category: </strong>
					<?php echo $cat; ?><br/>
					<strong>Price: </strong>
					Php<?php echo $price; ?><br/>
					<hr/>
					<div class="input-group">
						<input name="qty" type="number" min="1" max="99" required value="1" class="form-control"/>
						<span class="input-group-btn">
							<button name="add" class="btn btn-success">
								Add to cart
							</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>