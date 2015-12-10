<?php


/* the purpose of this page is to display a form to allow a person to either
 * add a new record if not pk was passed in or to update a record if a pk was
 * passed in.
 * 
 * notice i have more than one submit button on the form and i need to make
 * sure they have different names
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 * Last updated on: November 5, 2013
 * 
 * 
 -- --------------------------------------------------------

    --
    -- Table structure for table `tblPoet`
    --

CREATE TABLE tblUser(
pkUserId int(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
fldFirstName varchar(20),
fldLastName varchar(20),
fldEmail varchar(35),
fldGender varchar(10),
fldTrainerName varchar(25),
fldPassword varchar(25),
fldDateJoined timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
fldConfirmed tinyint(1) NOT NULL DEFAULT '0',  
fkPokemonId int(4) not null references tblPokemon(pkPokemonId)
)
ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


CREATE TABLE tblPokemon(
pkPokemonId int(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
fldType varchar(20),
fldSpecies varchar(20),
fldImage varchar(25),
fldHealth int(5),
fldAttack int(5),
fldDefense int(5)
)
ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;





*/


//-----------------------------------------------------------------------------
// 
// Initialize variables
//  


$debug = false;
if (isset($_GET["debug"])) {
    $debug = true;
}

include("connect.php");

$baseURL = "https://yguo2.w3.uvm.edu/";
$folderPath = "cs148/assignment10/adminGUI/";
// full URL of this form
$yourURL = $baseURL . $folderPath . "adminGUI.php";

$fromPage = getenv("http_referer");

if ($debug) {
    print "<p>From: " . $fromPage . " should match ";
    print "<p>Your: " . $yourURL;
}

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// initialize my form variables either to waht is in table or the default 
// values.
// display record to update





		 if(isset($_CLEAN['POST']["lstUsers"])){
            $lstUser = $_CLEAN['POST']["lstUsers"];
    }
		
		echo($lstUser);







echo(isset($_POST["lstUsers"]));
if (isset($_POST["lstUsers"])) {

    // you may want to add another security check to make sure the person
    // is allowed to delete records.
    
    $id = htmlentities($_POST["lstUsers"], ENT_QUOTES);

    $sql = "SELECT fldFirstName, fldLastName, fldEmail, fldGender, fldTrainerName ";
    $sql .= "FROM tblUser ";
    $sql .= "WHERE pkUserId=" . $id;

    if ($debug)
        print "<p>sql " . $sql;

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $users = $stmt->fetchAll();
    if ($debug) {
        print "<pre>";
        print_r($users);
        print "</pre>";
    }

    foreach ($users as $user) {
        $firstName = $user["fldFirstName"];
        $lastName = $user["fldLastName"];
        $email = $user["fldEmail"];
				$gender = $user["fldGender"];
				$trainerName = $user["fldTrainerName"];
    }
} else { //defualt values

    $id = "";
    $firstName = "";
    $lastName = "";
    $email = "";
		$gender = "";
		$trainerName = "";


} // end isset lstPoets


//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// simple deleting record. 
if (isset($_POST["cmdDelete"])) {
//-----------------------------------------------------------------------------
// 
// Checking to see if the form's been submitted. if not we just skip this whole 
// section and display the form
// 
//#############################################################################
// minor security check
    if ($fromPage != $yourURL) {
        die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>");
    }

    // you may want to add another security check to make sure the person
    // is allowed to delete records.
    
    $delId = htmlentities($_POST["deleteId"], ENT_QUOTES);

    // I may need to do a select to see if there are any related records.
    // and determine my processing steps before i try to code.

    $sql = "DELETE ";
    $sql .= "FROM tblUser ";
    $sql .= "WHERE pkUserId=" . $delId;

    if ($debug)
        print "<p>sql " . $sql;

    $stmt = $db->prepare($sql);

    $DeleteData = $stmt->execute();

    // at this point you may or may not want to redisplay the form
    if($DeleteData){
        header('Location: https://www.uvm.edu/~jpsheeha/cs148/assignment7.1/adminGUI/adminGUI.php');
        exit();
    }
}

