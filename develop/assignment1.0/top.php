<?php
include "lib/constants.php";
require_once('lib/custom-functions.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Google Link text so put something relevant here</title>
        <meta charset="utf-8">
        <meta name="author" content="Mark me wrong">
        <meta name="description" content="Mark me wrong for not changing this">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="css/base.css" type="text/css" media="screen">

        <?php
        $debug = false;

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries. Note some are in lib and some are in bin
        // bin should be located at the same level as www-root (it is not in 
        // github)
        // 
        // yourusername
        //     bin
        //     www-logs
        //     www-root
        
        
        $includeDBPath = "../bin/";
        $includeLibPath = "../lib/";
        
        
        require_once($includeLibPath . 'mailMessage.php');

        require_once('lib/security.php');
        
        require_once($includeDBPath . 'Database.php');
        
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // PATH SETUP
        //  
            
        // sanitize the server global variable
        $_SERVER = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);
        foreach ($_SERVER as $key => $value) {
            $_SERVER[$key] = sanitize($value, false);
        }
        
        $domain = "//"; // let the server set http or https as needed

        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);

        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }
        
        $yourURL = $domain . $phpSelf;

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        // sanatize global variables 
        // function sanitize($string, $spacesAllowed)
        // no spaces are allowed on most pages but your form will most likley
        // need to accept spaces. Notice my use of an array to specfiy whcih 
        // pages are allowed.
        // generally our forms dont contain an array of elements. Sometimes
        // I have an array of check boxes so i would have to sanatize that, here
        // i skip it.

        $spaceAllowedPages = array("form.php");

        if (!empty($_GET)) {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            foreach ($_GET as $key => $value) {
                $_GET[$key] = sanitize($value, false);
            }
        }
        
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Process security check.
        //
        
        if (!securityCheck($path_parts, $yourURL)) {
            print "<p>Login failed: " . date("F j, Y") . " at " . date("h:i:s") . "</p>\n";
            die("<p>Sorry you cannot access this page. Security breach detected and reported</p>");
        }

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Set up database connection
        //
        
        $dbUserName = get_current_user() . '_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);
        
        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);
        
        $dbUserName = get_current_user() . '_admin';
        $whichPass = "a";
        $thisDatabaseAdmin = new Database($dbUserName, $whichPass, $dbName);
        ?>	

    </head>

    <!-- **********************     Body section      ********************** -->
    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    include "header.php";
    include "nav.php";
    ?>