<nav>
	<ol>
<?php
if(basename($_SERVER['PHP_SELF'])=="http://yguo2.w3.uvm.edu/cs148/assignment10/index.php"){
	print '<li class="activePage">Home</li>';
} else {
	print '<li><a href="http://yguo2.w3.uvm.edu/cs148/assignment10/index.php">Home</a></li>';
}
if(basename($_SERVER['PHP_SELF'])=="http://yguo2.w3.uvm.edu/cs148/assignment10/trainers.php"){
	print '<li class="activePage">Trainers</li>';
} else {
	print '<li><a href="http://yguo2.w3.uvm.edu/cs148/assignment10/trainers.php">Trainers</a></li>';
}
if(basename($_SERVER['PHP_SELF'])=="http://yguo2.w3.uvm.edu/cs148/assignment10/gymLeaders.php"){
	print '<li class="activePage">Gym Leaders</li>';
} else {
	print '<li><a href="http://yguo2.w3.uvm.edu/cs148/assignment10/gymLeaders.php">Gym Leaders</a></li>';
}

if(basename($_SERVER['PHP_SELF'])=="https://yguo2.w3.uvm.edu/cs148/assignment10/adminGUI/adminEdit.php"){
	print '<li class="activePage">Admin Interface</li>';
} else {
	print '<li><a href="yguo2.w3.uvm.edu/cs148/assignment10/adminGUI/adminEdit.php">Admin Interface</a></li>';
}


?>

	</ol>
</nav>
