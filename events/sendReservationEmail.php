<?php

session_start();
if(!isset($_SESSION['username'])){
    echo '<script type="text/javascript">';
    echo 'alert("You need to login in order to register for the event.");';
    echo '</script>';
} else {
    // CONNECT DATABASE
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
    $id = $_SESSION['id'];

    //select statements
    $sql_select = "SELECT email FROM members WHERE username = '".$cas_username."';";
    $sql_email = mysqli_query($conn, $sql_select);
    $data = mysqli_fetch_assoc($sql_email);
    $user_email = $data['email'];

    $sql_update = "UPDATE members SET e_id = $id WHERE username = '".$cas_username."';";
    if ($conn->query($sql_update) === TRUE) {
        echo "username: " .$cas_username. "<br>";
        echo "id: " .$id. "<br>";

      } else {
        echo "Error: " .$sql_update. "<br>".$conn->error;
      }

    $to = $user_email;
    $subject = 'Event Reservation Confirmation Youthon';
    $message = 'Thank you for your registration to Youthons event!';
    $send = mail($to, $subject, $message);
    if ($send == true){
        echo '<script type="text/javascript">';
        echo 'alert("Confirmation sent! Please check your email!");';
        echo 'window.location.href = "https://cgi.luddy.indiana.edu/~team21/events/events.php";';
        echo '</script>';
    } else {
        echo $user_email;
        echo '<script type="text/javascript">';
        echo 'alert("Message could not be send...");';
        echo 'window.location.href = "https://cgi.luddy.indiana.edu/~team21/events/events.php";';
        echo '</script>';
    }
    
}
?>