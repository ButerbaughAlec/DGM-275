<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Form With Validation</title>
    <style>
        .error{
            color: blue;
        }
    </style>
</head>
<body>
<?php
$name = $last = $email = $website = "";
$nameErr = $lastErr = $emailErr = $websiteErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "A first name is required";
    } else {
        $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
}
if (empty($_POST["last"])) {
        $lastErr = "A last name is required";
    } else {
        $last = test_input($_POST["last"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$last)) {
      $lastErr = "Only letters and white space allowed"; 
    }
}
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }  
if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }    
  }    
       
    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form With Validation</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  First Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Last Name: <input type="text" name="last">
   <span class="error">* <?php echo $lastErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
   <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">
  <input type="reset" value="Reset" /> 
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $last;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
?>
     
          
                    
</body>
</html>