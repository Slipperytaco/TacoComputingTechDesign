<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "archery_db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  
  // Get archer_id from request, with sanitization to prevent SQL Injection
  $archer_id = isset($_GET['archer_id']) ? intval($_GET['archer_id']) : 0;

  // Prepare SQL statement
  $stmt = $conn->prepare("SELECT * FROM `stage_score` WHERE `archer_id` = ? ORDER BY `datetime` ASC");
  $stmt->bind_param("i", $archer_id); // "i" indicates the variable type is an integer

  // Execute statement
  $stmt->execute();

  // Bind result variables
  $result = $stmt->get_result();

  $data = array();
  if ($result->num_rows > 0) {
    // outputs data of each row
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  } else {
    echo "No results found for archer_id: $archer_id";
  }

  // JSON encode the data array
  echo json_encode($data);

  $stmt->close();
  $conn->close();
?>
