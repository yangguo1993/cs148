<?php



//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// initialize my variables
//
$debug=false;


if ($debug) print "<p>DEBUG MODE IS ON</p>";

$baseURL = "http://yguo2.w3.uvm.edu/"; 
$folderPath = "cs148/assignment10/"; 
// full URL of this form 
$yourURL = $baseURL . $folderPath . "loginHome.php"; 

require_once("connect.php"); 





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




     //check for errors
     include ("validation_functions.php");
     $errorMsg=array();


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




    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    // check for valid
    if(!$errorMsg){    
        if ($debug) print "<p>Form is valid</p>";
				}
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
<ol><li><a href="http://yguo2.w3.uvm.edu/cs148/assignment10/register.php">Register</a></li></ol>

</section>

<section id="mainBody">
<h2>Login</h2>
<article id="main1">


<p>Please login to gain access to the website. If you have not registered click on the register link below!</p>







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

<form action="checkLogin.php" 
            method="post"
            id="frmRegister"
            enctype="multipart/form-data">


<fieldset class="login">
			<label for="txtTrainerName" class="required">Trainer Name</label>
      <input type="text" id="txtTrainerName" name="txtTrainerName" value="<?php echo $trainerName; ?>"
            tabindex="108" maxlength="25" required placeholder="enter your trainer name"<?php if($firstNameERROR) echo 'class="mistake"'?>>
						
						
						<label for="txtPassword" class="required">Password</label>
      <input type="password" id="txtPassword" name="txtPassword" value="<?php echo $password; ?>"
            tabindex="110" maxlength="25" required placeholder="enter password"<?php if($firstNameERROR) echo 'class="mistake"'?>> <br>


               
    <input type="submit" id="butSubmit" name="butSubmit" value="Login" tabindex="991" class="button"/>

                 

</fieldset>
</form>







</article>


<?php include ("footer.php"); ?>

</section>
</body>
</html>