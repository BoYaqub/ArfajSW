<?php
$Title = "Home";
include('Header.php'); 
include('connect-db.php');


$date = date('Y-m-d'); //For Date Comparison

//STEP 4: CREATE THE QUERY
$query4 = "update events set Status='InActive' where '$date'>EndDate"; //Events DeActivator :))
$query = "SELECT count(*) as NumberOfEvents FROM events"; //For total number of Events
$query1 = "SELECT count(*) as NumberOfEvents FROM events where DATEDIFF('$date',StartDate)<30"; //For Events in the last month
$query2 = "SELECT count(*) as NumberOfEvents FROM events where DATEDIFF('$date',StartDate)<7"; //For Events in the last week
$query3 = "SELECT * from events where Privacy='Public' AND Status='Active'"; //For Slider


//STEP 5: RUN THE QUERY
$result = mysqli_query($con, $query);
$result1 = mysqli_query($con, $query1);
$result2 = mysqli_query($con, $query2);
$result3= mysqli_query($con, $query3);
$result4= mysqli_query($con, $query4);


//STEP 6: RETRIEVE THE RESULTS
$event = array();
$event1 = array();
$event2 = array();
$event3 = array();

	$row = mysqli_fetch_assoc($result);
	$event[$row['NumberOfEvents']] = array("NumberOfEvents"=>$row['NumberOfEvents']);//For total number of Events


	$row = mysqli_fetch_assoc($result1);
	$event1[$row['NumberOfEvents']] = array("NumberOfEvents"=>$row['NumberOfEvents']);//For Events in the last month


	$row = mysqli_fetch_assoc($result2);
	$event2[$row['NumberOfEvents']] = array("NumberOfEvents"=>$row['NumberOfEvents']);//For Events in the last week


while($row = mysqli_fetch_assoc($result3))//For Slider
{
	$event3[$row['EventLogo']] = array("EventLogo"=>$row['EventLogo'],
										"EventID"=>$row['EventID'],
										"Privacy"=>$row['Privacy'],
										"Status"=>$row['Status']);
}


?>
          

          
          
          <div id="HomeContent">
        <div class="fade">
        	<?php foreach ($event3 as $i) { ?>
            <div><a href="EventDescription.php?id=<?php echo $i['EventID']; ?>&Privacy=<?php echo $i['Privacy'] ?>&Status=<?php echo $i['Status'] ?>"><img width="600" height="350" src="<?php echo $i['EventLogo'] ?>" /></a></div>
            <?php } ?>
        </div>
          
          </div>
          <div id="HomeStats">
              <h2 id="HomeHeader">Statistics</h2>
            <label>Total Number of Events:   </label><?php foreach ($event as $i) { ?>
              <label><?php echo $i['NumberOfEvents']; ?></label>
              <?php } ?>
              <br />
            <label>Total Number of Events In This Month:   </label><?php foreach ($event1 as $i) { ?>
              <label><?php echo $i['NumberOfEvents']; ?></label>
              <?php } ?>
              <br />
            <label>Total Number of Events In This Week:   </label><?php foreach ($event2 as $i) { ?>
              <label><?php echo $i['NumberOfEvents']; ?></label>
              <?php } ?>
              
        </div>
    
            <script type="text/javascript" src="slick/jquery-2.1.1.min.js"></script>
            <script type="text/javascript" src="slick/slick.min.js"></script>      
    
          <script type="text/javascript">
        $(document).ready(function(){

$('.fade').slick({
  dots: true,
  infinite: true,
  speed: 500,
  fade: true,
  slide: 'div',
  cssEase: 'linear',

});

$('.fade').slickPlay();
                        });
              
            </script>
<?php include('Footer.php'); ?>