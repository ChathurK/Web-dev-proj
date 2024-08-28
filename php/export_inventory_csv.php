<?php
// Include database connection
include 'db_connect.php';

// Set headers to trigger file download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=inventory_report.csv');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, array('ID', 'Item Name', 'Category', 'Quantity', 'Price'));

// Fetch the data from the database
$sql = "SELECT id, name, category, quantity, price FROM item";
$result = $conn->query($sql);

// Loop over the rows and write them to the CSV file
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Write only the desired columns to the CSV file
        fputcsv($output, array($row['id'], $row['name'], $row['category'], $row['quantity'], $row['price']));
    }
}

// Close the file pointer and the database connection
fclose($output);
$conn->close();
?>
