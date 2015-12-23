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
$event_godzina=$_POST['godzina'];
$event_fb=$_POST['link'];
$event_club_id=$_POST['miejsce'];
$event_band_id=$_POST['zespol'];
$event_gat_new=$_POST['gat_new'];


$event_data_full = $event_data." ".$event_godzina;
echo "$event_data_full <br>";
$query = "INSERT INTO EVENTS_TB (CLUB_ID,EVENT_NAME,EVENT_DESC,EVENT_START,GAT_NEW) VALUES ('$event_club_id', '$event_name', '$event_fb','$event_data_full','$event_gat_new')";
$connect->query($query)
or die('Błąd zapytania');
$event_id = $connect->insert_id;
echo $event_id;
$query = "INSERT INTO BANDS_EVENTS_TB (BAND_ID,EVENT_ID) VALUES ('$event_band_id', '$event_id')";
$connect->query($query)
or die("Bład SQL");
echo "Wydarzenie zostało dodane.";
echo "</div>";
?>
</body>
</html>