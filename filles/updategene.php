<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bioserver";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$gnamee= $_POST['gname_update'];
$genidd = $_POST['genid_update'];
$seqq = $_POST['seq_update'];


  

$sql = "UPDATE gene SET  Seq='$seqq ' , GeneName='$gnamee' WHERE GeneID=$genidd";

if ($conn->query($sql) === TRUE) {
    header("Location: geno2.php?success=2");
} else {
  echo "Error updating record: " . $conn->error;
}




$conn->close();
?>