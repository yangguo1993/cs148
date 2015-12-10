<?php include ("top.php"); ?>
<?php require("connect.php"); ?>
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
        <h2>Admin Interface</h2>
        <article id="main1">


            <!-- %%%%%%%%%%%% USER TABLE FORM %%%%%%%%%%%%%% -->
            <?php
            //List box

            if (isset($_CLEAN['POST']["lstUserID"])) {
                $lstUserID = $_CLEAN['POST']["lstUserID"];
            }
            ?>

            <!-- Set Button -->
            <?php
            if (isset($_POST['setUserID'])) {

                $userID = $_POST['lstUserID'];








                $sql = "SELECT * ";
                $sql .= "FROM tblUser ";
                $sql .= "WHERE pkUserId='$userID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();



// If there is a pkUserName with that number
                if ($count == 1) {


//Set Trainer Name
//fldTrainerName, fldFirstName, fldLastName, fldEmail, fldGender
                    $sql = "SELECT * " .
                            "FROM tblUser " .
                            "WHERE pkUserId ='$userID'";

//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();



                    foreach ($result as $poke) {
                        $trainerName = $poke['fldTrainerName'];
                    }

                    foreach ($result as $poke) {
                        $password = $poke['fldPassword'];
                    }

                    foreach ($result as $poke) {
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
                    }

                    foreach ($result as $poke) {
                        $species1 = $poke['fldSpecies'];
                    }
                } else {
                    die('Invalid User ID');
                }




//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not update data');
                }
            }
            ?>





            <!-- Update Button -->
            <?php
            if (isset($_POST['update'])) {

                $userID = $_POST['lstUserID'];
                $trainerName = $_POST['fldTrainerName'];
                $password = $_POST['fldPassword'];
                $firstName = $_POST['fldFirstName'];
                $lastName = $_POST['fldLastName'];
                $email = $_POST['fldEmail'];
                $gender = $_POST['fldGender'];
                $species = $_POST['fldSpecies'];






                $sql = "SELECT * ";
                $sql .= "FROM tblUser ";
                $sql .= "WHERE pkUserId='$userID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();


// If there is a pkUserName with that number
                if ($count == 1) {




                    $sql = 'UPDATE tblUser SET fldTrainerName="' . $trainerName . '",';
                    $sql .= 'fldPassword="' . $password . '",';
                    $sql .= 'fldFirstName="' . $firstName . '",';
                    $sql .= 'fldLastName="' . $lastName . '",';
                    $sql .= 'fldEmail="' . $email . '",';
                    $sql .= 'fldSpecies="' . $species . '",';
                    $sql .= 'fldGender="' . $gender . '" ';
                    $sql .= 'WHERE pkUserId ="' . $userID . '"';


//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();
                }
                /* else {
                  die('Invalid User ID');
                  } */




//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not update data');
                }
                echo "Updated data successfully\n";
            }
            ?>




            <?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// %%%%%%%%%%% add button %%%%%%%%%%%%%%%%%%%%
            if (isset($_POST['add'])) {

                $userID = $_POST['lstUserID'];
                $trainerName = $_POST['fldTrainerName'];
                $password = $_POST['fldPassword'];
                $firstName = $_POST['fldFirstName'];
                $lastName = $_POST['fldLastName'];
                $email = $_POST['fldEmail'];
                $gender = $_POST['fldGender'];
                $species1 = $_POST['fldSpecies'];










                $sql = 'INSERT INTO tblUser SET fldTrainerName="' . $trainerName . '",';
                $sql .= 'fldPassword="' . $password . '",';
                $sql .= 'fldFirstName="' . $firstName . '",';
                $sql .= 'fldLastName="' . $lastName . '",';
                $sql .= 'fldEmail="' . $email . '",';
                $sql .= 'fldSpecies="' . $species . '",';
                $sql .= 'fldGender="' . $gender . '"';


//mysql_select_db('test_db');

                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();






//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not add data');
                }
                echo "Added data successfully\n";
            }
            ?>
















            <!-- Delete Record -->

            <?php
            if (isset($_POST['delete'])) {

                $userID = $_POST['lstUserID'];
                $trainerName = $_POST['fldTrainerName'];







                $sql = "SELECT * ";
                $sql .= "FROM tblUser ";
                $sql .= "WHERE pkUserId='$userID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();



// If there is a pkUserName with that number
                if ($count == 1) {


                    $sql = "DELETE FROM tblUser " .
                            "WHERE pkUserId ='$userID'";

//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();
                } else {
                    die('Invalid User ID');
                }





//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not delete data');
                }
                echo "Deleted data successfully\n";
