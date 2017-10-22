<?php

include('conf/db.inc');

$query = $mysqli->prepare("select * from user"); 
$query->execute();

$result = $query->get_result();

while($rows = mysqli_fetch_array($result)){
	var_dump($rows['password']);
	$options = [
	'cost'=>11,
	'salt'=>mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
	];

	$newpass = password_hash($rows['password'],  PASSWORD_BCRYPT, $options);
	if ($newpass){

	}

	$query2 = $mysqli->prepare("UPDATE user set password = ? WHERE username = ?");
	#faire un save des passwd obtenus en hash sha * changer varchar(8) à VarChar(256)
	$query2->bind_param('ss', $newpass, $rows['username']);
	$query2->execute();
}

?>