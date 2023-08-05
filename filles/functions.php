<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="geno.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
.big{
    color:red;
text-align: center;
    margin-top:3%;
    font-size: larger;
}
       
    </style>
</head>
<body>
 
    <nav>
   <div class="navbar">
<div class="logo"><a href="geno2.php">Geno Analysis</a></div>
<ul class="links">


</ul>

<a href="logout.php" class="action-btn">Sign out</a>
<div class="toggle-btn">

    <i class="fa fa-bars" aria-hidden="true"></i>

</div>



   </div>

   <div class="dropdown_menu ">



   
<ul class="links">
<li><a href="home">home</a></li>
<li><a href="about">Result</a></li>
<li><a href="contact">sign out</a></li>

</ul>
   </div>
</nav>
<section style="border:6px solid #40E0D0;margin-top:100px;width:30%;padding-bottom:50px;margin-left:35%">
<h1 style="text-align:center; margin-top:10%;">GET Result Here</h1>
<?php

// define functions to use later 

function GC_Content($seq){
    $GC = round((substr_count($seq, 'G') + substr_count($seq, 'C')) / strlen($seq) * 100);
    return $GC;
}

function dna_to_rna($dna_sequence) {
    $rna_sequence = str_replace('T', 'U', $dna_sequence);
    return $rna_sequence;
}

function reverse_complement($dna_sequence) {
    $reverse_sequence = strrev($dna_sequence);
    $complement_sequence = strtr($reverse_sequence, 'ATCG', 'TAGC');
    return $complement_sequence;
}

function find_stop_codons($rna_sequence) {
    $stop_codons = array('UAA', 'UAG', 'UGA');
    $indices = array();
    $SIndices ='';
    // Loop through the RNA sequence in increments of three
    for ($i = 0; $i < strlen($rna_sequence); $i += 3) {
        $codon = substr($rna_sequence, $i, 3);

        // Check if the codon is a stop codon
        if (in_array($codon, $stop_codons)) {
            // Add the index of the stop codon to the indices array
            $indices[] = $i;
            $SIndices .= "$i,";

        }
    }

    return $SIndices;
}

function TranslateRnatoProtein($seq){
    $protein ='';
    $codons = array(
        "GCA"=>"A", "GCC"=>"A", "GCG"=>"A", "GCU"=>"A",
        "UGC"=>"C", "UGU"=>"C", "GAC"=>"D", "GAU"=>"D",
        "GAA"=>"E", "GAG"=>"E", "UUC"=>"F", "UUU"=>"F",
        "GGA"=>"G", "GGC"=>"G", "GGG"=>"G", "GGU"=>"G",
        "CAC"=>"H", "CAU"=>"H", "AUA"=>"I", "AUC"=>"I",
        "AUU"=>"I", "AAA"=>"K", "AAG"=>"K", "UUA"=>"L",
        "UUG"=>"L", "CUA"=>"L", "CUC"=>"L", "CUG"=>"L",
        "CUU"=>"L", "AUG"=>"M", "AAC"=>"N", "AAU"=>"N",
        "CCA"=>"P", "CCC"=>"P", "CCG"=>"P", "CCU"=>"P",
        "CAA"=>"Q", "CAG"=>"Q", "AGA"=>"R", "AGG"=>"R",
        "CGA"=>"R", "CGC"=>"R", "CGU"=>"R", "CGG"=>"R",
        "AGC"=>"S", "AGU"=>"S", "UCA"=>"S", "UCC"=>"S",
        "UCG"=>"S", "UCU"=>"S", "ACA"=>"T", "ACC"=>"T",
        "ACG"=>"T", "ACU"=>"T", "GUA"=>"V", "GUC"=>"V",
        "GUG"=>"V", "GUU"=>"V", "UGG"=>"W", "UAC"=>"Y",
        "UAU"=>"Y", "UAG"=>"", "UAA"=>"", "UGA"=>""
    );
    $n = strlen($seq);
    for ($i = 0; $i < $n - 2; $i += 3) {
        $codon = substr($seq, $i, 3);
        if (isset($codons[$codon])) {
            $amino_acid = $codons[$codon];
            if ($amino_acid == '') {
                break;
            }
            $protein .= $amino_acid;
        }
    }
    return $protein;
}


function MostFrequentKmer($sequence, $k) {
    $n = strlen($sequence);
    $frequencies = array();
    for ($i = 0; $i <= $n - $k; $i++) {
        $kmer = substr($sequence, $i, $k);
        if (!isset($frequencies[$kmer])) {
        $frequencies[$kmer] = 0;
        }
        $frequencies[$kmer]++;
    }
    arsort($frequencies);
    $most_frequent = array_keys($frequencies)[0];
    return $most_frequent;
}

// Set up database connection variables
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bioserver";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{

}
if(isset($_POST['GeneId'])&&$_POST['GeneId']){
$genid = $_POST['GeneId'];
$functionxx =$_POST['Result_function'];
$query = "SELECT * FROM gene WHERE GeneID = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $genid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

}
// Step 4: Fetch the data from the result set

if(isset($_POST['Result_function'])&&$_POST['Result_function']){

if ($row = mysqli_fetch_assoc($result)) {
    $seq = $row['Seq'];
    // do something with the sequence
 


if ($functionxx == "GetRNA") {
    $outPut = dna_to_rna($seq);
    echo "<div class='big'>$outPut</div>";
    $conn = mysqli_connect($host, $username, $password, $dbname);

    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    

    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
elseif($functionxx == "GetProtein"){


    $outPut = TranslateRnatoProtein($seq);
echo "<div class='big'>$outPut</div>";


    $conn = mysqli_connect($host, $username, $password, $dbname);

    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    

    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
elseif($functionxx == "GetGC"){
    $outPut = GC_Content($seq);

    echo "<div class='big'>$outPut</div>";

    $conn = mysqli_connect($host, $username, $password, $dbname);


    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
elseif($functionxx == "GetKmer"){
    $k = $_POST['K'];
    $outPut = MostFrequentKmer($seq, $k);
    echo "<div class='big'>$outPut</div>";
    $conn = mysqli_connect($host, $username, $password, $dbname);

 
    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }



    $conn = mysqli_connect($host, $username, $password, $dbname);


    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
elseif($functionxx == "GetStopCoden"){

    $outPut = find_stop_codons($seq);
    echo "<div class='big'>$outPut</div>";

    $FirstStop= substr($outPut, 0, 1);

    $conn = mysqli_connect($host, $username, $password, $dbname);


    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }


    $conn = mysqli_connect($host, $username, $password, $dbname);

    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }


}
elseif($functionxx == "GetReverse"){
    $outPut = reverse_complement($seq);
    echo "<div class='big'>$outPut</div>";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    $query = "UPDATE gene SET AminoAcid = ? WHERE GeneID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $outPut, $genid);
    $result = mysqli_stmt_execute($stmt);
    
    if (!$result) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}}

} else {
    echo "";
  }
?>

</section>


<div style=" height:690px;text-align: center;color: rgb(255, 255, 255);background-image: url('madia/wave\ \(1\).svg');background-size: cover;">
    
    <div style=" text-align: center;top:650px;position: relative">&copy; All Right reserved To Fcai-Bio-AAAH Team</div>
    
     
    
    </div>



    </body>

</html>

