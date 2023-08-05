
<?php
$user = 'root';
$password = '';
 
$database = 'bioserver';
 

$servername='localhost';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}

$sql = " SELECT * FROM gene ";
$result = $mysqli->query($sql);
$mysqli->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="geno.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    
</head>
<body>
  
    <nav>
   <div class="navbar">
<div class="logo"><a href="geno2.php">Geno Analysis</a></div>
<ul class="links">


</ul>
<a href="#" id="action-btn2" style="margin-left:65%;border-radius: 20px;padding: 0.25rem 0.5rem;  font-size: 0.92rem;font-weight: bold;color:#454545;
      cursor: pointer;
    border: 3px solid #09aacb ;"onclick="show_table()">Show Data</a>
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
<style>



table {
  border-collapse: collapse;
  width: 90%;

  height: auto; 
  margin-left:2.5%;
  font-size: 1em;

}

th, td {
    height: auto; 
  text-align: left;
 
  padding: 8px;
}


th {
  background-color: #09aacb;
  color: white;
  text-transform:capitalize;

}

tr:nth-child(even) {
  background-color: #f2f2f2;
  
}

tr:hover {
  background-color: #ddd;
}

caption {
  font-size: 1.2em;
  font-weight: bold;
  margin-bottom: 10px;
}

@media (max-width: 600px) {
  table {
    font-size: 0.8em;
    width: 100%;
  margin-left:0%;
  }
  
  th, td {
    padding: 4px;
    text-transform:capitalize;
  }
  
  caption {
    font-size: 1em;
  }



}
#table_result{
    display:none;
}
#table_result h1{
    text-align: center;
    padding:30px;
    color:#454545
}
#table_result button{
    background-color:#09aacb;
    border-radius:20px;
    padding:1.0em;
 border-style: none;
    font-weight:700;
    color: #f2f2f2;
    margin-left:45%;
    margin-top:4%;
    

}
</style>
<section id="table_result">
<h1>Genome records</h1>
		<!-- Making the table responsive -->
		<div style="overflow-x: auto;">
<table>

  <thead>
    <tr>
      <th>gene Id</th>
      <th>gene name</th>
      <th>gene sequance</th>
    </tr>
  </thead>
  <tbody >
 
  <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td width="39%"><?php echo $rows['GeneID'];?></td>
                <td width="39%"><?php echo $rows['GeneName'];?></td>
                <td  width="60%"><?php echo str_replace("\n", "<br>", $rows['Seq']);?></td>
   
            </tr>
            <?php
                }
            ?>

  </tbody>
</table>



        </div>
<button id="download-btn">Download Data</button>

<script>
function downloadTableAsCsv() {

  var tableData = [];
  var rows = document.querySelectorAll('table tr');
  for (var i = 0; i < rows.length; i++) {
    var row = [], cols = rows[i].querySelectorAll('td, th');
    for (var j = 0; j < cols.length; j++) {
      row.push(cols[j].innerText);
    }
    tableData.push(row.join(','));
  }

  // Download the CSV file
  var csvData = tableData.join('\n');
  var blob = new Blob([csvData], { type: 'text/csv' });
  var url = URL.createObjectURL(blob);
  var downloadLink = document.createElement('a');
  downloadLink.href = url;
  downloadLink.download = 'table_data.csv';
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);
}

document.querySelector('#download-btn').addEventListener('click', downloadTableAsCsv);




</script>
</section>

<section class="Geno" id="Geno">
    <div style="display:block">
    <div style="display: block;">
        <div class="geno-choose">
    <a href="#" onclick="show_form_insert()" id="insert_choose">Insert</a>
    <a href="#" id="update_choose" onclick="show_form_update()">update</a>
    <a href="#" onclick="show_form_delete()"id="delete_choose" >delete</a>
</div>

<form  id="insert" action="insertgene.php" method="post">
    <div >
    <label>Seq id</label>
 
    <input type="number" name="genid"placeholder="id of gene which will Inserted" required>
    <label>Gene name</label>
<input type="text" name="gname" placeholder="name of gene which will Inserted" required>
</div>
    <label>Seq</label>

<textarea name="seq" required  placeholder=" enter Sequance of gene here please "></textarea>

<input type="submit" value="Insert" name="submit_insert" >
</form>
   
    <form class="update" id="update" method="post" action="updategene.php">
        <div >
        <label>Seq id</label>
     
        <input type="number" name="genid_update" placeholder="id of gene which will update">
        <label>Seq name</label>
    <input type="text" name="gname_update" placeholder="name of gene after update">
    </div>
        <label>Seq</label>
    
    <textarea name="seq_update" placeholder="sequance of gene after update"></textarea>
    
    <input type="submit" value="update" name="Insert_update">
    </form>


    <form class="delete" id="delete" method="post" action="insertgene.php">
        <div>
        <label>Seq id</label>
        <input type="number"  placeholder="id gene which want to delete" name="iddel">
        <br>
        <h3 style="color:gray">OR</h3>
        <label>Seq name</label>
    <input type="text" placeholder="name gene which want to delete" name="namedel">
    </div>
    
    
    <input type="submit" value="delete">
    </form>


    <?php if (isset($_GET['success']) &&  $_GET['success'] == 1) { ?>
    <div style="margin-top:5px;background-color:#0194ae18;padding:15px;border-radius:9px" id="myDiv">
    <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
      Record inserted successfully!
    </div>

    
  <?php 
 


 unset($_GET['success']);
 // Unset the "success" URL parameter
    }

 
 ?>



