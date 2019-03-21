<?php
require_once("includes/config.php");
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : You did not enter a valid email.";
	}
	else {

		$result = "SELECT count(*) FROM userregistration WHERE email=?";

	if($stmt = $mysqli->prepare($result)) 
	{ // assuming $mysqli is the connection
	    $stmt->bind_param('s',$email);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
	    // any additional code you need would go here.
	} 
	else 
	{
    $error = $mysqli->errno . ' ' . $mysqli->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
		
if($count>0)
{
echo "<span style='color:red'> Email already exist .</span>";
}
else{
	echo "<span style='color:green'> Email available for registration .</span>";
}
}
}

if(!empty($_POST["oldpassword"])) 
{
$pass=$_POST["oldpassword"];
$result ="SELECT password FROM userregistration WHERE password=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('s',$pass);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch();
$opass=$result;
if($opass==$pass) 
echo "<span style='color:green'> Password  matched .</span>";
else echo "<span style='color:red'> Password Not matched</span>";
}


if(!empty($_POST["roomno"])) 
{
$roomno=$_POST["roomno"];
$result ="SELECT count(*) FROM registration WHERE roomno=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$roomno);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
echo "<span style='color:red'>$count. Seats already full.</span>";
else
	echo "<span style='color:red'>All Seats are Available</span>";
}
?>