
<?php
// Set up database connection variables
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bioserver";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$gname = $_POST['gname'];
$genid = $_POST['genid'];
$seq = $_POST['seq'];
$submit_insert = $_POST['submit_insert'];

  

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'&& $_POST['submit_insert']=='Insert') {



// Prepare the SQL statement
$sql = "INSERT INTO gene (GeneID,GeneName,Seq) VALUES ('$genid','$gname','$seq')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    header("Location: geno2.php?success=1");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



}

$genidd_del = $_POST['iddel'];
$gennamme_del = $_POST['namedel'];

if (!empty($genidd_del)) {
  $sqll = "DELETE FROM gene WHERE GeneID=$genidd_del";
} elseif (!empty($gennamme_del)) {
  $sqll = "DELETE FROM gene WHERE GeneName='$gennamme_del'";
} else {
  echo "Error deleting record: missing required fields";
}

if (isset($sqll)) {
  if ($conn->query($sqll) === TRUE) {
    header("Location: geno2.php?success=3");
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}




// Close the database connection
$conn->close();

?>