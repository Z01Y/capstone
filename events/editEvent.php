<?php
    session_start();
    if(!isset($_SESSION['username'])){
      echo '<script type="text/javascript">';
      echo 'alert("Unauthorized page! Please login first!");';
      echo 'window.location.href = "https://cgi.luddy.indiana.edu/~team21/index/login.php";';
      echo '</script>';
    }
    else{
            $servername = "db.luddy.indiana.edu";
            $username = "i494f21_team21";
            $password = "my+sql=i494f21_team21";
            $dbname = "i494f21_team21";
            
            // Create connection
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " .$conn->connect_error);
            }
            
            $cas_username = $_SESSION["username"];
            if (isset($_POST['submit'])){
              $members_amount = $_POST['members_amount'];
              $participation_amount = $_POST['participation_amount'];
              $result = $_POST['result'];
          
              if(is_numeric($members_amount) && is_numeric($participation_amount)){
                $result = 100 + (100*($participation_amount/$members_amount));
                echo "<div>Points for your team: ".$result."</div>";
              }
              else{
                $error = "Enter Number first";
              }
            }
            $sql_points = "UPDATE events SET points = $result WHERE username = '".$cas_username."';";
            $sql_points2 = "UPDATE organizations SET points = points + $result WHERE m_username ='".$cas_username."';";
          
            mysqli_query($conn, $sql_points);
            mysqli_query($conn, $sql_points2);
          }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./createEvent.css" rel="stylesheet" />
    <title>Edit Event</title>

    <style>
    .description {
      border-radius: 10px;
      width: 250px;
      border-style: solid;
      border-width: thin;
      border-color: black;
      padding: 15px;
    }
  </style>

  </head>

  <body>
  <header>
      <div class="logo"><a href="https://cgi.luddy.indiana.edu/~team21/index/index.php">Youthon</a></div>
      <div class="menu-list">
        <a href="https://cgi.luddy.indiana.edu/~team21/events/events.php">Events</a>
        <a href="https://cgi.luddy.indiana.edu/~team21/organizations/organizationsPage.php">Organizations</a>
        <a href="https://cgi.luddy.indiana.edu/~team21/report/report.php">Report</a>
        <a href="#"><?php include_once("../includes/search.php")?></a>
      </div>
      
  </header>
	
	  <?php include './includes/header.php'; ?>
	
    <section class="nav">
      <div class="left">
        <div class="avatar">
          <div class="user-name">Username</div>
        </div>
        <div class="nav-item">
          <div><a href="https://cgi.luddy.indiana.edu/~team21/events/registeredEvent.php">Registered Events</a></div>
        </div>
        <div class="nav-item">
          <div><a href="https://cgi.luddy.indiana.edu/~team21/events/createEvent.php">Create Event</a></div>
        </div>
        <div class="nav-item">
          <div><a href="https://cgi.luddy.indiana.edu/~team21/events/editEvent.php">Edit Event</a></div>
        </div>

        <div class="nav-item">
          <div><a href = "https://cgi.luddy.indiana.edu/~team21/index/profile.php"> Back </a></div>
        </div>
		</div>
		
		<?php
			    $servername = "db.luddy.indiana.edu";
          $username = "i494f21_team21";
          $password = "my+sql=i494f21_team21";
          $dbname = "i494f21_team21";

	//  var_dump(122);exit;
            // Create connection
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " .$conn->connect_error);
            }
            
			
			//select statements
      $sql_select = "SELECT id,event_name, event_date, event_time, address, description FROM events WHERE username = '".$cas_username."';";			
			
      $select = mysqli_query($conn, $sql_select);
		
  ?>
		
  <div class="right">
		<div class="title ei">Event Information</div>      
    <div class="line"> 
			<?php while ($data = mysqli_fetch_assoc($select)) {?>
		  <div class="form-item">
        <fieldset>
			  <label><b>Event Name:</b> <?php echo $data['event_name']; ?> </label>
        <!-- <input type="text" placeholder="Culture Show" /> -->
      <br />
			  <label><b>Event Date:</b> <?php echo $data['event_date']; ?></label>
        <!-- <input type="text" placeholder="yyyy-mm-dd" /> -->
      <br />
			  <label><b>Event Time:</b> <?php echo $data['event_time']; ?> </label>
        <!-- <input type="text" placeholder="hh:mm:ss" /> -->
      <br />
			  <label><b>Location:</b> <?php echo $data['address']; ?> </label>
        <!-- <input type="text" placeholder="Wilkie Auditorium" /> -->
      <br />
      <br />
      <b>Event Description</b>
      <div class="description">
      <label> <?php echo $data['description']; ?></textarea> </label>
      </div>
      <br /> 
      <p align="right">
      <a href="saveEvent.php"><button>Edit Event Information</button></a>
      <button> <? echo "<a href='deleteEvent.php?username=$cas_username'<button type='button' >Delete Event</button></a>"; ?> </button>
      <br />
      <br/>
      <br />
        <a href="https://cgi.luddy.indiana.edu/~team21/includes/excel.php?e_id=<?php  echo $data['id']; ?>" target="_blank"><button>excel</button></a>
      <form action="editEvent.php" method="POST">
        <label>Number of members in your organization:</label><input type="text" name="members_amount"/><br>
        <label>Number of participations for this event:</label><input type="text" name="participation_amount"/><br>
        <input name="submit" type="submit" value="CALCULATE"/> 
      </form>
<?php }?>
  
    </fieldset>

      </div>
      </div>

			  
      </div>
    </section>

    <footer>
      <div class="link-wrap">
        <a href="https://www.indiana.edu">Resources</a>
        <a href="https://studentaffairs.indiana.edu/student-support/index.html">Help desk</a>
      </div>
      <div class="f-logo">Youthon</div>
    </footer> 
  </body>
</html>