//mysql_close($conn);
            }




//else
//{
            ?>




            <form action="#" 
                  method="post"
                  id="frmEditUser"
                  enctype="multipart/form-data">


                <fieldset class="userInformation">
                    <legend>User Information</legend>


            <?php
//make a query to get all the users
            $sql = 'SELECT * ';
            $sql .= 'FROM tblUser ';
//$sql .= 'WHERE  ';
            $sql .= 'ORDER BY pkUserId';


            $stmt = $db->prepare($sql);

            $stmt->execute();

            $userResult = $stmt->fetchAll();


// build list box
            print '<fieldset class="listbox"><legend>User ID</legend><select name="lstUserID" size="1" tabindex="100">';

            foreach ($userResult as $poke) {
                print '<option value="' . $poke['pkUserId'] . '">' . $poke['pkUserId'] . "</option>\n";
            }

            print "</select>\n";
            print "</fieldset>\n";
            ?>





                    <!-- set button -->
                    <input name="setUserID" type="submit" id="setUserID" value="Set">

                    <!-- delete button -->
                    <input name="delete" type="submit" id="delete" value="Delete">

                    <br>


                    <label for="fldTrainerName" class="required">Trainer Name</label>
                    <input type="text" id="fldTrainerName" name="fldTrainerName" value="<?php echo $trainerName; ?>"
                          tabindex="110" maxlength="25"> <!--required placeholder="enter password"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldPassword" class="required">Password</label>
                    <input type="text" id="fldPassword" name="fldPassword" value="<?php echo $password; ?>"
                          tabindex="111" maxlength="25"> <!--required placeholder="enter password"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>


                    <label for="fldFirstName" class="required">First Name</label>
                    <input type="text" id="fldFirstName" name="fldFirstName" value="<?php echo $firstName; ?>"
                          tabindex="112" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldLastName" class="required">Last Name</label>
                    <input type="text" id="fldLastName" name="fldLastName" value="<?php echo $lastName; ?>"
                          tabindex="114" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldEmail" class="required">Email</label>
                    <input type="text" id="fldEmail" name="fldEmail" value="<?php echo $email; ?>"
                          tabindex="116" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldGender" class="required">Gender</label>
                    <input type="text" id="fldGender" name="fldGender" value="<?php echo $gender; ?>"
                          tabindex="118" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldSpecies" class="required">Your Pokemon</label>
                    <input type="text" id="fldSpecies" name="fldSpecies" value="<?php echo $species1; ?>"
                          tabindex="119" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>










                    <br>



                    <input type="submit" id="update" name="update" value="Update" tabindex="991" class="button"/>


                    <input type="submit" id="add" name="add" value="Add" tabindex="995" class="button"/>



                </fieldset>
            </form>



            <!-- %%%%%%%%%%%%%%% POKEMON TABLE FORM %%%%%%%%%%%%% -->



<?php
//List box

if (isset($_CLEAN['POST']["lstPokemonID"])) {
    $lstPokemonID = $_CLEAN['POST']["lstPokemonID"];
}
?>

            <!-- Set Button -->
