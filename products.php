<?php
	include 'config.php';

	$sql_view = "SELECT p.productId, c.categoryName, p.productImage, p.productName, p.productPrice 
		FROM products p INNER JOIN categories c ON p.categoryID = c.categoryID";

		$result = $con->query($sql_view);
	$sql_cat = "SELECT c.categoryID, c.categoryName, (SELECT COUNT(productId) FROM products WHERE categoryId = c.categoryID) AS totalCount
				FROM categories c ORDER BY c.categoryName";
	$results_cat = $con->query($sql_cat);


?>



<!DOCTYPE html>
<html>
	<head>
		<title>Product catalog</title>
		<link href="http://bootswatch.com/darkly/bootstrap.min.css"
			rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="col-lg-3">
				<div class="well">
					<h3 class="text-center">Advance search</h3>
					<div class="list-group">
						<?php
							while($rows = mysqli_fetch_array($results_cat)){
								$cid= $rows['categoryID'];
								$categ=$rows['categoryName'];
								$total = $rows['totalCount'];
								echo "
									<a href='products.php?c=$cid' class='list-group-item'>
									<span class='badge'>$total</span>
									$categ</a>
								";
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<h2 class="text-center">Product Catalog</h2>
				<?php
				while($row = mysqli_fetch_array($result))
							{
								$pid = $row['productId'];
								$image = $row['productImage'];
								$name= $row['productName'];
								$cat = $row['categoryName'];
								$price = $row['productPrice'];
								echo "
									<div class='col-lg-3'>
										<a href='details.php?id=$pid' style='text-decoration:none;'>
											<div class='thumbnail'>
												<img src='img/products/$image' alt=''/>
												<div class='caption'>
													<h3>$name</h3>
													<small>Category: $cat</small><br/>
													<small>Php$price</small><hr/>
													<a href='Account/AddTocart.php?id=$pid' class='btn btn-success btn-block'>Add to cart</a>
												</div>
											</div>
										</a>
									</div>
								";
							}
				?>
			</div>
		</div>
	</body>
</html>