<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quotation_no = $_POST['quotationNo'];
    $quotation_date = $_POST['quotationDate'];
    $valid_till_date = $_POST['validTillDate'];
    $business_name = $_POST['businessName'];
    $address = $_POST['address'];
    $client_name = $_POST['clientName'];
    $client_address = $_POST['clientAddress'];
    $items = json_encode($_POST['items']);
    $total = $_POST['total'];

    // Handle file upload
    $logo = '';
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $logo = 'uploads/' . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
    }

    $stmt = $conn->prepare("INSERT INTO quotations (quotation_no, quotation_date, valid_till_date, business_name, address, client_name, client_address, items, total, logo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssds", $quotation_no, $quotation_date, $valid_till_date, $business_name, $address, $client_name, $client_address, $items, $total, $logo);

    if ($stmt->execute()) {
        echo "New quotation created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
