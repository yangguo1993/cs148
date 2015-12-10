<?php

$debug=false;


if ($debug) print "<p>DEBUG MODE IS ON</p>";

$baseURL = "http://yguo2.w3.uvm.edu/"; 
$folderPath = "cs148/assignment10/"; 
// full URL of this form 
$yourURL = $baseURL . $folderPath . "register.php"; 

require_once("connect.php"); 


//############################################################################# 
// set all form variables to their default value on the form. for testing i set 
// to my email address. you lose 10% on your grade if you forget to change it. 

$gender = Male;
// $email = ""; 



//initialize flags for errors, one for each item
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
$courseNumERROR = false;
$yearERROR = false;
$gradDateERROR = false;
$teacherERROR = false;
$courseNumERROR2 = false;
$teacherERROR2 = false;
$yearERROR2 = false;


//############################################################################# 
//   
$mailed = false; 
$messageA = ""; 
$messageB = ""; 
$messageC = ""; 
?>




<?php



		
		/*
        this function just converts all input to html entites to remove any potentially
        malicious coding
    */
    function clean($elem)
    {
        if(!is_array($elem))
            $elem = htmlentities($elem,ENT_QUOTES,"UTF-8");
        else
            foreach ($elem as $key => $value)
                $elem[$key] = clean($value);
        return $elem;
     }

     // be sure to clean out any code that was submitted
     if(isset($_POST)) $_CLEAN['POST'] = clean($_POST); 

     /* now we refer to the $_CLEAN arrays instead of the get or post
      * ex: $to = $_CLEAN['GET']['txtEmail'];
      * or: $to = $_CLEAN['POST']['txtEmail'];
      */
     
      //check for errors
     include ("validation_functions.php");
     $errorMsg=array();
    
     //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
     
     
     $firstName=$_CLEAN['POST']['txtFname'];

		 
		 
     $lastName=$_CLEAN['POST']['txtLname'];

		
	
    $email=$_CLEAN['POST']['txtEmail'];

	
    $trainerName=$_CLEAN['POST']['txtTrainerName'];

		
		
		if(isset($_CLEAN['POST']["radGender"])){
            $gender = $_POST["radGender"];
		}
		
		 $password=$_CLEAN['POST']['txtPassword'];
	
		
		$rePassword=$_CLEAN['POST']['txtRePassword'];
		
		$pokemonSpecies = $_POST['lstPokemon'];


?>





























<?php

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// if form has been submitted, validate the information
if (isset($_POST["butSubmit"])){

    //************************************************************
    // is the refeering web page the one we want or is someone trying 
    // to hack in. this is not 100% reliable */
    $fromPage = getenv("http_referer"); 

    if ($debug) print "<p>From: " . $fromPage . " should match yourUrl: " . $yourURL;

    if($fromPage != $yourURL){
        die("<p>Sorry you cannot access this page. Security breach detected and reported</p>");
    } 
    


     // be sure to clean out any code that was submitted
     if(isset($_POST)) $_CLEAN['POST'] = clean($_POST); 

     /* now we refer to the $_CLEAN arrays instead of the get or post
      * ex: $to = $_CLEAN['GET']['txtEmail'];
      * or: $to = $_CLEAN['POST']['txtEmail'];
      */
     
     
    
     //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
     // begin testing each form element 
     
     // Test first name for empty and valid characters
     $firstName=$_CLEAN['POST']['txtFname'];
     if(empty($firstName)){
        $errorMsg[]="Please enter your First Name";
        $firstNameERROR = true;
     } else {
        $valid = verifyAlphaNum ($firstName); /* test for non-valid  data */
        if (!$valid){ 
            $errorMsg[]="First Name must be letters and numbers, spaces, dashes and single quotes only.";
            $firstNameERROR = true;
        }
     }
		 
		 
		      //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
     // begin testing each form element 
     
     // Test Last Name for empty and valid characters
     $lastName=$_CLEAN['POST']['txtLname'];
     if(empty($lastName)){
        $errorMsg[]="Please enter your Last Name";
        $lastNameERROR = true;
     } else {
        $valid = verifyAlphaNum ($lastName); /* test for non-valid  data */
        if (!$valid){ 
            $errorMsg[]="Last Name must be letters and numbers, spaces, dashes and single quotes only.";
            $lastNameERROR = true;
        }
     }
		
		
		
    // test email for empty and valid format
    // 
    $email=$_CLEAN['POST']['txtEmail'];
		if (empty($email)) { 
        $errorMsg[] = "Please enter your Email Address"; 
        $emailERROR = true; 
    } else { 
        $valid = verifyEmail($email); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, the email address you entered is not valid."; 
            $emailERROR = true; 
        } 
    } 
		
    // test trainerName for empty and valid format
    // 
    $trainerName=$_CLEAN['POST']['txtTrainerName'];
		if (empty($trainerName)) { 
        $errorMsg[] = "Please enter your Trainer Name"; 
        $firstNameERROR = true; 
    } else { 
        $valid = verifyAlphaNum($trainerName); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, the trainer name you entered is not valid."; 
            $firstNameERROR = true; 
        } 
    }  
		
		
		     //test to see if there is already that trainer name in use
		
		
		
		$sql  = "SELECT * ";
