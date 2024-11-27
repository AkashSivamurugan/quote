<?php
include 'config.php';

$sql = "SELECT * FROM quotations";
$result = $conn->query($sql);

$quotations = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $quotations[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

echo json_encode($quotations);
?>
