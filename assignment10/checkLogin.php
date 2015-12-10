<?php
session_start();

require("connect.php");


// username and password sent from form 
$myusername=$_POST['txtTrainerName']; 
$mypassword=$_POST['txtPassword']; 

// To protect MySQL injection (more detail about MySQL injection)
/*$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);*/
//$q = mysql_query("SELECT fldPassword FROM customer WHERE fldTrainerName='$myusername'");
//$db_pass = mysql_result($q, 0);

//make a query to get tblUser
$sql  = "SELECT * ";
$sql .= "FROM tblUser ";
$sql .= "WHERE fldTrainerName='$myusername' AND fldPassword='$mypassword'  ";
//$sql .= 'ORDER BY fldFName';
if ($debug) print "<p>sql ". $sql;
$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$result = $stmt->fetchAll();

$count = $stmt->rowCount();



// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['user'] = $myusername;
$_SESSION['password'] = $mypassword;
header("location:home.php");
exit();
}
else {
echo ("Wrong Username or Password");
}
?>