$sql .= "FROM tblUser ";
$sql .= "WHERE fldTrainerName='$trainerName'  ";
$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$result = $stmt->fetchAll();

$count = $stmt->rowCount();

 if ($count >= 1) { 
            $errorMsg[] = "I'm sorry, the trainer name you entered is already in use.";
						$firstNameERROR = true; 

		}
		
		
		
		
		
		
		
				
				
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		   // test trainerName for empty and valid format
    // 
    $password=$_CLEAN['POST']['txtPassword'];
		if (empty($password)) { 
        $errorMsg[] = "Please enter your Password"; 
        $firstNameERROR = true; 
    } else { 
        $valid = verifyAlphaNum($password); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, the password you entered is not valid."; 
            $firstNameERROR = true; 
        } 
    } 
		
		$rePassword=$_CLEAN['POST']['txtRePassword'];
		if (empty($rePassword)) { 
        $errorMsg[] = "Passwords don't match"; 
        $firstNameERROR = true; 
    } else { 
        $valid = verifyAlphaNum($rePassword); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "Passwords don't match"; 
            $firstNameERROR = true; 
        } 
    } 
		if ($_POST['txtPassword']!= $_POST['txtRePassword'])
 			{
     $errorMsg[] = "Passwords don't match";
 			}
				
		
		
		
		//List box
		
		 if(isset($_CLEAN['POST']["lstPokemon"])){
            $lstPokemon = $_CLEAN['POST']["lstPokemon"];
    }
		
    
    
    
    //  
    // set values for items not checked. This makes these values on the form 
    // reset when there is an errror. Also the varaibles can be used in a message.
    //

		
		if(isset($_CLEAN['POST']["radGender"])){
            $gender = $_POST["radGender"];
		}

    
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    // check for valid
    if(!$errorMsg){    
        if ($debug) print "<p>Form is valid</p>";
				
				
		//############################################################################ 
// 
// the form is valid so now save the information 

//###########User#############

			$primaryKeyS = ""; 
        $dataEntered = false; 
         
        try { 
            $db->beginTransaction(); 
            
            $sql = 'INSERT INTO tblUser SET fldFirstName="' . $firstName . '",'; 
						$sql .= 'fldLastName="' . $lastName . '",'; 
						$sql .= 'fldTrainerName="' . $trainerName . '",'; 
						$sql .= 'fldEmail="' . $email . '",';
						$sql .= 'fldPassword="' . $password . '",';
						$sql .= 'fldGender="' . $gender . '",';
						$sql .= 'fldSpecies="' . $lstPokemon . '"';
            $stmt = $db->prepare($sql); 
            if ($debug) print "<p>sql ". $sql; 
						$stmt->execute(); 
             
            $primaryKeyS = $db->lastInsertId(); 
            if ($debug) print "<p>pk= " . $primaryKeyS; 
						
            

            // all sql statements are done so lets commit to our changes 
            $dataEntered = $db->commit(); 
            if ($debug) print "<p>transaction complete "; 
        } catch (PDOExecption $e) { 
            $db->rollback(); 
            if ($debug) print "Error!: " . $e->getMessage() . "</br>"; 
            $errorMsg[] = "There was a problem with accpeting your data please contact us directly."; 
        } 
				
				


        // If the transaction was successful, give success message 
        if ($dataEntered) { 
            if ($debug) print "<p>data entered now prepare keys "; 
            //################################################################# 
            // create a key value for confirmation 

            $sql = "SELECT fldDateJoined FROM tblUser WHERE pkRegisterId=" . $primaryKey; 
            $stmt = $db->prepare($sql); 
            $stmt->execute(); 

            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
             
            $dateSubmitted = $result["fldDateJoined"]; 

            $key1 = sha1($dateSubmitted); 
            $key2 = $primaryKey; 

            if ($debug) print "<p>key 1: " . $key1; 
            if ($debug) print "<p>key 2: " . $key2;


//################################################################# 
            // 
            //Put forms information into a variable to print on the screen 
            // 

            $messageA = '<h2>Thank you for registering.</h2>'; 

           /* $messageB = "<p>Click this link to confirm your registration: "; 
            $messageB .= '<a href="' . $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>'; 
            $messageB .= "<p>or copy and paste this url into a web browser: "; 
            $messageB .= $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>"; */

            $messageC .= "<p><b>Email Address:</b><i>   " . $email . "</i></p>"; 


if(isset($_CLEAN['POST'])) {
            foreach ($_CLEAN['POST'] as $key => $value){
                    $message .= "<p>" . $key . " = " . $value . "</p>";
            }
        }
            //############################################################## 
            // 
            // email the form's information 
            // 
             
            $subject = "Pokemon Trainer Registration"; 
            include_once('mailMessage.php'); 
            $mailed = sendMail($email, $subject, $messageA . $messageB . $messageC . $message); 
						
						
				
        } //data entered    
    } // no errors  
}// ends if form was submitted.







	
				
				
				
        
?>

