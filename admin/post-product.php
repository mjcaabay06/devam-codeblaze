<?php
	include('../include/configuration.php');

	$target_dir = '../resources/uploads';

	if (isset($_POST['btn-submit'])) {
		$user_id = 2;
		$target_dir = $target_dir . '/' . $user_id;

		if (!file_exists($target_dir)) {
			mkdir($target_dir);
		}

		$insertProduct = $dbh->prepare('insert into products(user_id, product_name, description, pkg_quantity, product_category_id, created_at, updated_at) values(:user_id, :product_name, :description, :pkg_quantity, :product_category_id, NOW(), NOW())');
		$insertProduct->execute(array(
				':user_id' => $user_id,
				':product_name' => $_REQUEST['product_name'],
				':description' => $_REQUEST['description'],
				':pkg_quantity' => $_REQUEST['pkg_qty'],
				':product_category_id' => $_REQUEST['product_category_id'],
			));
		
		$product_id = $dbh->lastInsertId();

		$target_dir = $target_dir . '/' . $product_id;

		if (!file_exists($target_dir)) {
			mkdir($target_dir);
		}

		$target_file = $target_dir . '/' . basename($_FILES["file_name"]["name"]);

		if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file)) {
	        echo basename( $_FILES["file_name"]["name"]). " has been uploaded.";
	    } else {
	        echo "Please re-upload your photos.";
	    }
		
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Bootstrap 101 Template</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<form method="post" action="" enctype="multipart/form-data">
			<input type="file" name="file_name" /><br/>
			<input type="text" name="product_name" placeholder="Title" /><br/>
			<textarea name="description" placeholder="Description"></textarea><br/>
			<input type="number" name="pkg_qty" placeholder="" /><br/>

			<select name="product_category_id">
				<?php 
					$selProductCat = $dbh->prepare("select * from product_categories");
					$selProductCat->execute();
					while($pc = $selProductCat->fetch()) :
				?>
					<option value="<?php echo $pc['id'] ?>"><?php echo $pc['category_name'] ?></option>
				<?php endwhile; ?>
			</select>

			<input type="submit" name="btn-submit" placeholder="" /><br/>
		</form>
	</body>
	<script type="text/javascript">
		
	</script>
</html>