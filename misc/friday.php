
<?php
include "top.php";
?>

<?php
//now print out each record
$columns= 2;
$query = 'SELECT fldFirstName, fldLastName FROM tblStudents Orders LIMIT 10';
$result =$thisDatabaseReader->select($query);
$info2 = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);
$result1 = count($info2);
$highlight = 0; // used to highlight alternate rows
print "<p>Total Result " .$result1 ."</p>";
print "<table>";
print '<tr><th>First Name</th><th>Last Name</th></tr>';

foreach ($info2 as $rec) {
    $highlight++;
    if ($highlight % 2 != 0) {
        $style = ' odd ';
    } else {
        $style = ' even ';
    }
    print '<tr class="' . $style . '">';
    for ($i = 0; $i < $columns; $i++) {
        print '<td>' . $rec[$i] . '</td>';
    }
    print '</tr>';
   
}
print "</table>";

include "footer.php";
?>
