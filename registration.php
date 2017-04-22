<?php
	include('include/configuration.php');

	if ($_POST['btn-submit']) {
		$insertUser = $dbh->prepare("insert into users(email,password,user_type_id,created_at,updated_at, status_id) values(:email, :password, :user_type_id, NOW(), NOW(), 2)");
		$insertUser->execute(array(
				':email' => $_REQUEST['email'],
				':password' => $_REQUEST['password'],
				':user_type_id' => $_REQUEST['user_type'],
			));

		$insertUserInfo = $dbh->prepare("insert into user_infos(first_name, middle_name, last_name, user_id, created_at, updated_at) values(:first_name,:middle_name,:last_name,:user_id, NOW(), NOW())");
		$insertUserInfo->execute(array(
				':first_name' => $_REQUEST['first_name'],
				':middle_name' => $_REQUEST['middle_name'],
				':last_name' => $_REQUEST['last_name'],
				':user_id' => $dbh->lastInsertId(),
			));
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
		<form method="post" action="">
			<input type="hidden" name="user_type" value="<?php echo $_GET['ut'] ?>">
			<input type="text" name="first_name" placeholder="First Name" /> <br/>
			<input type="text" name="middle_name" placeholder="Middle Name" /><br/>
			<input type="text" name="last_name" placeholder="Last Name" /><br/>
			<input type="text" name="email" placeholder="Email Address" /><br/>
			<input type="text" name="password" placeholder="Password" /><br/>
			<input type="text" name="re-password" placeholder="Re-type Password" /><br/>
			<input type="submit" name="btn-submit">
		</form>
	</body>
</html>