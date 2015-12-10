<?php include ("top.php"); ?>

<body id="home">


<?php 
include ("header.php");
?>
<?php
include ("nav.php");
?>
<section id="mainBody">
<h1>Home</h1>
<article id="main1">










<?php

include("connect.php");
?>
<form action="adminGUI.php"
          method="post"
          id="frmRegister">  

<?php
//make a query to get all the poets
$sql  = 'SELECT pkUserId, fldFirstName, fldLastName, fldEmail, fldGender, fldTrainerName ';
$sql .= 'FROM tblUser ';
//$sql .= 'WHERE  ';
$sql .= 'ORDER BY fldTrainerName';
if ($debug) print "<p>sql ". $sql;

$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$trainerNameDB = $stmt->fetchAll(); 
if($debug){ print "<pre>"; print_r($trainerNameDB); print "</pre>";}

// build list box
print '<fieldset class="listbox"><legend>Pick Name to Edit</legend><select name="lstUsers" size="1" tabindex="115">';

foreach ($trainerNameDB as $poke) {
    print '<option value="' . $poke['pkUserId'] . '">' .  $poke['fldTrainerName'] . "</option>\n";
}

print "</select>\n";

    

print "</fieldset>\n";
	?>
	
	        <?php
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// if there is a record then we need to be able to pass the pk back to the page
        if ($id != "")
            print '<input name= "id" type="hidden" id="id" value="' . $id . '"/>';
        ?>
        <input type="submit" name="btnSubmitted" value="Submit" />
    
</form>





</article>


<?php include ("footer.php"); ?>

</section>
</body>
</html>

