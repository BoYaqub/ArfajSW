<?php
$Title = "Event Description";
include('Header.php'); 
include('connect-db.php');
if(isset($_GET['id'])) //To Avoid Error if You Visit This Page Directly
$id = $_GET['id']; //Get Event ID
if(isset($_GET['Privacy'])) //To Avoid Error if You Visit This Page Directly
$Privacy = $_GET['Privacy']; //Getting Privacy to Hide Button if Event is Private
if(isset($_GET['Status'])) //To Avoid Error if You Visit This Page Directly
$Status = $_GET['Status']; //Getting Status to Hide Button if Event is InActve
if (!isset($_SESSION['login_user'])) {$_SESSION['login_user'] = "";}

//STEP 4: CREATE THE QUERY
if(isset($_GET['id'])){ //To Avoid Error if You Visit This Page Directly
$query = "SELECT * FROM events where EventID = $id";


//STEP 5: RUN THE QUERY
$result = mysqli_query($con, $query);

//STEP 6: RETRIEVE THE RESULTS
$event = array();
while($row = mysqli_fetch_assoc($result))
{
	$event[$row['EventID']] = array("EventID"=>$row['EventID'],
					"EventTitle"=>$row['EventTitle'],
					"StartDate"=>$row['StartDate'],
					"StartTime"=>$row['StartTime'],
					"EndTime"=>$row['EndTime'],
					"EndDate"=>$row['EndDate'],
					"EventLogo"=>$row['EventLogo'],
					"NumberOfSeats"=>$row['NumberOfSeats'],
					"Privacy"=>$row['Privacy'],
					"Location"=>$row['Location'],
					"EventDescription"=>$row['EventDescription'],
					"EventType"=>$row['EventType'],
					"EventTopic"=>$row['EventTopic'],
					"Refreshments"=>$row['Refreshments']);
}
}
?>
         
          
          
          
          
          <div id="Content">
          	
              <h1 id="EventRegHeader">Event Description</h1>
              <?php if(isset($_GET['id'])){ //To Avoid Error if You Visit This Page Directly ?>
          	<div id="Dummy">
              <div id="EventDescriptionInfo">
              <ul class="EventInfoList">
	    		<?php foreach($event as $i) { //Showing Event Information?>
	    			<li class="EventInfo">EventTitle:  <?php echo $i['EventTitle']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Start Date:  <?php echo $i['StartDate']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">End Date:    <?php echo $i['EndDate']; echo "<br/>"; ?></li>
                    <li class="EventInfo">Start Time:   <?php echo $i['StartTime']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">End Time:    <?php echo $i['EndTime']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Number Of Seats:<?php echo $i['NumberOfSeats']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Privacy:     <?php echo $i['Privacy']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Location:    <?php echo $i['Location']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Event Description:<?php echo $i['EventDescription']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Event Type:  <?php echo $i['EventType']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Event Topic: <?php echo $i['EventTopic']; echo "<br/>"; ?></li>
	    			<li class="EventInfo">Refreshments:<?php echo $i['Refreshments']; echo "<br/>"; ?></li>
	    			<?php } ?>
                </ul>
                </div>
              <div id="EventLogo"><img src="<?php echo $i['EventLogo'];?>" alt="<?php echo $i['EventTitle'];?>" width="250px" height="200px" /></div>
	    		
              <div class="clear"></div>
              </div>
              
              <?php if( $Status==='InActive' or $Privacy==='Private'){ //Condition To Hide The Button?>
              <h2 id="CantReg">You Can't Register</h2>
              <?php } else{ ?>
              <a href="EventReg.php?id=<?php echo $i['EventID']; ?>" class="CustomButtonA" id="RegisterBTN" >Register</a>
              <?php } ?>
              <?php } ?>
          </div>
          
          
          
<?php include('Footer.php'); ?>