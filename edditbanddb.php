<?php
require_once 'checksession.php';
include_once 'database.php';
/*$new_id=$_POST['id_new'];
$band_name=$_POST['nazwa'];
$band_desc=$_POST['opis'];
$band_tel=$_POST['tel'];
$band_email=$_POST['email'];
*/
$new_id=$_POST['new_id'];
$band_photo_old ="";
$query1 = 'SELECT * FROM BANDS_TB WHERE BAND_ID = "'.$new_id.'" ';
$result1=$connect->query($query1)
    or die("Blad SQL");


$result1->data_seek(0);
while($row = $result1->fetch_assoc()){
    $band_photo_old = $row['PHOTO_PATH'];
}
$band_name=$_POST['nazwa'];
$band_desc=$_POST['opis'];
$band_tel=$_POST['tel'];
$band_email=$_POST['email'];
$band_youtube=$_POST['youtube'];
$gat=$_POST['gat'];
$band_fb = $_POST['facebook'];
$f = $_FILES['obrazek'];

if($f['type'] == 'image/png')
    $ext=".png";
else if($f['type'] == 'image/jpeg')
    $ext=".jpeg";
else if($f['type'] == 'image/gif')
    $ext=".gif";

$band_youtube = str_replace('width="100%"', 'width="50%"', $band_youtube);
//echo "$new_id <br> $band_name <br> $band_desc <br> $band_email <br> $band_tel<br> $band_photo <br> $patch";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($f['type'] == 'image/png' or $f['type'] == 'image/jpeg' or $f['type'] == 'image/gif') {
        $x = getimagesize($f['tmp_name']);
        IF(!is_array($x) or $x[0] < 2)
        {
            die('Zły plik graficzny');
        }
        $patch = str_replace('edditbanddb.php', '', $_SERVER['SCRIPT_FILENAME']);
        $patch = $patch."img/";
        $band_photo = "img/$new_id$ext";
        if($band_photo != $band_photo_old && !file_exists($band_photo)) {
            copy($f['tmp_name'], $patch . $new_id . $ext);
            $query = "UPDATE BANDS_TB SET BAND_NAME='$band_name', BAND_DESC='$band_desc', TEL_NUMBER='$band_tel', EMAIL='$band_email', PHOTO_PATH='$band_photo', GATUNEK='$gat', FACEBOOK='$band_fb' WHERE BAND_ID='$new_id'";
            $connect->query($query)
            or die('Błąd zapytania');
        } else{
            chmod($band_photo_old,0755); //Change the file permissions if allowed
            unlink($band_photo_old); //remove the file
            copy($f['tmp_name'], $patch . $new_id . $ext);
            $query = "UPDATE BANDS_TB SET BAND_NAME='$band_name', BAND_DESC='$band_desc', TEL_NUMBER='$band_tel', EMAIL='$band_email', GATUNEK='$gat', FACEBOOK='$band_fb' WHERE BAND_ID='$new_id'";
            $connect->query($query)
            or die('Błąd zapytania');
        }
    }
    else {

 ////////////////tutaj skonczylem , dodac obsluge zamiany obrazka
       /* if(file_exists('your-filename.ext') {
        chmod('your-filename.ext',0755); //Change the file permissions if allowed
        unlink('your-filename.ext'); //remove the file
    }

        move_uploaded_files($_FILES['image']['tmp_name'], 'your-filename.ext');*/


        $query = "UPDATE BANDS_TB SET BAND_NAME='$band_name', BAND_DESC='$band_desc', TEL_NUMBER='$band_tel', EMAIL='$band_email', GATUNEK='$gat' FACEBOOK='$band_fb' WHERE BAND_ID='$new_id'";
        $connect->query($query)
        or die('Błąd zapytania');
        //echo "Wszystko dobrze :)"
    }
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
echo "Zespol zostal zaktualizoany.";
echo "</div>";
?>
</body>
</html>