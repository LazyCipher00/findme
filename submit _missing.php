<?php

$conn = new mysqli("localhost", "root", "", "missing_persons");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $last_seen = $_POST['last-seen'];
    $date_seen = $_POST['date'];
    
    
    $photo = $_FILES['photo'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo["name"]);
    move_uploaded_file($photo["tmp_name"], $target_file);
    
    
    $sql = "INSERT INTO persons (name, age, last_seen, date_seen, photo) 
            VALUES ('$name', '$age', '$last_seen', '$date_seen', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "Report submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
