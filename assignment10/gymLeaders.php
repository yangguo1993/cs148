<?php
session_start();


if (!isset($_SESSION['user']))
{
header("location:loginHome.php"); 
exit();
}
?>

<?php include ("top.php"); ?>

<body id="home">

<section id = "headBackground">
<?php 
include ("header.php");
?>
</section>

<section id = "navBackground">
<?php
include ("nav.php");
?>
</section>
<section id="mainBody">
<h2>Gym Leaders</h2>
<article id="main1">




<?php
require("connect.php");


$sql  = 'SELECT * ';
$sql .= 'FROM tblGymLeaders';


if ($debug) print "<p>sql ". $sql;

$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$gymLeaders = $stmt->fetchAll(); 
if($debug){ print "<pre>"; print_r($gymLeaders); print "</pre>";}









foreach ($gymLeaders as $gym) {
	//foreach($courses as $course){}
    print nl2br("<table border='1'><tr><td>Region</td><td>Gym Leader Image</td><td>Gym Leader Name</td><td>Type</td><td>Badge</td><td>Location</td></tr><tr><td>" . $gym['fldRegion'] . "</td><td><img src=" . $gym['fldImage'] . " " . "alt=" . $gym['fldImage'] . "></td><td>" . $gym['fldName'] . "</td><td>" . $gym['fldType'] . "</td><td>" . $gym['fldBadge'] . "</td><td>" . $gym['fldLocation'] . "</td></tr></table>");
}






?>





</article>

<!-- %%%%%%%%%%%%GYM LEADER IMAGE SOURCES%%%%%%%%%% -->
<!--
http://cdn.bulbagarden.net/upload/1/11/VSBrock.png
http://cdn.bulbagarden.net/upload/2/20/VSMisty.png
http://cdn.bulbagarden.net/upload/4/46/VSLt_Surge.png
http://cdn.bulbagarden.net/upload/5/5a/VSFalkner.png
http://cdn.bulbagarden.net/upload/2/2a/VSBugsy.png
http://cdn.bulbagarden.net/upload/2/27/VSWhitney.png
http://cdn.bulbagarden.net/upload/2/22/VSValerie.png
http://cdn.bulbagarden.net/upload/7/7f/VSOlympia.png
http://cdn.bulbagarden.net/upload/f/f0/VSWulfric.png
-->


<?php include ("footer.php"); ?>

</section>
</body>
</html>
