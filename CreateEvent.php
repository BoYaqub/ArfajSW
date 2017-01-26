<?php 
include('connect-db.php');
require_once ('mail/class.phpmailer.php');
	//Create an Object to the PHPMailer Class
	$mail = new PHPMailer();
if (!isset($_SESSION['login_user'])) {$_SESSION['login_user'] = "";}
if(isset($_POST['CreateESubmit'])){
$Status = 'Active';


//Taking Values from the Form
$ETitle = $_POST['EventTitle'];
$Sdate = $_POST['StartDate'];
$EDate = $_POST['EndDate'];
$STime = $_POST['StartTime'];
$ETime = $_POST['EndTime'];
$NumSeats = $_POST['NumberofSeats'];
$Privacy = $_POST['Privacy'];
$Location = $_POST['Location'];
$EDesc = $_POST['EventDescription'];
$EType = $_POST['EventType'];
$ETopic = $_POST['EventTopic'];
/*$Name = $_POST['OrgName'];
$Email = $_POST['OrgEmail'];
$OrgDesc = $_POST['OrgDesc'];
$FB = $_POST['OrgFB'];
$Twitter = $_POST['OrgTwitter'];
$TelNo = $_POST['TelNo'];*/
$refresh = $_POST['Refreshments'];
$refs = '';

foreach($refresh as $i) //Concatenating Refreshments
{

    $refs = $refs.','.$i;
	
}

		//STEP 1 [File]: Create the Target Path
		$target_path = 'Images/EventLogo/';
		
		//STEP 2 [File]: Extract the File Name
		$filename = basename($_FILES['image']['name']);
		//Extract the extension
		$ext = end(explode('.',$filename));
		//Create a custom filename
		$fname = 'Logo-'.$ETitle.'.'.$ext;
		//Define the Complete Path
		$path = $target_path.$fname;
		
		$extension = array('jpg','jpeg','png','gif', 'JPEG'); //Array of Allowed File Types
		$type = in_array($ext, $extension); //Checking If Uploaded File Matches Allowed Types
		
		if($_FILES['image']['size']<=500000 && $type && $_FILES['image']['error']==0)
		{
		//STEP 3 [File]: Move the File
		$out = move_uploaded_file($_FILES['image']['tmp_name'], $path); //Moving File to Website Directoy
		
		if($out) //If File Moving Went Well
		{
		//STEP 4: CREATE THE QUERY
		
		//Inserting Event Info
$query4 = "Insert into  events(EventTitle,StartDate,EndDate,StartTime,EndTime,EventLogo,NumberOfSeats,Privacy,Location,EventDescription,EventType,EventTopic,Status,Refreshments) values ('$ETitle','$Sdate','$EDate','$STime','$ETime','$path','$NumSeats','$Privacy','$Location','$EDesc','$EType','$ETopic','$Status','$refs')";

		//Inserting Organizer Info
//$query3 = "Insert into eventorg(Name, Email, OrganizerDescription, Facebook, Twitter, TelephoneNumber) values('$Name', '$Email', '$OrgDesc', '$FB', '$Twitter', '$TelNo')";
		
		//STEP 5: RUN THE QUERY
$result = mysqli_query($con, $query4);
$result2 = mysqli_query($con, $query3);
		
		if($result==1 && $result2==1)
		{
			header('Location: CreateEvent.php?results=success');
	
    //Set the From Address
	$mail->From = 'KFU_Events@kfu.edu.sa';
	$mail->FromName = 'KFU_Events.com'; 

    //Set the To Address
	$mail->AddAddress("oruchimaro@gmail.com"); //Admin
	
    //Set the Subject and the Message Body
	$mail->Subject = "an Event is Created";
	$mail->Body = 'Thank You For Using KFU_Events';
    
    //SMTP Settings
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "smtp.drmisbha.net";
	$mail->Port = 587;
	$mail->Username = 'test@drmisbha.net';
	$mail->Password = 'ccsit_Kfu2013';
	$mail->Send();
	
		}
		else{
			header('Location: CreateEvent.php?results=failure');
		}
		}
		}
		
		else
			{
 				header('Location: CreateEvent.php?results=failure');
			}	


}


?>

