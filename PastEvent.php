<?php
$Title = "Past Events";
include 'Header.php'; 
include 'connect-db.php';
if (!isset($_SESSION['login_user'])) {$_SESSION['login_user'] = "";}
//STEP 4: CREATE THE QUERY
$query = "SELECT * FROM events where Status ='InActive'";


//STEP 5: RUN THE QUERY
$result = mysqli_query($con, $query);

//STEP 6: RETRIEVE THE RESULTS
$event = array();
while($row = mysqli_fetch_assoc($result))
{
	$event[$row['EventID']] = array("EventID"=>$row['EventID'],
	"EventTitle"=>$row['EventTitle'],
		"Privacy"=>$row['Privacy'],
		"Status"=>$row['Status']);
}

?>

              <div id="ListEventsPast">
              <h1 id="PastEventsHeader">Past Events</h1>
                  <ul id="CurrentEventList">
                  <?php foreach($event as $i) {?>
                  <li class="EventInfo"><a href="EventDescription.php?id=<?php echo $i['EventID']; ?>&Privacy=<?php echo $i['Privacy']; ?>&Status=<?php echo $i['Status']; ?>">[EventTitle:  <?php echo $i['EventTitle']; ?>]</a></li>
                  <?php } ?>
                  </ul>
              </div>

<?php include 'Footer.php'; ?>