<?php
if (isset($_POST['setPokemonID'])) {

    $pokemonID = $_POST['lstPokemonID'];








    $sql = "SELECT * ";
    $sql .= "FROM tblPokemon ";
    $sql .= "WHERE pkPokemonId='$pokemonID'  ";
    $stmt = $db->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetchAll();

    $count = $stmt->rowCount();



// If there is a pkUserName with that number
    if ($count == 1) {


//Set Trainer Name
//fldTrainerName, fldFirstName, fldLastName, fldEmail, fldGender
        $sql = "SELECT * " .
                "FROM tblPokemon " .
                "WHERE pkPokemonId ='$pokemonID'";

//mysql_select_db('test_db');

        $stmt = $db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();



        foreach ($result as $poke) {
            $species = $poke['fldSpecies'];
        }

        foreach ($result as $poke) {
            $type = $poke['fldType'];
        }

        foreach ($result as $poke) {
            $pokemonImage = $poke['fldImage'];
        }

        foreach ($result as $poke) {
            $health = $poke['fldHealth'];
        }

        foreach ($result as $poke) {
            $attack = $poke['fldAttack'];
        }

        foreach ($result as $poke) {
            $defense = $poke['fldDefense'];
        }
    } else {
        die('Invalid Pokemon ID');
    }




//$retval = mysql_query( $sql, $db );
    if (!$stmt) {
        die('Could not update data');
    }
}
?>




            <!-- Update Button -->
            <?php
            if (isset($_POST['updatePokemon'])) {

                $pokemonID = $_POST['lstPokemonID'];
                $species = $_POST['fldSpecies'];
                $type = $_POST['fldType'];
                $pokemonImage = $_POST['fldImage'];
                $health = $_POST['fldHealth'];
                $attack = $_POST['fldAttack'];
                $defense = $_POST['fldDefense'];






                $sql = "SELECT * ";
                $sql .= "FROM tblPokemon ";
                $sql .= "WHERE pkPokemonId='$pokemonID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();



// If there is a pkPokemonId with that number
                if ($count == 1) {




                    $sql = 'UPDATE tblPokemon SET fldSpecies="' . $species . '",';
                    $sql .= 'fldType="' . $type . '",';
                    $sql .= 'fldImage="' . $pokemonImage . '",';
                    $sql .= 'fldHealth="' . $health . '",';
                    $sql .= 'fldAttack="' . $attack . '",';
                    $sql .= 'fldDefense="' . $defense . '" ';
                    $sql .= 'WHERE pkPokemonId ="' . $pokemonID . '"';




//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();
                } else {
                    die('Invalid Pokemon ID');
                }




//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not update data');
                }
                echo "Updated data successfully\n";
            }
            ?>



            <!-- ADD Button -->
            <?php
            if (isset($_POST['addPokemon'])) {


                $species = $_POST['fldSpecies'];
                $type = $_POST['fldType'];
                $pokemonImage = $_POST['fldImage'];
                $health = $_POST['fldHealth'];
                $attack = $_POST['fldAttack'];
                $defense = $_POST['fldDefense'];








                $sql = 'INSERT INTO tblPokemon SET fldSpecies="' . $species . '",';
                $sql .= 'fldType="' . $type . '",';
                $sql .= 'fldImage="' . $pokemonImage . '",';
                $sql .= 'fldHealth="' . $health . '",';
                $sql .= 'fldAttack="' . $attack . '",';
                $sql .= 'fldDefense="' . $defense . '"';




//mysql_select_db('test_db');

                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();






//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not update data');
                }
                echo "Updated data successfully\n";
            }
            ?>
























            <!-- Delete Record -->

            <?php
            if (isset($_POST['deletePokemon'])) {

                $pokemonID = $_POST['lstPokemonID'];
                $species = $_POST['fldSpecies'];







                $sql = "SELECT * ";
                $sql .= "FROM tblPokemon ";
                $sql .= "WHERE pkPokemonId='$pokemonID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();



// If there is a pkUserName with that number
                if ($count == 1) {


                    $sql = "DELETE FROM tblPokemon " .
                            "WHERE pkPokemonId ='$pokemonID'";

//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();
                } else {
                    die('Invalid Pokemon ID');
                }





//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not delete data');
                }
                echo "Deleted data successfully\n";
