<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="welcome">
    
<?php
echo  'Welcome: ' . get_current_user();
?>
</div>
<div class="clear">
<form action="dashboard.php">
       <input type = "submit" value="Clear All Data" onclick="w3_close()">
    </form>
    </div>

<div class="container">

<div class="sales">
 <?php
           define("DATABASE_HOST", "web212.mccdgm.net");
           define("DATABASE_USERNAME", "web212spr18");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
    
           if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }             
    ?>
    
    
<?php
$yearErr = "";
$year = "";    
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["year"])) {
    $yearErr = "Please select a year";
  } else {
    $year = test_input($_POST["year"]);
    // will see if input containts letters or anything besides numbers
    if (!preg_match("/^[1-9][0-9]*$/",$year)) {
      $yearErr = "Invalid entry";
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
<div class="form">
  <form action="dashboard.php" method="post">
            <h1>Sales Data</h1>
             Select Year: <input type="text" name="year" value="">
  <span class="error">* <?php echo $yearErr;?></span>
            
            <input type="submit" name="submit" value="Select Year" />
        </form>   
  <div>
  <?php
    $date = "2019";
  if(isset($_POST['submit'])){
				
        		$date = $_POST['year'];
        	}	    
      
      
      $sql_date= "SELECT CT_Year FROM Company_Transactions WHERE CT_Year = $date AND CT_Sector = 45 AND CT_Industry = 1 AND CT_Specoality = 1 AND CT_Subspeciality = 1";
	$result = mysqli_query($dbcon, $sql_date);
		 	if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_row($result)) {
				$str1 = "$row[0]";
			echo "<div class='year'><h2>". $date ."</h2></div>";
			}
			
		} else {
			echo "$date contains no data";
		}

      
  $sql_sales = "SELECT CT_Sales FROM Company_Transactions WHERE CT_Year = $date AND CT_Sector = 45 AND CT_Industry = 1 AND CT_Specoality = 1 AND CT_Subspeciality = 1";

	$sql_purch = "SELECT CT_Purchases FROM Company_Transactions WHERE CT_Year = $date AND CT_Sector = 45 AND CT_Industry = 1 AND CT_Specoality = 1 AND CT_Subspeciality = 1";

	$result1 = mysqli_query($dbcon, $sql_sales);
	if (mysqli_num_rows($result1) > 0) {
		while($row = mysqli_fetch_row($result1)) {
			$sales = "$row[0]";
		}	
	} else {
		echo "";
	}

	$result2 = mysqli_query($dbcon, $sql_purch);
	if (mysqli_num_rows($result2) > 0) {
		while($row = mysqli_fetch_row($result2)) {
			$purchases = "$row[0]";
		}	
	} else {
		echo "";
	}

	
   $sql_profits = "SELECT CT_Sales FROM Company_Transactions WHERE CT_Year = $date AND CT_Sector = 45 AND CT_Industry = 1 AND CT_Specoality = 1 AND CT_Subspeciality = 1";

	$result = mysqli_query($dbcon, $sql_profits);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_row($result)) {
				$str1 = "$row[0]";
				echo "<div class='sales'>";
				echo "<h2>Sales</h2>";
				echo "<h3>" . "$" . $str1. "</h3></div>";
				echo "</div>";
				
			}
			
		} else {
			echo "";
		} 
      
      
 $sql_profits = "SELECT CT_Purchases FROM Company_Transactions WHERE CT_Year = $date AND CT_Sector = 45 AND CT_Industry = 1 AND CT_Specoality = 1 AND CT_Subspeciality = 1";

	$result = mysqli_query($dbcon, $sql_profits);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_row($result)) {
				$str1 = "$row[0]";
				echo "<div class='purchases'>";				
				echo "<h2>Purchases</h2>";
				echo "<h3>" . "$" . $str1. "</h3></div>";
				echo "</div>";
				
			}
			
		} else {
			echo "";
		}     
     
   ?> 


  </div>  
    
    </div> 
    </div>
<div>

<?php
           define("DATABASE_HOST", "web212.mccdgm.net");
           define("DATABASE_USERNAME", "web212spr18");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
    
           if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql_sector = ("SELECT COUNT( NSE_Sector_ID )FROM NAICS_Sector;");
           $result = mysqli_query($dbcon,$sql_sector);
           $row1 = mysqli_fetch_row($result); 
    
    ?>
    </div>
        <div class="sector">
         <?php

           echo("<h3><form action='dashboard.php'><input type='submit' value='$row1[0]' name='sectorlist' onclick='sectorlist()'></form></h3>");
           echo("<h2>Sectors</h2>");
           $myselect = array_keys($_GET);
            ?>
    </div>
         <div class="sector2">
            <?php
           function sectorlist($dbcon) {
               $sql_sector = ("SELECT NSE_Sector_ID, NSE_Sector_Name FROM NAICS_Sector;");
               $result = mysqli_query($dbcon,$sql_sector);
               echo ("<div class='scroll'>");
               echo ("<ol>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No results";
               } 
               echo ("</ol></div>");
           }
             ?>
         </div>
    
          
