<?php
// Include environment and database connection
require_once 'commons/env.php';
require_once 'commons/function.php';

// Connect to database
$conn = connectDB();

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Structure Analysis</title>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2, h3, h4 { color: #333; }
        table { border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>";

echo "<h2>Database Structure Analysis</h2>";

// Check tables
$tables = ['categories', 'products'];
foreach ($tables as $table) {
    echo "<h3>Table: $table</h3>";
    
    try {
        // Get table structure
        $stmt = $conn->prepare("DESCRIBE $table");
        $stmt->execute();
        $columns = $stmt->fetchAll();
        
        echo "<table>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        foreach ($columns as $column) {
            echo "<tr>";
            echo "<td>{$column['Field']}</td>";
            echo "<td>{$column['Type']}</td>";
            echo "<td>{$column['Null']}</td>";
            echo "<td>{$column['Key']}</td>";
            echo "<td>{$column['Default']}</td>";
            echo "<td>{$column['Extra']}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        // Get sample data
        echo "<h4>Sample Data (first 3 rows):</h4>";
        $stmt = $conn->prepare("SELECT * FROM $table LIMIT 3");
        $stmt->execute();
        $data = $stmt->fetchAll();
        
        if (!empty($data)) {
            echo "<table>";
            // Header row
            echo "<tr>";
            foreach (array_keys($data[0]) as $key) {
                if (!is_numeric($key)) {
                    echo "<th>$key</th>";
                }
            }
            echo "</tr>";
            
            // Data rows
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    if (!is_numeric($key)) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data found in table.</p>";
        }
        
    } catch (Exception $e) {
        echo "<p>Error examining table $table: " . $e->getMessage() . "</p>";
    }
    
    echo "<br>";
}

echo "</body>
</html>";
?>