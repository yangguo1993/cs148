
<?php
include "top.php";
?>
    <ul><li><a href="q01.php">q01.php</a></li></ul>
    <ul><li><a href="q02.php">q02.php</a></li></ul>
    <ul><li><a href="q03.php">q03.php</a></li></ul>
    <ul><li><a href="q04.php">q04.php</a></li></ul>
    <ul><li><a href="q05.php">q05.php</a></li></ul>
    <ul><li><a href="q06.php">q06.php</a></li></ul>
    <ul><li><a href="q07.php">q07.php</a></li></ul>
    <ul><li><a href="q08.php">q08.php</a></li></ul>
    <ul><li><a href="q09.php">q09.php</a></li></ul>
    <ul><li><a href="q10.php">q10.php</a></li></ul>
    

<?php
//now print out each record

    $query = 'SELECT * FROM ' . $tableName;
    $info2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
    $highlight = 0; // used to highlight alternate rows
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
    // all done
    print '</table>';
    print '</aside>';
print '</article>';
include "footer.php";
?>