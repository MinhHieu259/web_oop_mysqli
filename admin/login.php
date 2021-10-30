<?php
	include('../classes/adminlogin.php');
?>
<?php
$class= new adminlogin();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$adminUser=$_POST['adminUser'];
		$adminPass=$_POST['adminPass'];
		$login_check = $class->login_admin($adminUser,$adminPass);
	}else {
		$login_check='';
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span><?php if($login_check){
				echo $login_check;
			}else {
				echo '';
			}
			?></span>
			<div>
				<input type="text" placeholder="Username" required="" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in"/>
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>