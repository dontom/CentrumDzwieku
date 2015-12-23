<?php
require_once 'checksession.php';
include_once 'database.php';

$new_id=$_POST['new_id'];
$club_name=$_POST['nazwa'];
$club_tel=$_POST['tel'];
$club_email=$_POST['email'];
$club_adress=$_POST['ulica'];


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

            $query = "UPDATE CLUBS_TB SET CLUB_NAME='$club_name', TEL_NUMBER='$club_tel', EMAIL='$club_email', STREET='$club_adress' WHERE CLUB_ID='$new_id'";
            $connect->query($query)
            or die('Błąd zapytania');
}
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
echo "Klub zostal zaktualizoany.";
echo "</div>";
?>
</body>
</html>