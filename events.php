<?php
include_once 'database.php';
$query = "SELECT ev.EVENT_ID , ev.EVENT_START , cl.CLUB_ID , cl.CLUB_NAME , cl.STREET , ba.BAND_NAME FROM BANDS_TB ba, EVENTS_TB ev, BANDS_EVENTS_TB baev, CLUBS_TB cl WHERE ba.BAND_ID = baev.BAND_ID AND baev.EVENT_ID = ev.EVENT_ID AND ev.CLUB_ID = cl.CLUB_ID GROUP BY EVENT_ID ORDER BY EVENT_START DESC LIMIT 3";
//$query = "INSERT INTO BANDS_TB (BAND_NAME,BAND_DESC,TEL_NUMBER,EMAIL,PHOTO_PATH,VIDEO_URL) VALUES ('Nazwa zespolu', 'Opisssssssssssssss', '66666666','gamil@gamial.pl','http://wp.pl','http://youtube.com')";
$connect->query($query)
    or die("Bład");
echo "Wszystko dobrze :)"

?>