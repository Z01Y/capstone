<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./createEvent.css" rel="stylesheet" />
    <title>Register Event</title>

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
            
            // Create connection
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " .$conn->connect_error);
            }
            session_start();

            $cas_username = $_SESSION["username"];
			      $id = $_SESSION["id"];
			
			//select statements
			$sql_select = "SELECT events.event_name, events.event_date, events.event_time, events.address, events.description FROM events, members WHERE events.id = members.e_id AND members.username = '".$cas_username."';";
			
			$select = mysqli_query($conn, $sql_select);
		
  ?>
		
  <div class="right">
		<div class="title ei">Registered Event</div>      
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
      <button> <? echo "<a href='cancelEvent.php?username=$cas_username'<button type='button' >Cancel Registration</button></a>"; ?> </button>
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