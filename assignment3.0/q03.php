<?php

include "top.php";
?>
<h1>Q03</h1>
<?php
//now print out each record
$file = fopen("q03.sql", "r") or die("Error");
$query = fread($file, filesize("q03.sql"));
$columns= 6;
$result =$thisDatabaseReader->select($query);
$info2 = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);
//print $query;
$result1 = count($info2);
$highlight = 0; // used to highlight alternate rows
print "<p>Total Result " .$result1 ."</p>";






print "<table>";
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
