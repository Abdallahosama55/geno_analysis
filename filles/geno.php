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
    <section class="land-container">
    <nav>
   <div class="navbar">
<div class="logo"><a href="#">Geno Analysis</a></div>
<ul class="links">
<li><a href="#home">home</a></li>
<li><a href="#about">about</a></li>
<li><a href="#overview">overview</a></li>

</ul>
<a href="#" class="action-btn" onclick="show()">Get started</a>
<div class="toggle-btn">

    <i class="fa fa-bars" aria-hidden="true"></i>

</div>



   </div>

   <div class="dropdown_menu ">



   
<ul class="links">
<li><a href="#home">home</a></li>
<li><a href="#about">about</a></li>
<li><a href="#contact">contact</a></li>
<li><a href="#" class="action-btn" onclick="show()">Register Now</a></li>
</ul>
   </div>
</nav>
    <div class="text-landpage">
<h1> Welcome, Bioinformatics Tool  <br>Save your time in the lab and<br> start now</h1>
<a href="#"><button class="buttun_rgistr buttn"  onclick="show()">Register Now</button></a>
    </div>



    

<div class="wrapper" id="log-form">
  <i class="fa fa-times" aria-hidden="true" style="float:right;font-size: x-large;color: white;"  onclick="hide()"></i>
    <div class="title-text">
      <div class="title login">Login Form</div>
      <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Signup</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">
        <form action="signin.php" class="login" method="post">
          <div class="field">
            <input type="text" placeholder="Email Address" name="email" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Password" name="password" required>
          </div>
       
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="">Signup now</a></div>
        </form>
        <form  class="signup" action="register.php" method="post">
          <div class="field">
            <input type="text" placeholder="Username" name="name" required>
          </div>
          <div class="field">
            <input type="text" placeholder="Email Address" name="email"required>
          </div>
          <div class="field">
            <input type="password" placeholder="Password" name="password" required>
          </div>
         
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Signup">
          </div>
        </form>
      </div>
    </div>
  </div>
<script>

const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
      
     function hide(){
        document.getElementById('log-form').style.display='none';
      }

      function show(){
        document.getElementById('log-form').style.display='block';
      }

</script>
</section>
<div  class="about" id="overview">
  <h3  style="text-transform: capitalize;">A bioinformatics tool that performs the most important biological processes in <br>an easy way specialized in genome<br> data analysis</h3>
  </div>
<section class="about-tool">

<div class="containrs" >
    

</div>








<section class="members-container" id="about">
  <h2 style="color: rgb(43, 43, 43);text-align: center;padding:30px;border:#0097b2;"><span style="color:#0097b2 ">About</span> tool</h2>
    

<div class="row">

<div class="coll" >
  <div class="card">

  
  <h3>GC content</h3>
  <p>GC-content Calculates the percentage of nitrogenous bases in a DNA or RNA molecule that are either guanine or cytosine</p>
  
  </div>
  </div>
  <div class="coll">
    <div class="card">
   
    
    <h3>Most Frequent K-mer</h3>
    <p> Finds the most frequent k-mers in a string</p>
    
    </div>
</div>

    <div class="coll">
      <div class="card">
   
      
      <h3>Protein translation</h3>
      <p >It translates the RNA string into Amino Acids</p>
      
      
      </div>
</div>

<div class="coll ">
    <div class="card">
  
    
    <h3>Dna Transcription</h3>
    <p>The goal of transcription is to make a RNA copy of a gene's DNA sequence </p>
    
    
    </div>
</div>
<div class="coll ">
    <div class="card">
  
    
    <h3>Detect stop coden </h3>
    <p>check if the seq has any of the 3 stop codons.
 or not    </p>
    
    
    </div>
</div>
<div class="coll ">
    <div class="card">
  
    
    <h3>reverse complement </h3>
    <p>convert dna seq to complement and then get the reverse order.</p>
    
    
    </div>
</div>

</div>

</section>














</section>
2

<footer>



    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0097b2" fill-opacity="1" d="M0,192L40,170.7C80,149,160,107,240,80C320,53,400,43,480,85.3C560,128,640,224,720,240C800,256,880,192,960,160C1040,128,1120,128,1200,122.7C1280,117,1360,107,1400,101.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
      </svg>
</footer>
    <script>


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
    </script>
</body>





<?php
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
if (empty($name) || empty($email) || empty($pass)) {
    // Show an error message
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Show an error message
  } elseif (strlen($pass) < 8) {
    // Show an error message
  } else {
    // Data is valid, continue with registration
  }


  $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "bioserver";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert user into database
$sql = "INSERT INTO users (name, email, pass) VALUES ('$name', '$email', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
  // Redirect to confirmation page or log user in
} else {
  // Show an error message
}

$conn->close();


header("Location: geno2.php");
exit();
?>



