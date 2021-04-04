<?php
/*
WEBD3201
Group 16
*/ 
	$fileName="listing-search.php";
	$description="Page that allows users to search for listings";
	$title="Search Your Area";
	$banner="Search Your Area";
?>

<?php include 'header.php';  ?>
  <?php 
    //print_r($_COOKIE);
    global $dbconn;
   // $_SESSION['selected_cities'] = array();
    

    if(isset($_SESSION['redirect_message']))
      {

        $redirect_message = $_SESSION['redirect_message'];


      }
      else
      {
        $redirect_message = "";
      }


    

    if($_SERVER["REQUEST_METHOD"] == "GET")
      {
    $city = 0;


      if(isset($_COOKIE['cities']))
      {
        $city = $_COOKIE['cities'];

      }

      if (isset($_GET['value']))
      {
        $_SESSION['cities'] = ($_GET['value']);
        setcookie("cities", $_GET['value'], time() + COOKIE_EXPIRY); 

        header("Location: profile-search.php");


      }

      




    
   }
   else if($_SERVER["REQUEST_METHOD"] == "POST")
   {

    $city = 0;


    if(isset($_POST['city']))
    {
      $city = sumCheckBox($_POST['city']);

      //echo $city;

      $_SESSION['cities'] = $city;

      setcookie("cities", $city, time() + COOKIE_EXPIRY);

      header("Location: profile-search.php");



    }
    else
    {

      echo "Please select at least 1 city";
    }


  
   }
   
   ?>

<script type="text/javascript">
<!--

  function cityToggleAll()
  {
    var isChecked = document.getElementById("city_toggle").checked;
    var city_checkboxes = document.getElementsByName("city[]");
    for (var i in city_checkboxes){
      city_checkboxes[i].checked = isChecked;
    }   
  }
  

</script>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >



<p> <?php echo $redirect_message ?>	Choose from a city below to view its matches:</p>


<img src="images/durham_region_clean.jpg" alt="" usemap="#image-map" />
<map name="image-map" id="image-map">
    
    <area alt="" title="Pickering" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=16"; ?>" shape="poly" coords="0,168,78,136,100,214,58,231,84,322,46,336,11,275" />
    
    <area alt="" title="Ajax" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=1"; ?>" shape="poly" coords="102,224,64,238,92,318,126,303" />
    
    <area alt="" title="Whitby" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=64"; ?>" shape="poly" coords="110,206,154,194,178,282,132,295" />
    
    <area alt="" title="Brooklin" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=2"; ?>" shape="poly" coords="88,138,107,202,150,188,134,123" />
    
    <area alt="" title="Oshawa" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=8"; ?>" shape="poly" coords="142,120,190,284,232,267,186,104" />
    
    <area alt="" title="Bowmanville" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=4"; ?>" shape="poly" coords="218,191,354,160,354,240,243,270" />
    
    <area alt="" title="Port Perry" 
    href="<?php echo $_SERVER['PHP_SELF'] . "?value=32"; ?>" shape="poly" coords="111,0,115,78,220,67,230,0" />
</map>

    <table>
               <tr>
                  <td>
                  	<p>Or select multiple below:</p>
                    <?php 
                    	
                        //echo $city;
                    		build_checkbox('city',$city);

                    	?>
                    

                  </td>
               </tr>
               <tr>
                  <td>
                    <input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">Select All
                  </td>
               </tr>
               <tr style="float:right;">
                  <td><br/><input type="submit" class = "submitbtn" name="create" value="Choose City"/></td>
               </tr>
    </table>


<?php include 'footer.php'; ?>