<?php include ("top.php"); ?>

<body id="form">
<section id = "headBackground">
<?php 
include ("header.php");
?>
</section>
<section id = "navBackground">
<nav>
	<ol>
<?php
if(basename($_SERVER['PHP_SELF'])=="http://yguo2.w3.uvm.edu/cs148/assignment10/loginHome.php"){
	print '<li class="activePage">Login</li>';
} else {
	print '<li><a href="http://yguo2.w3.uvm.edu/cs148/assignment10/loginHome.php">Login</a></li>';
}


?>


	</ol>
</nav>
</section>

<section id="mainBodyForm">
<h2>Register</h2>
<article id="main1">
<p>Please fill out all the fields below to complete registration.</p>
</article>
<?php 
if(isset($_POST["butSubmit"]) AND empty($errorMsg)){

    print "<h1>Your Registration has ";

    if (!$mailed) {
        echo "not ";
    }
    
    echo "been processed</h1>";

    print "<p>A copy of this message has ";
    if (!$mailed) {
        echo "NOT ";
    }
    print "been sent</p>";
    print "<p>To: " . $email . "</p>";
    
}

?>
<div id="errors">
<?php
if($errorMsg){
    echo "<ol>\n";
    foreach($errorMsg as $err){
            echo "<li>" . $err . "</li>\n";
    }
    echo "</ol>\n";
}
?>
</div>





<form action="<?php print $_SERVER['PHP_SELF']; ?>" 
            method="post"
            id="frmRegister"
            enctype="multipart/form-data">
            
<!--<fieldset class="wrapper">
  <legend>Register Today</legend>
  <p>Please fill out the following registration form.</p>-->

<fieldset class="intro">
<legend>Please complete the following form</legend>

<fieldset class="user">
<legend>User Information</legend>  

                  
    <label for="txtFname" class="required">First Name</label>
      <input type="text" id="txtFname" name="txtFname" value="<?php echo $firstName; ?>" 
            tabindex="100" maxlength="25"  placeholder="enter your first name"
                <?php if($firstNameERROR) echo 'class="mistake"' ?>>
                
								
		<label for="txtLname" class="required">Last Name</label>
      <input type="text" id="txtLname" name="txtLname" value="<?php echo $lastName; ?>" 
            tabindex="105" maxlength="25"  placeholder="enter your last name"
                <?php if($lastNameERROR) echo 'class="mistake"' ?>>
             
								
				
				<label class="required" for="txtEmail">Email </label> 
         <input id ="txtEmail" name="txtEmail" class="element text medium<?php if ($emailERROR) echo ' mistake'; ?>" type="text" maxlength="255" value="<?php echo $email; ?>" placeholder="enter your email address" onfocus="this.select()"  tabindex="106"/>

                 
           <label>Gender</label>
   <label><input type="radio" id="radMale" name="radGender" value="Male" tabindex="112" 
            <?php if($gender=="Male") echo ' checked="checked" ';?>/>Male</label> 
    <label><input type="radio" id="radFemale" name="radGender" value="Female" tabindex="113" 
            <?php if($gender=="Female") echo ' checked="checked" ';?>/>Female</label>  
						
						<br>

				
		
			<label for="txtTrainerName" class="required">Trainer Name</label>
      <input type="text" id="txtTrainerName" name="txtTrainerName" value="<?php echo $trainerName; ?>"
            tabindex="108" maxlength="25" placeholder="enter your trainer name"<?php if($firstNameERROR) echo 'class="mistake"'?>>
						
						
						<label for="txtPassword" class="required">Password</label>
      <input type="password" id="txtPassword" name="txtPassword" value="<?php echo $password; ?>"
            tabindex="110" maxlength="25" placeholder="enter password"<?php if($firstNameERROR) echo 'class="mistake"'?>>
						
						<label for="txtRePassword" class="required">Re-enter Password</label>
      <input type="password" id="txtRePassword" name="txtRePassword" value="<?php echo $rePassword; ?>"
            tabindex="111" maxlength="25" placeholder="re-enter password"<?php if($firstNameERROR) echo 'class="mistake"'?>>
					       
						

					</fieldset>
					 
