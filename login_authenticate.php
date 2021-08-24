<?php 

session_start();
$email = $_POST['exampleInputEmail1'];
$password = $_POST['exampleInputPassword1'];

$data = array(
			array(
				'username' => $email,
				'password' => $password
				)
			);

$param = base64_encode(json_encode($data));
$command = escapeshellcmd("python login.py"." ".$param);

// echo "python login.py"." ".$param;
// die;

$output = shell_exec($command);

// header("Location: ".$filename);
// die;
$output1 = str_replace(array('.', ' ', "\n" , "\t", "
	// r"),'',$output);

if ($output1 == 'success'){
	print('success');
	$_SESSION['username'] = $email;
	$_SESSION['auth'] = 'yes';
}else{
	print('fail');
	session_unset();
}
?>