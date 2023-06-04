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
  
  //echo "Connected successfully";

  $sql = "SELECT * FROM `archer`;";
  $result = $conn->query($sql);

  $data = array();
  if ($result->num_rows > 0) {
  // outputs data of each row
  while($row = $result->fetch_assoc()) {
    //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " Class: " . $row["classification_type"]. "<br>"; 
    $data[] = $row;
  }
} else {
  echo "0 results";
}

echo json_encode($data);

$conn->close();

?>
