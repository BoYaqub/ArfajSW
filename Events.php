<?php
$Title = "Events";
include('Header.php');
include('connect-db.php');
if (!isset($_SESSION['login_user'])) {$_SESSION['login_user'] = "";}
$date = date('Y-m-d'); //For Event DeActivating

//STEP 4: CREATE THE QUERY
$query1 = "update events set Status='InActive' where '$date'>EndDate"; //Events DeActivator :))
$query = "SELECT * FROM events where Status ='Active' LIMIT 10"; //List of Events


//STEP 5: RUN THE QUERY
$result = mysqli_query($con, $query);
$result1 = mysqli_query($con, $query1);

//STEP 6: RETRIEVE THE RESULTS
$event3 = array();
while($row = mysqli_fetch_assoc($result))
{
	$event3[$row['EventID']] = array("EventID"=>$row['EventID'],
	"EventTitle"=>$row['EventTitle'],
	"Privacy"=>$row['Privacy'],
	"Status"=>$row['Status']);
}

$event2 = array();
if(isset($_POST['SearchBtn'])){
			
		$keyword = $_POST['SearchField'];
		$EventType = $_POST['EventType'];
		$Location = $_POST['Location'];
		$FromDate = $_POST['FromDate'];
		$ToDate = $_POST['ToDate'];
		
	//STEP 4: CREATE THE QUERY
	$query2 = "SELECT * FROM evetns where EventTitle = '$keyword' and EventType = '$EventType' and Location = '$Location' and StartDate between '$FromDate' and '$ToDate'";
	
	
	
	//STEP 5: RUN THE QUERY
	$result2 = mysqli_query($con, $query2);
	
	//STEP 6: RETRIEVE THE RESULTS
	while($row = mysqli_fetch_assoc($result2))
	{
		
	$event2[$row['EventID']] = array("EventID"=>$row['EventID'],
	"EventTitle"=>$row['EventTitle'],
	"Privacy"=>$row['Privacy'],
	"Status"=>$row['Status']);
	
	}

	
if($result2==1)
		{
			header('Location: Events.php?results=success');
		}
		else{
			header('Location: Events.php?results=failure');
		}

}
 ?>
          
          
          
          <div id="EventsContent">
              <div id="SearchDiv">
                  <h1 id="SearchHeader">Search</h1>
                  <?php if(isset($_GET['results']) && $_GET['results']==='success') {?>
                  	
				<ul id="CurrentEventList1">
                  <?php foreach($event2 as $i) { ?>
                  <li class="EventInfo"><a href="EventDescription.php?id=<?php echo $i['EventID']; ?>&Privacy=<?php echo $i['Privacy']; ?>&Status=<?php echo $i['Status']; ?>">EventTitle:  [<?php echo $i['EventTitle']; ?>]</a></li>
                  <?php } ?>
                  </ul>
                  	
    <?php } else if(isset($_GET['results']) && $_GET['results']==='failure') {?>
    <h1 class="Status">Oops! There was a problem.</h1>
    <?php } else {?>
          <form name="SearchForm" action="Events.php" method="post" onsubmit="return validate();">
              <label for="SearchField" id="SearchFieldLabel">Keyword: </label>
              <input type="text" id="SearchField" name="SearchField" />
              
              <label for="EventType">Event Type: </label>
              <select name="EventType" id="EventType">
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
              </select>
                <label for="EventLocation">Location:</label>
              <select name="Location">
                    <option value=""></option>
                    <option value="Online">Online</option>
                    <option value="Offline">Offline</option>
              </select>
              <div id="SearchDateDiv">
              <label for="FromDate">From: </label>
              <input type="date" name="FromDate" id="FromDate" />
              <label for="ToDate">To: </label>
              <input type="date" name="ToDate" />
                  </div>
              <input type="submit" class="CustomButtonA" name="SearchBtn" id="SearchBtn" onclick="validate();" value="Search" />
                  </form>
                  <?php }?>
          </div>
              
              <div id="ListEvents">
              <h1 id="CurrentEventsHeader">Current Events</h1>
                  <ul id="CurrentEventList">
                  <?php foreach($event3 as $i) {?>
                  <li class="EventInfo"><a href="EventDescription.php?id=<?php echo $i['EventID']; ?>&Privacy=<?php echo $i['Privacy']; ?>&Status=<?php echo $i['Status']; ?>">EventTitle:  [<?php echo $i['EventTitle']; ?>]</a></li>
                  <?php } ?>
                  </ul>
                  <br/><br/><br/>
                  <a href="ActiveEvents.php" class="CustomButtonA" id="Showmore" >Show More</a>
                  <a href="PastEvent.php" class="CustomButtonA">Past Events</a>
              </div>
              
          </div>
                  <script>
          function validate(){
              var keyword1 = document.getElementById("SearchField").value;
              var flag = true;
            if(keyword1=="")
          { document.getElementById("SearchField").style.backgroundColor="#FFC7C7";
          document.getElementById("SearchField").setAttribute("placeholder","Required");
          flag = false;
          }
              else { document.getElementById("SearchField").style.backgroundColor="#FFF";
                   document.getElementById("SearchField").setAttribute("placeholder","");
                   flag = true;
                   }
                   if(flag){return true;}
                   	
                   else{return false;}
          }
      </script>


<?php include('Footer.php'); ?>