<?php 
        $Title = "Create Event";
		include('Header.php');  
				?>
	<?php if(isset($_GET['results']) && $_GET['results']==='success') {?>
    <h1 class="Status">Event added Succesfully</h1>
    <?php } else if(isset($_GET['results']) && $_GET['results']==='failure') {?>
    <h1 class="Status">Oops! There was a problem.</h1>
    <?php } else { if($_SESSION['login_user'] == "Admin"){ ?>
          <form id="CreateEForm" name="CreateEForm" action="CreateEvent.php" method="post" onsubmit="return validate();" enctype="multipart/form-data">
          <div id="CreateEEventInfo">
          <h2 id="CreateEventHeader">Event Information</h2>
              
              <table class="Table">
              
                  <tr>
                  <td><label for="EventTitle">Event Title*:</label></td>
                  <td><input type="text" name="EventTitle" /></td>
                  </tr>
                  
                  
              
                  <tr>
                    <td><label for="StartDate">Start Date*:</label></td>
                    <td><input type="date" name="StartDate" /></td>
                    <td><label for="EndDate" class="EndDateTime">End Date*:</label></td>
                    <td><input type="date" name="EndDate" /></td>
                  </tr>
                  
                  <tr>
                    <td><label for="StartTime">Start Time*:</label></td>
                    <td><input type="time" name="StartTime"  /></td>
                    <td><label for="EndTime" class="EndDateTime">End Time*:</label></td>
                    <td><input type="time" name="EndTime" /></td>
                  </tr>                  
                  
                  <tr>
                  <td><label for="EventLogo">Event Logo*:</label></td>
                  <td><input type="file" name="image" id="image"  /></td>
                  </tr>
                  
                  <tr>
                    <td><label for="NumberofSeats">Number of Seats*:</label></td>
                    <td><input type="text" name="NumberofSeats"  /></td>
                    <td><label for="EventPrivacy" class="EndDateTime">Privacy*:</label></td>
              <td><select name="Privacy">
                    <option value=""></option>
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
              </select></td>
                      
                  </tr>
                  
                  <tr>
                  <td><label for="Location">Location:</label></td>
                  <td><select name="Location">
                    <option value=""></option>
                    <option value="Online">Online</option>
                    <option value="Offline">Offline</option>
              </select></td>
                  </tr>
                  
                  <tr>
                  <td><label for="EventDescription:">Event Description:</label></td>
                  <td><textarea rows="6" cols="19" name="EventDescription"></textarea></td>
                  </tr>
                  
                  <tr>
                  
                  <td><label for="EventType">Event Type: </label></td>
              <td><select name="EventType" id="EventType">
                  <option value=""></option>
                  <option value="Workshop">Workshop</option>
                  <option value="Conference">Conference</option>
                  <option value="Convention">Convention</option>
                  <option value="Dinner">Dinner</option>
                  <option value="Festival">Festival</option>
                  <option value="Competition">Competition</option>
                  <option value="Meeting">Meeting</option>
                  <option value="Social Gathering">Social Gathering</option>
                  <option value="Seminar">Seminar</option>
                  <option value="Exhibition">Exhibition</option>
                  <option value="Show">Show</option>
              </select></td>
                <td><label for="EventTopic" class="EndDateTime">Event Topic: </label></td>
                    <td><select name="EventTopic" id="EventTopic">
                  <option value=""></option>
                  <option value="Programming">Programming</option>
                  <option value="Business">Business</option>
                  <option value="Education">Education</option>
                  <option value="Technology">Technology</option>
                  <option value="Science">Science</option>
                  <option value="Research">Research</option>
                  <option value="Innovation">Innovation</option>
                  <option value="Informal">Informal</option>
                        </select></td>
                  </tr>
              
              </table>
                        <label for="Refreshments">Refreshments:</label>
                      <input type="checkbox" name="Refreshments[]" value="Breakfast" />Breakfast 
                      <input type="checkbox" name="Refreshments[]" value="Lunch"/>Lunch
                      <input type="checkbox" name="Refreshments[]" value="Dinner"/>Dinner
                      <input type="checkbox" name="Refreshments[]" value="Snack"/>Snack
                      <input type="checkbox" name="Refreshments[]" value="Coffee"/>Coffee
                      <input type="checkbox" name="Refreshments[]" value="Tea"/>Tea 
                      <input type="checkbox" name="Refreshments[]" value="Juice"/>Juice
                      <input type="checkbox" name="Refreshments[]" value="Cake"/>Cake<br />
                      <input type="checkbox" name="Refreshments[]" value="Sandwiches"/>Sandwiches
                      <input type="checkbox" name="Refreshments[]" value="Sweets"/>Sweets
                               
                               
          </div>
              
         </form>
          <?php }else{ ?>

    <div id="NotAuthorizedPanelDIV">
        <h1 id="NotAuthorizedPanel">You Are not Authorized!</h1>

    </div>

<?php }}?>
      <script>
            function validate(){
                
                var title = document.CreateEForm.EventTitle.value;
                var StartDate = document.CreateEForm.StartDate.value;
                var StartTime = document.CreateEForm.StartTime.value;
                var EndDate = document.CreateEForm.EndDate.value;
                var EndTime = document.CreateEForm.EndTime.value;
                var EventLogo = document.CreateEForm.image.value;
                var NumberofSeats = document.CreateEForm.NumberofSeats.value;
                var Orgname = document.CreateEForm.OrgName.value;
                var OrgEmail = document.CreateEForm.OrgEmail.value;
                var Privacy = document.CreateEForm.Privacy.value;
                var flag = true;
                
            if(title=="")
          { document.CreateEForm.EventTitle.style.backgroundColor="#FFC7C7";
            document.CreateEForm.EventTitle.setAttribute("placeholder","Required");
           flag = false;
          }
              else { document.CreateEForm.EventTitle.style.backgroundColor="#FFF";
                   document.CreateEForm.EventTitle.setAttribute("placeholder","");
                    flag = true;
                   }
            if(StartDate=="")
          { document.CreateEForm.StartDate.style.backgroundColor="#FFC7C7"; flag = false;}
              else { document.CreateEForm.StartDate.style.backgroundColor="#FFF"; flag = true; }
            if(StartTime=="")
          { document.CreateEForm.StartTime.style.backgroundColor="#FFC7C7"; flag = false;}
              else { document.CreateEForm.StartTime.style.backgroundColor="#FFF"; flag = true; }
            if(EndDate=="")
          { document.CreateEForm.EndDate.style.backgroundColor="#FFC7C7"; flag = false;}
              else { document.CreateEForm.EndDate.style.backgroundColor="#FFF"; flag = true;}
                if(EndTime=="")
          { document.CreateEForm.EndTime.style.backgroundColor="#FFC7C7"; flag = false;}
              else { document.CreateEForm.EndTime.style.backgroundColor="#FFF"; flag = true;}
                if(EventLogo=="")
          { document.CreateEForm.image.style.backgroundColor="#FFC7C7";
          document.CreateEForm.image.style.color="#000000"
           flag = false;}
              else { document.CreateEForm.image.style.backgroundColor="#331A00";
              document.CreateEForm.image.style.color="#FFFFFF"
                    flag = true;}
                if(NumberofSeats=="")
          { document.CreateEForm.NumberofSeats.style.backgroundColor="#FFC7C7";
           document.CreateEForm.NumberofSeats.setAttribute("placeholder","Required");
           flag = false;
          }
              else { document.CreateEForm.NumberofSeats.style.backgroundColor="#FFF"; 
                    document.CreateEForm.NumberofSeats.setAttribute("placeholder","");
                    flag = true;
                   }
                if(Orgname=="")
          { document.CreateEForm.OrgName.style.backgroundColor="#FFC7C7";
          document.CreateEForm.OrgName.setAttribute("placeholder","Required");
           flag = false;
          }
              else { document.CreateEForm.OrgName.style.backgroundColor="#FFF"; 
                   document.CreateEForm.OrgName.setAttribute("placeholder","");
                    flag = true;
                   }
                if(OrgEmail=="")
          { document.CreateEForm.OrgEmail.style.backgroundColor="#FFC7C7";
          document.CreateEForm.OrgEmail.setAttribute("placeholder","Required");
           flag = false;
          }
              else { document.CreateEForm.OrgEmail.style.backgroundColor="#FFF"; 
                   document.CreateEForm.OrgEmail.setAttribute("placeholder","");
                    flag = true;
                   }
                if(Privacy=="")
          { document.CreateEForm.Privacy.style.backgroundColor="#FFC7C7"; flag = false;}
              else { document.CreateEForm.Privacy.style.backgroundColor="#FFF"; flag = true;}
                
                if(flag){return true;}
                else {return false;}

          }
          </script>
<?php include('Footer.php'); ?>