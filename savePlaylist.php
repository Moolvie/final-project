<?php
session_start();
if (isset($_SESSION['customerID']{
$customerID = $_SESSION['customerID'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Confirmation</title>
</head>
<body>

<h1>save playlist</h1>
<?php 
$db = mysqli_connect('localhost', 'root', '!root');
mysqli_select_db($db, 'songs');

$query = 'SELECT * FROM song Where ';
$song_count = count($_POST['pick']);

for($i = 0; $i < $song_count; $i++) {
  $songid = (int)mysqli_real_escape_string($db, $_POST['pick'][$i]); // Secures It
  $query .= 'SongID = ' . $songid;
  if($i+1 < $song_count) {
    $query .= ' OR ';
  }
 
}

if ($r = mysqli_query($db, $query)) { 
   echo "<table border=1>";
    while ($row = mysqli_fetch_array($r)) {
       echo  "<tr> <td>{$row['SongID']}</td> <td>{$row['SongTitle']}</td> </tr>";
    }
    echo "</table>";

} else { 
    print '<p style="color: blue">Error!</p>';
} 


mysqli_close($db);