//mysql_close($conn);
            }




//else
//{
            ?>




            <form action="#" 
                  method="post"
                  id="frmEditPokemon"
                  enctype="multipart/form-data">


                <fieldset class="pokemonInformation">
                    <legend>Pokemon Information</legend>


            <?php
//make a query to get all the users
            $sql = 'SELECT * ';
            $sql .= 'FROM tblPokemon ';
//$sql .= 'WHERE  ';
            $sql .= 'ORDER BY pkPokemonId';


            $stmt = $db->prepare($sql);

            $stmt->execute();

            $pokemonResult = $stmt->fetchAll();


// build list box
            print '<fieldset class="listbox"><legend>Pokemon ID</legend><select name="lstPokemonID" size="1" tabindex="1000">';

            foreach ($pokemonResult as $poke) {
                print '<option value="' . $poke['pkPokemonId'] . '">' . $poke['pkPokemonId'] . "</option>\n";
            }

            print "</select>\n";
            print "</fieldset>\n";
            ?>





                    <!-- set button -->
                    <input name="setPokemonID" type="submit" id="setPokemonID" value="Set">

                    <!-- delete button -->
                    <input name="deletePokemon" type="submit" id="deletePokemon" value="Delete">

                    <br>


                    <label for="fldSpecies" class="required">Species</label>
                    <input type="text" id="fldSpecies" name="fldSpecies" value="<?php echo $species; ?>"
                          tabindex="1100" maxlength="25"> <!--required placeholder="enter password"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>




                    <label for="fldType" class="required">Type</label>
                    <input type="text" id="fldType" name="fldType" value="<?php echo $type; ?>"
                          tabindex="1120" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldImage" class="required">Image File</label>
                    <input type="text" id="fldImage" name="fldImage" value="<?php echo $pokemonImage; ?>"
                          tabindex="1140" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldHealth" class="required">Health</label>
                    <input type="text" id="fldHealth" name="fldHealth" value="<?php echo $health; ?>"
                          tabindex="1160" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldAttack" class="required">Attack</label>
                    <input type="text" id="fldAttack" name="fldAttack" value="<?php echo $attack; ?>"
                          tabindex="1180" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldDefense" class="required">Defense</label>
                    <input type="text" id="fldDefense" name="fldDefense" value="<?php echo $defense; ?>"
                          tabindex="1180" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>









                    <br>



                    <input type="submit" id="updatePokemon" name="updatePokemon" value="Update" tabindex="991" class="button"/>
                    <input type="submit" id="addPokemon" name="addPokemon" value="Add" tabindex="992" class="button"/>


                </fieldset>
            </form>
















            <!-- %%%%%%%%%%%% GYM LEADER TABLE FORM %%%%%%%%%%%%%% -->
<?php
//List box

if (isset($_CLEAN['POST']["lstGymLeaderID"])) {
    $lstGymLeaderID = $_CLEAN['POST']["lstGymLeaderID"];
}
?>

            <!-- Set Button -->
