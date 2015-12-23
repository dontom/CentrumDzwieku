<?php
require_once 'checksession.php';
?>
<!DOCTYPE html>
<html>
<head><!-- CDN hosted by Cachefly -->
    <meta>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    </meta>
    <link href="css/admin.css" rel="stylesheet">
</head>
<body>
<?php
require_once 'adminmenu.php';
echo '<div class="lista">';

include_once 'database.php';


$new_id=$_POST['new_id'];
$event_name=$_POST['nazwa'];
$event_data=$_POST['data'];
$event_club_id=$_POST['miejsce'];
$event_band_id=$_POST['zespol'];
$event_fb=$_POST['link'];
$event_gat_new = $_POST['gat_new'];
 echo $event_data;


$query = "UPDATE EVENTS_TB SET EVENT_NAME='$event_name', EVENT_START='$event_data', CLUB_ID='$event_club_id', EVENT_DESC='$event_fb', GAT_NEW ='$event_gat_new'  WHERE EVENT_ID='$new_id'";
$connect->query($query)
or die('Błąd zapytania');
$event_id = $connect->insert_id;
echo $event_id;
$query = "UPDATE BANDS_EVENTS_TB SET BAND_ID='$event_band_id'  WHERE EVENT_ID='$new_id'";
$connect->query($query)
or die("Bład SQL");
echo "Wydarzenie zostało dodane.";
echo "</div>";
?>
</body>
</html>