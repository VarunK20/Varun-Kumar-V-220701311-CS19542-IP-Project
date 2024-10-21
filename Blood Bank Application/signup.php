<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $blood_group = $_POST['blood_group'];
    $aadhar_number = $_POST['aadhar_number'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO donors (first_name, last_name, dob, gender, address, blood_group, aadhar_number, phone_number) VALUES ('$first_name', '$last_name', '$dob', '$gender', '$address_', '$blood_group', '$aadhar_number', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Successfully registered!');
                window.location.href='index.html';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