<?php

//make a query to get all the pokemon 
$sql  = 'SELECT pkPokemonId, fldType, fldSpecies, fldImage, fldHealth, fldAttack, fldDefense ';
$sql .= 'FROM tblPokemon ';
//$sql .= 'WHERE  ';
$sql .= 'ORDER BY fldSpecies';
if ($debug) print "<p>sql ". $sql;

$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$pokemon = $stmt->fetchAll(); 
if($debug){ print "<pre>"; print_r($pokemon); print "</pre>";}

// build list box
print '<fieldset class="listbox"><legend>Pick Your Pokemon</legend><select name="lstPokemon" size="1" tabindex="115">';
?>



<?php
foreach ($pokemon as $poke) {

   print '<option value="' . $poke['fldSpecies'] . '">' .  $poke['fldSpecies'] . "</option>\n";
}
?>

		
<?php
print "</select>\n";
?>



    <!-- set button -->
						<input name="setPokemonID" type="submit" id="setPokemonID" value="View">
		
		<!-- %%%%%%%%%%%%%%%%%%%%%%% SOURCE OF POKEMON PICTURES %%%%%%%%%%%%%%%%%%%%% -->
		
		<!-- charmander http://cdn.bulbagarden.net/upload/archive/7/73/20130810091956%21004Charmander.png -->
		
		<!-- squirtle http://cdn.bulbagarden.net/upload/archive/3/39/20100909015307%21007Squirtle.png -->
		
		<!-- bulbasaur http://cdn.bulbagarden.net/upload/archive/2/21/20101227163906%21001Bulbasaur.png -->
		
		<!-- cyndaquil http://cdn.bulbagarden.net/upload/archive/9/9b/20091219081100%21155Cyndaquil.png -->
		
		<!-- totodile http://cdn.bulbagarden.net/upload/archive/d/df/20090511202023%21158Totodile.png -->
		
		<!-- chikorita http://cdn.bulbagarden.net/upload/archive/b/bf/20091219070559%21152Chikorita.png -->
		
		<!-- chimchar http://cdn.bulbagarden.net/upload/archive/7/76/20090601031246%21390Chimchar.png -->
		
		<!-- piplup http://cdn.bulbagarden.net/upload/archive/b/b1/20090601031332%21393Piplup.png -->
		
		<!-- turtwig http://cdn.bulbagarden.net/upload/archive/5/5c/20090601031122%21387Turtwig.png -->
		
		
		
<?php
// SET BUTTON
if(isset($_POST['setPokemonID']))
{


$pokemonSpecies = $_POST['lstPokemon'];





$sql  = "SELECT * ";
$sql .= "FROM tblPokemon ";
$sql .= "WHERE fldSpecies='$pokemonSpecies'  ";
$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$result = $stmt->fetchAll();

$count = $stmt->rowCount();



// If there is a pkUserName with that number
if($count==1){


//Set Trainer Name
//fldTrainerName, fldFirstName, fldLastName, fldEmail, fldGender
$sql = "SELECT * ".
       "FROM tblPokemon ".
       "WHERE fldSpecies ='$pokemonSpecies'" ;

//mysql_select_db('test_db');

$stmt = $db->prepare($sql);
            
$stmt->execute(); 

$result = $stmt->fetchAll();


foreach ($result as $poke) {
		//print "<img src=$poke['fldImage'] >";
		//echo '<img src=$poke["fldImage"]>';
		echo '<img src="' . $poke['fldImage'] . '" />';
		
}

/*foreach ($result as $poke) {
		$firstName = $poke['fldFirstName'];
}

foreach ($result as $poke) {
		$lastName = $poke['fldLastName'];
}

foreach ($result as $poke) {
		$email = $poke['fldEmail'];
}

foreach ($result as $poke) {
		$gender = $poke['fldGender'];
}*/
}
}
		?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
<?php
print "</fieldset>\n";
	?>
				
				
                 
 

<fieldset class="buttons">
    <legend></legend>                
    <input type="submit" id="butSubmit" name="butSubmit" value="Register" tabindex="991" class="button"/>

    <input type="reset" id="butReset" name="butReset" value="Reset Form" tabindex="993" class="button" onclick="reSetForm()" />
</fieldset>                    

</fieldset>
</form>














 
<?php include ("footer.php"); ?>
</section>
</body>
</html>