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
$club_name=$_POST['nazwa'];
$club_tel=$_POST['tel'];
$club_email=$_POST['email'];
$club_ulica=$_POST['ulica'];
$club_nr=$_POST['nrdomu'];

$club_adress = $club_ulica." ".$club_nr;

    $query = "INSERT INTO CLUBS_TB (CLUB_NAME,STREET,TEL_NUMBER,EMAIL) VALUES ('$club_name', '$club_adress', '$club_tel','$club_email')";
    $connect->query($query)
    or die('Błąd zapytania');
    echo "Wszystko dobrze :)";



echo "Klub zostal dodany.";
echo "</div>";
?>
</body>
</html>