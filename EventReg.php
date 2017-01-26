<?php
include('connect-db.php');

if(isset($_GET['id'])) //To Avoid Error if You Visit This Page Directly
$id = $_GET['id'];
if(isset($_POST['EventRegSubmit'])){
$idd = $_POST['hidden'];	
$Fname = $_POST['RegFName'];
$Lname = $_POST['RegLName'];
$RegID = $_POST['RegID'];
$Des = $_POST['Designation'];
$orgname = $_POST['RegOrgName'];
$pos = $_POST['RegPosition'];


//STEP 4: CREATE THE QUERY
$query = "Insert into registered(RegID,EventID,FName,LName,Designation,OrganizationName,Position) values('$RegID','$idd','$Fname','$Lname','$Des','$orgname','$pos')";

//STEP 5: RUN THE QUERY
$result = mysqli_query($con, $query);

		if($result==1)
		{
			header('Location: EventReg.php?results=success');
		}
		else{
			header('Location: EventReg.php?results=failure');
			
		}
}
 ?>
          
          
<?php $Title = "Event Registration";
			include('Header.php'); ?>
          <div id="RegContent">
<?php if(isset($_GET['results']) && $_GET['results']==='success') {?>
    <h1>You Registered Succesfully</h1>
    <?php } else if(isset($_GET['results']) && $_GET['results']==='failure') {?>
    <h1>Oops! There was a problem.</h1>
    <?php } else {?>
              <h2 id="RegHeader">Event Register</h2>
              <form name="RegForm" id="RegForm" action="EventReg.php" method="post" onsubmit="return validate();">
              <table class="Table">
              
                  <tr>
                  <td><label for="RegFName">First Name:</label></td>
                  <td><input type="text" name="RegFName"  /></td>
                  </tr>
                  
                  <tr>
                  <td><label for="RegLName">Last Name:</label></td>
                  <td><input type="text" name="RegLName" /></td>
                  </tr>
                  
                  <tr>
                  <td><label for="RegID">ID:</label></td>
                  <td><input type="text" name="RegID" /></td>
                  </tr>
                  
                  <tr>
                  <td><label for="Designation">Designation:</label></td>
                    <td><input type="radio" name="Designation" value="Student" /> Student
                        <input type="radio" name="Designation" value="Faculty" /> Faculty
                        <input type="radio" name="Designation" value="Alumni" /> Alumni
                        <input type="radio" name="Designation" value="Other" /> Other
                    </td>
                  </tr>
                  
                  <tr>
                  <td><label for="RegOrgName">Organization Name:</label></td>
                  <td><input type="text" name="RegOrgName" /></td>
                  </tr>
                  
                  <tr>
                  <td><label for="RegPosition">Position:</label></td>
                  <td><input type="text" name="RegPosition" /></td>
                  </tr>
                  
                  </table>
                <input type="hidden" value="<?php echo $id //To Store ID :))?>" name="hidden" />
                                    
        <input type="submit" class="CustomButtonA" id="EventRegSubmit" name="EventRegSubmit" value="Register" onclick="validate();" />
        <a href="" class="CustomButtonA" >Reset</a>

              </form>
              <?php } ?>
          </div>
      
      <script>
            function validate(){
                var Fname = document.RegForm.RegFName.value;
                var Lname = document.RegForm.RegLName.value;
                var flag = true;
            if(Fname=="")
          { document.RegForm.RegFName.style.backgroundColor="#FFC7C7";
          document.RegForm.RegFName.setAttribute("placeholder","Required");
          var flag = false;
          }
              else { document.RegForm.RegFName.style.backgroundColor="#FFF"; 
                   document.RegForm.RegFName.setAttribute("placeholder","");
                   var flag = true;
                   }
            if(Lname=="")
          { document.RegForm.RegLName.style.backgroundColor="#FFC7C7";
          document.RegForm.RegLName.setAttribute("placeholder","Required");
          var flag = false;
          }
              else { document.RegForm.RegLName.style.backgroundColor="#FFF"; 
                   document.RegForm.RegLName.setAttribute("placeholder","");
                   var flag = true;
                   }
                   if(flag){return true;}
                   else{return false;}

          }
          
          </script>


<?php include('Footer.php'); ?>