<?php require_once("param.inc.php"); 

$mail = $_POST['email'];
$password_user = $_POST['password'];

$mysqli = new mysqli($host,$login,$password,$dbname);
$res=$mysqli->query("SELECT * FROM utilisateurs WHERE email = :email");

?>


