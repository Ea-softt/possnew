<?php
include('server/config.php');

// Get all table names
$tables = array();
$result = $conn->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
while ($row = $result->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}

$return = '';

// Loop through each table
foreach ($tables as $table) {
    // Get table structure
    $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
    $row2 = $conn->query("SELECT sql FROM sqlite_master WHERE name='" . $table . "'")->fetch(PDO::FETCH_NUM);
    $return .= "\n\n" . $row2[0] . ";\n\n";

    // Get table data
    $result = $conn->query("SELECT * FROM " . $table);
    $num_fields = $result->columnCount();
    $rows = $result->fetchAll(PDO::FETCH_NUM);

    foreach ($rows as $row) {
        $return .= "INSERT INTO " . $table . " VALUES(";
        for ($j = 0; $j < $num_fields; $j++) {
            $row[$j] = addslashes($row[$j]);
            if (isset($row[$j])) {
                $return .= '"' . $row[$j] . '"';
            } else {
                $return .= '""';
            }
            if ($j < ($num_fields - 1)) {
                $return .= ',';
            }
        }
        $return .= ");\n";
    }
    $return .= "\n\n\n";
}

// Save the SQL file
$handle = fopen("D:/buckup.sql", "w+");
fwrite($handle, $return);
fclose($handle);
echo "1";
