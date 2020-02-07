<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<head>
    <meta charset="UTF-8">
    <title>Business Analysis Corporation II</title>
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
          li {font_size:xx-small}
          li:hover {background: #555;}
          div.ex1 {
          background-color: lightred;
          width: 200px;
          height: 100px;
          overflow: scroll; }
          div.ex2 {
          background-color: lightred;
          width: 60%;
          height: 300px;
          overflow: scroll; }
          
          table, th, td {
          border: 1px solid black;}
          .CellWithComment{position:relative;}
          .CellComment{
           display:none;
           position:absolute; 
           z-index:75;
           border:1px;
           background-color:white;
           border-style:solid;
           border-width:1px;
           border-color:red;
           padding:3px;
           color:red; 
           top:1px; 
           left:25px;}

          .CellWithComment:hover span.CellComment{display:block;}
    </style>
</head>
<body> 
    <h1>Business Analysis Corporation II</h1>
  
<!-- Top container -->
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <?php
         echo 'Welcome: ' . get_current_user();
      ?>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-container">
    <form action="Test.php">
       <input type="submit" value="Overview" class="w3-button w3-black" style="width:50%">
    </form>
    <form action="WEB212-MainPage1.php">
       <input type = "submit" value="Clear   " onclick="w3_close()" class="w3-button w3-black" style="width:50%">
    </form>

  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
</div>

<!-- !PAGE CONTENT! -->

<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right"></div>
        <div class="w3-clear"></div>

        <?php
           define("DATABASE_HOST", "web212.mccdgm.net");
           define("DATABASE_USERNAME", "web212spr18");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

           // if the connecton fails, display appropriate error message
           if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql = ("SELECT COUNT( NSE_Sector_ID )FROM NAICS_Sector;");
           $result = mysqli_query($dbcon,$sql);
           $row1 = mysqli_fetch_row($result); 
        
           echo("<h3><form action='WEB212-MainPage1.php'><input type='submit' value='$row1[0]' name='sectorlist' onclick='sectorlist()'></form></h3>");
           echo("<h4>Sectors</h4>");
           $myselect = array_keys($_GET);
           
          
           if ($myselect[0] == "sectorlist") {
               echo (sectorlist($dbcon));
           }
           
           function sectorlist($dbcon) {
               $sql = ("SELECT NSE_Sector_ID, NSE_Sector_Name FROM NAICS_Sector;");
               $result = mysqli_query($dbcon,$sql);
               echo ("<div class='ex1'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No Results. ";
               } 
               echo ("</ol></div>");        
           }
        ?>
      </div>
    </div>
    
    
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right"></div>
        <div class="w3-clear"></div>

        <?php
           define("DATABASE_HOST", "vps6441.inmotionhosting.com");
           define("DATABASE_USERNAME", "web212sp_USER1");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

           // if the connecton fails, display appropriate error message
           if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql = ("SELECT COUNT(NI_Industry_ID) FROM NAICS_Industry;");
           $result = mysqli_query($dbcon,$sql);
           $row1 = mysqli_fetch_row($result); 

           echo("<h3><form action='WEB212-MainPage1.php'><input type='submit' value='$row1[0]' name='industrylist' onclick='industrylist()'></form></h3>");
           echo("<h4>Industries</h4>");
           $myselect = array_keys($_GET);
           
           if ($myselect[0] == "industrylist") {
               echo (industrylist($dbcon));
           }
           
           function industrylist($dbcon) {
               $sql = ("SELECT NI_Industry_ID, NI_Industry_Name FROM NAICS_Industry;");
               $result = mysqli_query($dbcon,$sql);
               echo ("<div class='ex1'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No Results. ";
               } 
               echo ("</ol></div>");        
           }
        ?>

      </div>
    </div>
    
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
        </div>
        <div class="w3-clear"></div>  
              
        <?php
           define("DATABASE_HOST", "vps6441.inmotionhosting.com");
           define("DATABASE_USERNAME", "web212sp_USER1");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

           // if the connecton fails, display appropriate error message
           if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql = ("SELECT COUNT(NSP_Speciality_ID) FROM NAICS_Speciality; ");
           $result = mysqli_query($dbcon,$sql);
           $row1 = mysqli_fetch_row($result); 

           echo("<h3><form action='WEB212-MainPage1.php'><input type='submit' value='$row1[0]' name='specialtylist' onclick='specialtylist()'></form></h3>");        
           echo("<h4>Specialties</h4>");
           
           $myselect = array_keys($_GET);
           
           if ($myselect[0] == "specialtylist") {
               echo (specialtylist($dbcon));
           }
           
           
           function specialtylist($dbcon) {
               $sql = ("SELECT NSP_Speciality_ID, NSP_Speciality_Name FROM NAICS_Speciality;");
               $result = mysqli_query($dbcon,$sql);
               echo ("<div class='ex1'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No Results. ";
               } 
               echo ("</ol></div>");        
           }
           
        ?>

      </div>
    </div>
    
    
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right"></div>
        <div class="w3-clear"></div>
        
        <?php
           define("DATABASE_HOST", "vps6441.inmotionhosting.com");
           define("DATABASE_USERNAME", "web212sp_USER1");
           define("DATABASE_PASSWORD", "WEB212SPR19");
           define("DATABASE_NAME", "web212sp_Master_Database");
           $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

           // if the connecton fails, display appropriate error message
           if (!$dbcon) {
              die("Connection failed: " . mysqli_connect_error());
            } else {
            }
           $sql = ("SELECT COUNT(NSU_Subspeciality_ID) FROM NAICS_Subspeciality; ");
           $result = mysqli_query($dbcon,$sql);
           $row1 = mysqli_fetch_row($result); 
        
           echo("<h3><form action='WEB212-MainPage1.php'><input type='submit' value='$row1[0]' name='subspecialtylist' onclick='subspecialtylist()'></form></h3>");  
           echo("<h4>Subspecialities</h4>");
           
           $myselect = array_keys($_GET);
           
           if ($myselect[0] == "subspecialtylist") {
               echo (subspecialtylist($dbcon));
           }
           
           
           function subspecialtylist($dbcon) {
               $sql = ("SELECT NSU_Subspeciality_ID, NSU_Subspeciality_Name FROM NAICS_Subspeciality;");
               $result = mysqli_query($dbcon,$sql);
               echo ("<div class='ex1'>");
               echo ("<ol>");
               if (mysqli_num_rows($result) > 0) {       
                  while ($row = mysqli_fetch_row($result)) {
                    echo ("<li>".$row[1]."</li>");
                  }
               } else {
                 echo "No Results. ";
               } 
               echo ("</ol></div>");        
           }
        ?>
      </div>
    </div>
    
<div class="w3-main" style="margin-left:75px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Staff Representatives</b></h5>
  </header>
    
  <?php
      define("DATABASE_HOST", "vps6441.inmotionhosting.com");
      define("DATABASE_USERNAME", "web212sp_USER1");
      define("DATABASE_PASSWORD", "WEB212SPR19");
      define("DATABASE_NAME", "web212sp_Master_Database");
      $dbcon=mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

      // if the connecton fails, display appropriate error message
      if (!$dbcon) {
          die("Connection failed: " . mysqli_connect_error());
      } else {
         }
           $sql = ("SELECT FirstName, LastName, NSU_Subspeciality_Name, CONCAT( Sector, Industry, Speciality, Subspeciality ) \n"
                   . "FROM User_Table, NAICS_Subspeciality\n"
                   . "WHERE Sector = NSU_Sector_ID\n"
                   . "AND Industry = NSU_Industry_ID\n"
                   . "AND Speciality = NSU_Speciality_ID\n"
                   . "AND Subspeciality = NSU_Subspeciality_ID\n"
                   . ";");
           $result = mysqli_query($dbcon,$sql);
           $row1 = mysqli_fetch_row($result);  
           echo ("<div class='ex2'>");
           echo ("<table><tr><th>Last Name</th><th>Business Type</th></tr>");
           if (mysqli_num_rows($result) > 0) {       
               while ($row = mysqli_fetch_row($result)) {
               echo ("<tr><td class='CellWithComment'>$row[1]<span class='CellComment'>$row[3]</span></td><td>$row[2]</td></tr>");
               }
            } else {
               echo "No Results. ";
            } 
          echo ("</table></div>");
        ?>
      </div>
    </div>

</div>

  <hr>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";

//Listings
}
</script>

</body>
</html>