<?php
if (isset($_POST['setGymLeaderID'])) {

    $gymLeaderID = $_POST['lstGymLeaderID'];








    $sql = "SELECT * ";
    $sql .= "FROM tblGymLeaders ";
    $sql .= "WHERE pkGymLeaderId='$gymLeaderID'  ";
    $stmt = $db->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetchAll();

    $count = $stmt->rowCount();



// If there is a pkUserName with that number
    if ($count == 1) {



        $sql = "SELECT * " .
                "FROM tblGymLeaders " .
                "WHERE pkGymLeaderId ='$gymLeaderID'";

//mysql_select_db('test_db');

        $stmt = $db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();



        foreach ($result as $poke) {
            $gymLeaderName = $poke['fldName'];
        }

        foreach ($result as $poke) {
            $gymLeaderType = $poke['fldType'];
        }

        foreach ($result as $poke) {
            $badge = $poke['fldBadge'];
        }

        foreach ($result as $poke) {
            $region = $poke['fldRegion'];
        }

        foreach ($result as $poke) {
            $location = $poke['fldLocation'];
        }

        foreach ($result as $poke) {
            $description = $poke['fldDescription'];
        }

        foreach ($result as $poke) {
            $gymLeaderImage = $poke['fldImage'];
        }
    } else {
        die('Invalid Gym Leader ID');
    }




//$retval = mysql_query( $sql, $db );
    if (!$stmt) {
        die('Could not update data');
    }
}
?>





            <!-- Update Button -->
            <?php
            if (isset($_POST['updateGymLeader'])) {

                $gymLeaderID = $_POST['lstGymLeaderID'];
                $gymLeaderName = $_POST['fldGymLeaderName'];
                $gymLeaderType = $_POST['fldGymLeaderType'];
                $badge = $_POST['fldBadge'];
                $region = $_POST['fldRegion'];
                $location = $_POST['fldLocation'];
                $description = $_POST['fldDescription'];
                $gymLeaderImage = $_POST['fldGymLeaderImage'];






                $sql = "SELECT * ";
                $sql .= "FROM tblGymLeaders ";
                $sql .= "WHERE pkGymLeaderId='$gymLeaderID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();


// If there is a pkGymLeader with that number
                if ($count == 1) {




                    $sql = 'UPDATE tblGymLeaders SET fldName="' . $gymLeaderName . '",';
                    $sql .= 'fldType="' . $gymLeaderType . '",';
                    $sql .= 'fldBadge="' . $badge . '",';
                    $sql .= 'fldRegion="' . $region . '",';
                    $sql .= 'fldLocation="' . $location . '",';
                    $sql .= 'fldDescription="' . $description . '",';
                    $sql .= 'fldImage="' . $gymLeaderImage . '" ';
                    $sql .= 'WHERE pkGymLeaderId ="' . $gymLeaderID . '"';


//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();
                }





//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not update data');
                }
                echo "Updated data successfully\n";
            }
            ?>




            <?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// %%%%%%%%%%% add button %%%%%%%%%%%%%%%%%%%%
            if (isset($_POST['addGymLeader'])) {

                $gymLeaderID = $_POST['lstGymLeaderID'];
                $gymLeaderName = $_POST['fldGymLeaderName'];
                $gymLeaderType = $_POST['fldGymLeaderType'];
                $badge = $_POST['fldBadge'];
                $region = $_POST['fldRegion'];
                $location = $_POST['fldLocation'];
                $description = $_POST['fldDescription'];
                $gymLeaderImage = $_POST['fldGymLeaderImage'];










                $sql = 'INSERT INTO tblGymLeaders SET fldName="' . $gymLeaderName . '",';
                $sql .= 'fldType="' . $gymLeaderType . '",';
                $sql .= 'fldBadge="' . $badge . '",';
                $sql .= 'fldRegion="' . $region . '",';
                $sql .= 'fldLocation="' . $location . '",';
                $sql .= 'fldDescription="' . $description . '",';
                $sql .= 'fldImage="' . $gymLeaderImage . '"';


//mysql_select_db('test_db');

                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();






//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not add data');
                }
                echo "Added data successfully\n";
            }
            ?>












            <!-- Delete Record -->

            <?php
            if (isset($_POST['deleteGymLeader'])) {

                $gymLeaderID = $_POST['lstGymLeaderID'];
                $gymLeaderName = $_POST['fldName'];







                $sql = "SELECT * ";
                $sql .= "FROM tblGymLeaders ";
                $sql .= "WHERE pkGymLeaderId='$gymLeaderID'  ";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $result = $stmt->fetchAll();

                $count = $stmt->rowCount();



// If there is a pkUserName with that number
                if ($count == 1) {


                    $sql = "DELETE FROM tblGymLeaders " .
                            "WHERE pkGymLeaderId ='$gymLeaderID'";

//mysql_select_db('test_db');

                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    $result = $stmt->fetchAll();
                } else {
                    die('Invalid Gym Leader ID');
                }





//$retval = mysql_query( $sql, $db );
                if (!$stmt) {
                    die('Could not delete data');
                }
                echo "Deleted data successfully\n";
//mysql_close($conn);
            }




