<?php include 'includes/admin-config.php'; ?>
<?php
	
	$name = $_REQUEST['username'];
	$pass = md5($_REQUEST['password']);
	$email = $_REQUEST['email'];
	
	
	
	$nn = "update admin set 
			username = '$name', 
			password = '$pass', 
			email = '$email' 
			where id = 1";
	$db->query($nn);
	
	header("location: settings.php?errid=11");
?>