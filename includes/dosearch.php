<?php

// CONNECT DATABASE
$servername = "db.luddy.indiana.edu";
$username = "i494f21_team21";
$password = "my+sql=i494f21_team21";
$dbname = "i494f21_team21"; 
$conn = mysqli_connect($servername,$username,$password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}
$search_name = $_POST['name'];
$sql = "SELECT o_id,name FROM organizations WHERE name LIKE '%$search_name%'";

$result = mysqli_query($conn, $sql);
if(!$result) {
    echo $sql;
} else{

    while($data = mysqli_fetch_assoc($result)) {

        $data_search[] = $data;
    }
}
//determine if database has data for search
if (empty($data_search[0])){
    $sql = "SELECT o_id,event_name FROM events WHERE event_name LIKE '%$search_name%'";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        echo $sql;
    } else{
        while($data = mysqli_fetch_assoc($result)) {
            $data_search[] = $data;
        }
    }

}
$data_json = json_encode($data_search);//return to json data

echo $data_json;//output data
?>