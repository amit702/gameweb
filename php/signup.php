<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = test_input($_POST['name']);
	$email = test_input($_POST['email']);
	$password1 = test_input($_POST['password1']);
} else {
	die("invalid request method"); 
}

$passdb = password_hash($password1, PASSWORD_BCRYPT);
$dbh = mysqli_connect("localhost", "root", "12345", "yodb")or die("Error ".mysqli_error($dbh));
	$name_es = $dbh->real_escape_string($name);
	$email_es = $dbh->real_escape_string($email);
	$passsword1_es = $dbh->real_escape_string($password1);
	$querystring = $dbh->prepare('INSERT INTO users(name,email,password1) VALUES (?,?,?)');
	$querystring->bind_param('sss', $name_es,$email_es,$passdb);
	$result = $querystring->execute() or die ("Error ".mysqli_error($dbh));
	$querystring->close();
	if($result==TRUE){
		echo"user successfully registered<br>";
	} else {
		echo "error in adding user to database<br>";
	}
//}
mysqli_close($dbh);
?>