//-----------------------------------------------------------------------------
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// if form has been submitted, validate the information both add and update
if (isset($_POST["btnSubmitted"])) {
    if ($fromPage != $yourURL) {
        die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>");
    }
    
    // initialize my variables to the forms posting	
    $id = htmlentities($_POST["id"], ENT_QUOTES);
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES);
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES);
    $email = htmlentities($_POST["txtEmail"], ENT_QUOTES);
		$gender = htmlentities($_POST["txtGender"], ENT_QUOTES);
		$trainerName = htmlentities($_POST["txtTrainerName"], ENT_QUOTES);

    
    // Error checking forms input
    include ("validation_functions.php");

    $errorMsg = array();


	
		
		
		
			    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    // begin testing each form element 
    if ($firstName == "") {
        $errorMsg[] = "Please enter your First Name";
    } else {
        $valid = verifyAlphaNum($firstName); /* test for non-valid  data */
        if (!$valid) {
            $error_msg[] = "First Name must be letters and numbers, spaces, dashes and ' only.";
        }
    }

    if ($lastName == "") {
        $errorMsg[] = "Please enter your Last Name";
    } else {
        $valid = verifyAlphaNum($lastName); /* test for non-valid  data */
        if (!$valid) {
            $error_msg[] = "Last Name must be letters and numbers, spaces, dashes and ' only.";
        }
    }
		
		    if ($email == "") {
        $errorMsg[] = "Please enter your email";
    } else {
        $valid = verifyEmail($email); /* test for non-valid  data */
        if (!$valid) {
            $error_msg[] = "Invalid email";
        }
    }
		
		    if ($gender == "") {
        $errorMsg[] = "Please enter your gender";
    } else {
        $valid = verifyAlphaNum($gender); /* test for non-valid  data */
        if (!$valid) {
            $error_msg[] = "Gender must be letters and numbers, spaces, dashes and ' only.";
        }
    }
		
		    if ($trainerName == "") {
        $errorMsg[] = "Please enter your First Name";
    } else {
        $valid = verifyAlphaNum($trainerName); /* test for non-valid  data */
        if (!$valid) {
            $error_msg[] = "Trainer name must be letters and numbers, spaces, dashes and ' only.";
        }
    }
		
		
		
		
		
		

   
    //- end testing ---------------------------------------------------
    
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    // there are no input errors so form is valid now we need to save 
    // the information checking to see if it is an update or insert
    // query based on the hidden html input for id
    if (!$errorMsg) {
        
        if ($debug)
            echo "<p>Form is valid</p>";

        if (isset($_POST["id"])) { // update record
            $sql = "UPDATE ";
            $sql .= "tblUser SET ";
            $sql .= "fldFirstName='$firstName', ";
            $sql .= "fldLastName='$lastName', ";
            $sql .= "fldEmail='$email' ";
						$sql .= "fldGender='$gender', ";
						$sql .= "fldTrainerName='$trainerName', ";
            $sql .= "WHERE pkUserId=" . $id;
        } else { // insert record
            $sql = "INSERT INTO ";
            $sql .= "tblUser SET ";
            $sql .= "fldFirstName='$firstName', ";
            $sql .= "fldLastName='$lastName', ";
						$sql .= "fldEmail='$email', ";
						$sql .= "fldGender='$gender', ";
						$sql .= "fldTrainerName='$trainerName'";
        }
        // notice the SQL is basically the same. the above code could be replaced
        // insert ... on duplicate key update but since we have other procssing to
        // do i have split it up.

        if ($debug)
            echo "<p>SQL: " . $sql . "</p>";

        $stmt = $db->prepare($sql);

        $enterData = $stmt->execute();

        // Processing for other tables falls into place here. I like to use
        // the same variable $sql so i would repeat above code as needed.
        if ($debug){
            print "<p>Record has been updated";
        }
        
        // update or insert complete
        if($enterData){
            header('Location: https://www.uvm.edu/~jpsheeha/cs148/assignment7.1/adminGUI/adminGUI.php');
            exit();
        }
        
    }// end no errors	
} // end isset cmdSubmitted
 
include("top.php");
include("header.php");
include("nav.php");

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// display any errors at top of form page
if ($errorMsg) {
    echo "<ul>\n";
    foreach ($errorMsg as $err) {
        echo "<li style='color: #ff6666'>" . $err . "</li>\n";
    }
    echo "</ul>\n";
} //- end of displaying errors ------------------------------------


if ($id != "") {
    print "<h1>Edit User Information</h1>";
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    // display a delete option
    ?>
    <form action="<? print $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <input type="submit" name="cmdDelete" value="Delete" />
            <?php print '<input name= "deleteId" type="hidden" id="deleteId" value="' . $id . '"/>'; ?>
        </fieldset>	
    </form>
    <?php
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
} else {
    print "<h1>Add User Information</h1>";
}
?>

<form action="<? print $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <label for="txtFirstName"	>First Name</label><br>
        <input name="txtFirstName" type="text" size="20" id="txtFirstName" <?php print "value='$firstName'"; ?>/><br>

        <label for="txtLastName">Last Name</label><br>
        <input name="txtLastName" type="text" size="20" id="txtLastName" <?php print 'value="' . $lastName . '"'; ?>/><br>

        <label for="txtEmail">Email</label><br>
        <input name="txtEmail" type="text" size="20" id="txtEmail" <?php print "value='$email'"; ?> /><br>
				
				<label for="txtGender"	>Gender</label><br>
        <input name="txtGender" type="text" size="20" id="txtGender" <?php print "value='$gender'"; ?>/><br>
				
				<label for="txtTrainerName"	>Trainer Name</label><br>
        <input name="txtTrainerName" type="text" size="20" id="txtTrainerName" <?php print "value='$trainerName'"; ?>/><br>

				
				
				
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
				
				
				
				
				
				
				
				
				
				
				
				
				
						
        <?
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// if there is a record then we need to be able to pass the pk back to the page
        if ($id != "")
            print '<input name= "id" type="hidden" id="id" value="' . $id . '"/>';
        ?>
        <input type="submit" name="btnSubmitted" value="Submit" />
    </fieldset>
</form>
<?php
include ("footer.php");
?>
</body>
</html>
