<?php
$servername = "localhost";  // Replace with your MySQL server name or IP address
$username = "root";      // Replace with your MySQL username
$password = "";      // Replace with your MySQL password
$dbname = "health";   // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['disease'])) {
    // print_r($_POST);
    $disease = $conn->real_escape_string($_POST['disease']); // Avoid SQL Injection
    $query = "SELECT disease.id, tests.test_name FROM disease LEFT JOIN tests ON disease.id = tests.disease_id WHERE disease.name = '$disease'"; 
    
    // Execute query
    $result = $conn->query($query);

    // Check if there are results
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Test name: " . $row["test_name"] . "<br>";
        }
    } 
    else {
        echo "No test found for disease " . $_POST['disease'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    text-align: center;
    margin-top: 20px;
}

label {
    font-weight: bold;
    
}

input[type="text"] {
    width: 500;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
.image-section {
    margin-top: 20px;
    text-align: center;
}

.image-section img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


    </style>
</head>
<body>
    <div class="box">
    <form method="post" action="gettest.php">
        <label for="disease">Enter Disease/Condition:</label><br>
        <input type="text" id="disease" name="disease" required><br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>