//else
//{
            ?>




            <form action="#" 
                  method="post"
                  id="frmEditUser"
                  enctype="multipart/form-data">


                <fieldset class="gymLeaderInformation">
                    <legend>Gym Leader Information</legend>


            <?php
//make a query to get all the users
            $sql = 'SELECT * ';
            $sql .= 'FROM tblGymLeaders ';
//$sql .= 'WHERE  ';
            $sql .= 'ORDER BY pkGymLeaderId';


            $stmt = $db->prepare($sql);

            $stmt->execute();

            $userResult = $stmt->fetchAll();


// build list box
            print '<fieldset class="listbox"><legend>Gym Leader ID</legend><select name="lstGymLeaderID" size="1" tabindex="2000">';

            foreach ($userResult as $poke) {
                print '<option value="' . $poke['pkGymLeaderId'] . '">' . $poke['pkGymLeaderId'] . "</option>\n";
            }


            print "</select>\n";
            print "</fieldset>\n";
            ?>





                    <!-- set button -->
                    <input name="setGymLeaderID" type="submit" id="setGymLeaderID" value="Set">

                    <!-- delete button -->
                    <input name="deleteGymLeader" type="submit" id="deleteGymLeader" value="Delete">

                    <br>


                    <label for="fldGymLeaderName" class="required">Gym Leader Name</label>
                    <input type="text" id="fldGymLeaderName" name="fldGymLeaderName" value="<?php echo $gymLeaderName; ?>"
                          tabindex="20001" maxlength="25"> <!--required placeholder="enter password"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldGymLeaderType" class="required">Type</label>
                    <input type="text" id="fldGymLeaderType" name="fldGymLeaderType" value="<?php echo $gymLeaderType; ?>"
                          tabindex="2002" maxlength="25"> <!--required placeholder="enter password"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>


                    <label for="fldBadge" class="required">Badge</label>
                    <input type="text" id="fldBadge" name="fldBadge" value="<?php echo $badge; ?>"
                          tabindex="20002" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldRegion" class="required">Region</label>
                    <input type="text" id="fldRegion" name="fldRegion" value="<?php echo $region; ?>"
                          tabindex="2003" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldLocation" class="required">Location</label>
                    <input type="text" id="fldLocation" name="fldLocation" value="<?php echo $location; ?>"
                          tabindex="2004" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldDescription" class="required">Description</label>
                    <input type="text" id="fldDescription" name="fldDescription" value="<?php echo $description; ?>"
                          tabindex="2005" maxlength="9000"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>

                    <label for="fldGymLeaderImage" class="required">Image</label>
                    <input type="text" id="fldGymLeaderImage" name="fldGymLeaderImage" value="<?php echo $gymLeaderImage; ?>"
                          tabindex="2006" maxlength="25"> <!--required placeholder="enter your trainer name"<?php if ($firstNameERROR) echo 'class="mistake"' ?>>--><br>










                    <br>



                    <input type="submit" id="updateGymLeader" name="updateGymLeader" value="Update" tabindex="3000" class="button"/>


                    <input type="submit" id="addGymLeader" name="addGymLeader" value="Add" tabindex="3001" class="button"/>



                </fieldset>
            </form>














        </article>


                    <?php include ("footer.php"); ?>

    </section>
</body>
</html>