<?php if (isset($_GET['success']) &&  $_GET['success'] == 2) { ?>
    <div style="margin-top:5px;background-color:#0194ae18;padding:15px;border-radius:9px" id="myDiv2">
    <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
      Record Updated successfully!
    </div>

    
  <?php 
 

unset($_GET['success']);
 
 // Unset the "success" URL parameter
    }

 
 ?>


<?php if (isset($_GET['success']) &&  $_GET['success'] == 2) { ?>
    <div style="margin-top:5px;background-color:#0194ae18;padding:15px;border-radius:9px" id="myDiv3">
    <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
      Record Deleted successfully!
    </div>

    
  <?php 
 

unset($_GET['success']);
 
 // Unset the "success" URL parameter
    }

 
 ?>

 </form>

<script>
// Get a reference to the div element
var myDiv = document.getElementById('myDiv');

// Hide the div after 5 seconds
setTimeout(function() {
  myDiv.style.display = 'none';
}, 2000);



// Get a reference to the div element
var myDiv2 = document.getElementById('myDiv2');

// Hide the div after 5 seconds
setTimeout(function() {
  myDiv2.style.display = 'none';
}, 2000);




// Get a reference to the div element
var myDiv3 = document.getElementById('myDiv3');

// Hide the div after 5 seconds
setTimeout(function() {
  myDiv3.style.display = 'none';
}, 2000);
</script>
</div>


</div>

</section>



<section class="choose_process" id="choose_process">
<h1>Choose biological processes</h1>
<div  class="choose">
<form  action="functions.php" method="post"   >
    <select  id="bioprocess" onchange="show_form()">
        <option value=""  >choose</option>
        <option value="1" name="biopro">transcription</option>
        <option value="2"name="biopro">translation</option>
        <option value="3" name="biopro">Gc Content</option>
        <option value="4" name="biopro">Most Frequent K-mer</option>
        <option value="5" name="biopro">Detect stop coden</option>
        <option value="6" >reverse complement</option>
    </select>
  </form>

</div>
</section>
<div class="icon_dna" id="icon_dna">
    <img src="madia/Pink and Brown Minimalist Beauty Salon & Spa Presentation (15).png">
</div>
<section class="bio-forms" id="k-mer">
  
<form action="functions.php" method="post">

    <h2 style=>Most Frequent K-mer</h2>
    <input name="GeneId" type="text" placeholder="enter GeneId here" required >
    <input type="number" name="K" placeholder="K" style="margin-left:35%;border:3px solid #9FE8FA;text-align:center" required>

    <input type="submit" value="GetKmer" name="Result_function" style="margin-top:50px">

</form>

</section>
<section class="bio-forms" id="GC-content">
  
    <form action="functions.php" method="post">
        <h2 style=>GC content</h2>
        <input name="GeneId" type="text" placeholder="enter GeneId here" >

        <input type="submit" value="GetGC" name="Result_function">
  
    </form>
    
    </section>
    <section class="bio-forms" id="Dna-translation">
  
        <form action="functions.php" method="post">
        
            <h2 style=>Protein translation</h2>
            <input name="GeneId" type="text" placeholder="enter GeneId here" >
   
            <input type="submit" value="GetProtein" name="Result_function">
  
        </form>
        
        </section>

        <section class="bio-forms" id="Reverse_Complement">
  
            <form action="functions.php" method="post">
            
                <h2 style=>Reverse Complement</h2>
                <input name="GeneId" type="text" placeholder="enter GeneId here" >
  
                <input type="submit" value="GetReverse" name="Result_function" >

            </form>
            </section>

            <section class="bio-forms" id="Dna-Transcription"  >
                <form action="functions.php" method="post">
                
                    <h2 style=>Dna Transcription</h2>
                    <input name="GeneId" type="text" placeholder="enter GeneId here" >
         
                    <input type="submit" value="GetRNA" name="Result_function">
       
                </form>
                </section>
                <section class="bio-forms" id="Stop-Coden">
  
                    <form action="functions.php" method="post">
                        <h2 style=>Detect Stop Coden</h2>
                        <input name="GeneId" type="text" placeholder="enter GeneId here" >
                     
                        <input type="submit" value="GetStopCoden" name="Result_function">
                  
                    </form>
                    
                    </section>
       
                    

                    <div style=" height:400px;;text-align: center;color: rgb(255, 255, 255);background-image: url('madia/wave\ \(1\).svg');background-size: cover;">
    
                        <div style=" text-align: center;top:370px;position: relative;">&copy; All Right reserved To Fcai-Bio-AAAH Team</div>
                        
                         
                        
                        </div>