<div>
<?php    
 define("DATABASE_HOST", "web212.mccdgm.net");
           define("DATABASE_USERNAME", "web212spr18");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

    if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql_indu = ("SELECT COUNT(NI_Industry_ID) FROM NAICS_Industry;");
           $result = mysqli_query($dbcon,$sql_indu);
           $row1 = mysqli_fetch_row($result);   
 ?>   
</div>
 <div class="indu">
  <?php   
  echo("<h3><form action='dashboard.php'><input type='submit' value='$row1[0]' name='industrylist' onclick='industrylist()'></form></h3>");
           echo("<h2>Industries</h2>");
           $myselect = array_keys($_GET);       
  ?>   
 </div>                                                                                 <div class="indu2">
 <?php            
           function industrylist($dbcon) {
               $sql_indu = ("SELECT NI_Industry_ID, NI_Industry_Name FROM NAICS_Industry;");
               $result = mysqli_query($dbcon,$sql_indu);
               echo ("<div class='scroll'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No results";
               } 
               echo ("</ol></div>");
           }
     
     
     
 ?>
    </div>    
 
      
 <div class="relative2">              
 <div>
 <?php    
 define("DATABASE_HOST", "web212.mccdgm.net");
           define("DATABASE_USERNAME", "web212spr18");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
     
     if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql_spec = ("SELECT COUNT(NSP_Speciality_ID) FROM NAICS_Speciality; ");
           $result = mysqli_query($dbcon,$sql_spec);
           $row1 = mysqli_fetch_row($result);      
  ?>   
 </div>                                                                                 <div class="spec">
 <?php
  echo("<h3><form action='dashboard.php'><input type='submit' value='$row1[0]' name='specialtylist' onclick='specialtylist()'></form></h3>");        
           echo("<h2>Specialties</h2>");
           
           $myselect = array_keys($_GET);  
  ?>   
 </div>                 
  <div class="spec2">
  <?php    
           function specialtylist($dbcon) {
               $sql_spec = ("SELECT NSP_Speciality_ID, NSP_Speciality_Name FROM NAICS_Speciality;");
               $result = mysqli_query($dbcon,$sql_spec);
               echo ("<div class='scroll'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo " No Results";
               } 
               echo ("</ol></div>");
           }        
  ?>    
  </div>
    </div>
    
    
   
 <div>
  <?php 
   define("DATABASE_HOST", "web212.mccdgm.net");
           define("DATABASE_USERNAME", "web212spr18");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
    
    if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql_sub = ("SELECT COUNT(NSU_Subspeciality_ID) FROM NAICS_Subspeciality; ");
           $result = mysqli_query($dbcon,$sql_sub);
           $row1 = mysqli_fetch_row($result); 
         
  ?>             
  </div>                             
   <div class="sub">
    <?php   
     echo("<h3><form action='dashboard.php'><input type='submit' value='$row1[0]' name='subspecialtylist' onclick='subspecialtylist()'></form></h3>");  
           echo("<h2>Subspecialities</h2>");
           
           $myselect = array_keys($_GET);    
    ?>   
   </div>                                                                               <div class="sub2">
   <?php       
           function subspecialtylist($dbcon) {
               $sql_sub = ("SELECT NSU_Subspeciality_ID, NSU_Subspeciality_Name FROM NAICS_Subspeciality;");
               $result = mysqli_query($dbcon,$sql_sub);
               echo ("<div class='scroll'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No results";
               }
               echo ("</ol></div>");
           }    
       
?>    
</div> 
<div class="data">
  <?php
   if ($myselect[0] == "sectorlist") {
               echo (sectorlist($dbcon));
           }
 
   if ($myselect[0] == "industrylist") {
               echo (industrylist($dbcon));
           }
    
   if ($myselect[0] == "specialtylist") {
               echo (specialtylist($dbcon));
           }
   if ($myselect[0] == "subspecialtylist") {
               echo (subspecialtylist($dbcon));
           }
    
    ?>
</div>
                                                                          
                                                             


                               
    </div>                                                                                                                 
</body>
</html>