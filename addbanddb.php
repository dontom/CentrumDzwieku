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

/*$new_id=$_POST['id_new'];
$band_name=$_POST['nazwa'];
$band_desc=$_POST['opis'];
$band_tel=$_POST['tel'];
$band_email=$_POST['email'];
*/
$gat=$_POST['gat'];
$new_id=$_POST['new_id'];
$band_name=$_POST['nazwa'];
$band_desc=$_POST['opis'];
$band_tel=$_POST['tel'];
$band_email=$_POST['email'];
$band_photo ="img/$new_id";
$band_youtube=$_POST['youtube'];
$f = $_FILES['obrazek'];
$band_fb = $_POST['facebook'];

if($f['type'] == 'image/png')
    $ext=".png";
    else if($f['type'] == 'image/jpeg')
        $ext=".jpeg";
        else if($f['type'] == 'image/gif')
            $ext=".gif";

IF($f['type'] == 'image/png' or $f['type'] == 'image/jpeg' or $f['type'] == 'image/gif')
{
    $x = getimagesize($f['tmp_name']);
    if(!is_array($x) or $x[0] < 2)
    {
        die('Zły plik graficzny');
    }
    $patch = str_replace('addbanddb.php', '', $_SERVER['SCRIPT_FILENAME']);
    $patch = $patch."img/";
    copy($f['tmp_name'], $patch.$new_id.$ext);
    $band_photo = "img/$new_id$ext";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $band_youtube = str_replace('width="100%"', 'width="50%"', $band_youtube);
        $query = "INSERT INTO BANDS_TB (BAND_NAME,BAND_DESC,TEL_NUMBER,EMAIL,PHOTO_PATH,VIDEO_URL,GATUNEK,FACEBOOK) VALUES ('$band_name', '$band_desc', '$band_tel','$band_email','$band_photo','$band_youtube','$gat', '$band_fb')";
        $connect->query($query)
        or die('Błąd zapytania');
        echo "Wszystko dobrze :)";
    }
}
else
{
    $band_youtube = str_replace('width="100%"', 'width="50%"', $band_youtube);
    $query = "INSERT INTO BANDS_TB (BAND_NAME,BAND_DESC,TEL_NUMBER,EMAIL,PHOTO_PATH,VIDEO_URL,GATUNEK,FACEBOOK) VALUES ('$band_name', '$band_desc', '$band_tel','$band_email','','$band_youtube', '$gat', '$band_fb')";
    $connect->query($query)
    or die('Błąd zapytania');
    echo "Wszystko dobrze :)";
}
//echo "$new_id <br> $band_name <br> $band_desc <br> $band_email <br> $band_tel<br> $band_photo <br> $patch";


echo "Zespol zostal dodany.";
echo "</div>";
?>
</body>
</html>