</body>




<script>

      
     function hide(){
        document.getElementById('log-form').style.display='none';
      }

      function show(){
        document.getElementById('log-form').style.display='block';
      }

      const tog_butten=document.querySelector('.toggle-btn')

const tog_butten_icon=document.querySelector('.toggle-btn i')

const dropdownmenu=document.querySelector('.dropdown_menu')
tog_butten.onclick=function(){
    dropdownmenu.classList.toggle('open')
   
    const isOpen=dropdownmenu.classList.contains('open')
    tog_butten_icon.classList=isOpen
    ?'fa-solid fa-xmark'
    :'fa-solid fa-bars'
}
function show_form() {
if(document.getElementById('bioprocess').value=='1'){
document.getElementById('Dna-Transcription').style.display='block';
document.getElementById('Stop-Coden').style.display='none';
    document.getElementById('Reverse_Complement').style.display='none';
    document.getElementById('k-mer').style.display='none';
    document.getElementById('GC-content').style.display='none';
    document.getElementById('Dna-translation').style.display='none';
    document.getElementById('icon_dna').style.display='block';



}
else if(document.getElementById('bioprocess').value=='2'){
    document.getElementById('Dna-translation').style.display='block';
    document.getElementById('Dna-Transcription').style.display='none';
document.getElementById('Stop-Coden').style.display='none';
    document.getElementById('Reverse_Complement').style.display='none';
    document.getElementById('k-mer').style.display='none';
    document.getElementById('GC-content').style.display='none';
    document.getElementById('icon_dna').style.display='block';



}

else if(document.getElementById('bioprocess').value=='3'){
    document.getElementById('GC-content').style.display='block';
    document.getElementById('Stop-Coden').style.display='none';
    document.getElementById('Reverse_Complement').style.display='none';
    document.getElementById('k-mer').style.display='none';
  
    document.getElementById('Dna-translation').style.display='none';
    document.getElementById('Dna-Transcription').style.display='none';
    document.getElementById('icon_dna').style.display='block';


}
else if(document.getElementById('bioprocess').value=='4'){
    document.getElementById('k-mer').style.display='block';
    document.getElementById('Stop-Coden').style.display='none';
    document.getElementById('Reverse_Complement').style.display='none';

    document.getElementById('GC-content').style.display='none';
    document.getElementById('Dna-translation').style.display='none';
    document.getElementById('Dna-Transcription').style.display='none';
    document.getElementById('icon_dna').style.display='block';

}
else if(document.getElementById('bioprocess').value=='5'){
    document.getElementById('Stop-Coden').style.display='block';
    document.getElementById('Reverse_Complement').style.display='none';
    document.getElementById('k-mer').style.display='none';
    document.getElementById('GC-content').style.display='none';
    document.getElementById('Dna-translation').style.display='none';
    document.getElementById('Dna-Transcription').style.display='none';
    document.getElementById('icon_dna').style.display='block';


}
else if(document.getElementById('bioprocess').value=='6'){
    document.getElementById('Reverse_Complement').style.display='block';
    document.getElementById('Stop-Coden').style.display='none';
    document.getElementById('k-mer').style.display='none';
    document.getElementById('GC-content').style.display='none';
    document.getElementById('Dna-translation').style.display='none';
    document.getElementById('Dna-Transcription').style.display='none';
    
    document.getElementById('icon_dna').style.display='block';


}}

function show_form_insert(){

document.getElementById('insert').style.display="block";
document.getElementById('insert_choose').style.borderBottom="solid";
document.getElementById('update_choose').style.border="none";
document.getElementById('delete_choose').style.border="none";


document.getElementById('delete').style.display="none";

 document.getElementById('update').style.display="none";
};
function show_form_update(){

document.getElementById('update').style.display='block';
document.getElementById('insert').style.display='none';
document.getElementById('update_choose').style.borderBottom='solid';
document.getElementById('delete_choose').style.border='none';
document.getElementById('insert_choose').style.border='none';
document.getElementById('delete').style.display="none";
};

function show_form_delete(){
    document.getElementById('delete').style.display="block";
 document.getElementById('insert').style.display="none";
 document.getElementById('update').style.display="none";


document.getElementById('delete_choose').style.borderBottom="solid";
document.getElementById('update_choose').style.border="none";
document.getElementById('insert_choose').style.border="none";
};


function show_table(){
    document.getElementById('table_result').style.display="block";
    document.getElementById('Geno').style.display="none";
    document.getElementById('Reverse_Complement').style.display='none';
    document.getElementById('Stop-Coden').style.display='none';
    document.getElementById('k-mer').style.display='none';
    document.getElementById('GC-content').style.display='none';
    document.getElementById('Dna-translation').style.display='none';
    document.getElementById('Dna-Transcription').style.display='none';
    
    document.getElementById('icon_dna').style.display='none';
    document.getElementById('choose_process').style.display='none';

};


</script>


</html>
