<?php
session_start();
if (isset($_SESSION['customerID']
$Body = "";

$errors = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Pick Playlist</title>
</head>
<body>

<h1>Pick Playlist</h1>
<?php 

$db = mysqli_connect('localhost', 'root', '!root');
mysqli_select_db($db, 'songs');

$query = 'SELECT * FROM song';

if ($r = mysqli_query($db, $query)) { 
    print "<form action='savePlaylist.php?<?php echo SID; ?>' method='POST'>
    <table  border=1>";
    while ($row = mysqli_fetch_array($r)) {
        print 
        "<tr>
        <td>{$row['SongID']}</td>
        <td>{$row['SongTitle']}</td>
        <td>{$row['SongLength']}</td>
        <td><input type='checkbox' name='pick[]' value='{$row["SongID"]}' /></td>
        </tr>";
    }
    print "</table>
    <input type='submit' value='Submit' />
    </form>";

} else { 
    print '<p style="color: blue">Error!</p>';
} 

mysqli_close($db); // Close the connection.

?>
</body>
</html>