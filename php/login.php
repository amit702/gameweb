<?php 
session_start();
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usrnme = test_input($_POST["usrnme"]);
  $passwrd = test_input($_POST["passwrd"]);
} else {
	die("invalid request method"); 
}
$alreadyexist = TRUE;

$dbh = mysqli_connect("localhost", "root", "12345", "yodb")or die("Error ".mysqli_error($dbh));

$usrnme_es = $dbh->real_escape_string($usrnme);
$querystring = $dbh->prepare('SELECT * FROM users WHERE name= ?');
$querystring->bind_param('s', $usrnme_es); // 's' specifies the variable type => 'string'
//var_dump($querystring);die;
$querystring->execute() or die ("Error ".mysqli_error($dbh));

$result = $querystring->get_result();
$querystring->close();
if($result->num_rows == 1)
{
$row = mysqli_fetch_assoc($result);
$passdb = $row['password1'];
$isPasswordCorrect = password_verify($passwrd, $passdb);
	if ($isPasswordCorrect) {
		echo "welcome $usrnme";
		$_SESSION['un']=$usrnme;
	} else {
		echo "Wrong Password";
	}
}
else
	echo "wrong credentials!!try again";

mysqli_close($dbh);
?>