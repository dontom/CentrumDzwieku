<?php
require_once 'checksession.php';
require_once 'database.php';
?>
<!DOCTYPE html>
<html>
<head><!-- CDN hosted by Cachefly -->
    <meta>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    </meta>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea', width : 798});</script>
    <link href="css/admin.css" rel="stylesheet">
</head>
<body>
<div>
    <?php require_once 'adminmenu.php'; ?>
</div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_POST['delete'][0];
    $id_event = substr($_POST['delete'], 1);
    if($action === 'e')
    {
        echo "$id_event";
        $query = 'SELECT ev.EVENT_ID, ev.EVENT_NAME, ev.EVENT_START, ev.EVENT_DESC, cl.CLUB_ID, cl.CLUB_NAME, ba.BAND_NAME, ba.BAND_ID, ev.GAT_NEW FROM BANDS_TB ba, EVENTS_TB ev, BANDS_EVENTS_TB baev, CLUBS_TB cl WHERE ba.BAND_ID = baev.BAND_ID AND baev.EVENT_ID = ev.EVENT_ID AND ev.CLUB_ID = cl.CLUB_ID AND ev.EVENT_ID = '.$id_event.' ';
        $result=$connect->query($query);
        if($result === false) {
            trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connect->error, E_USER_ERROR);
        }
        else {
            //$rows_returned = $result->num_rows;
        }//BAND_NAME,BAND_DESC,TEL_NUMBER,EMAIL,PHOTO_PATH,VIDEO_URL
        $result->data_seek(0);
        while($row = $result->fetch_assoc()){
            $event_name = $row['EVENT_NAME'];
            $event_fulldate = $row['EVENT_START'];
            $event_club_id = $row['CLUB_ID'];
            $event_club_name = $row['CLUB_NAME'];
            $event_band_id = $row['BAND_ID'];
            $event_band_name = $row['BAND_NAME'];
            $event_fb = $row['EVENT_DESC'];
            $event_adress = $row['STREET'];
            $event_gat_new = $row['GAT_NEW'];
        }
        echo '
        <form enctype="multipart/form-data" method="post" action="edditeventdb.php">
    <div class="box">
        <h1>Edytuj wydarzenie :</h1>
        <label>
            <span>Zespoly spoza listy :</span>
            <input type="hidden" class="wpis" name="new_id" id="new_id" value="'.$id_event.'"/>
            <input type="text" class="wpis" name="nazwa" id="nazwa" value="'.$event_name.'"/>
        </label>
        <label>
            <span>Data (w formacie rrrr-mm-dd hh:mm):</span>
            <input type="text" class="wpis" name="data" id="data" value="'.$event_fulldate.'"/>
        </label>
        <label>
            <span>Link FB :</span>
            <input type="text" class="wpis" name="link" id="link" value="'.$event_fb.'"/>
        </label>
        <label>
            <span>Dodatkowe gatunki :</span>
            <input type="text" class="wpis" name="gat_new" id="gat_new" value="'.$event_gat_new.'"/>
        </label>
        <label>
            <span>Miejsce :</span>
            <select name="miejsce">
            ';
            $query = 'SELECT * FROM CLUBS_TB WHERE CLUB_ID != '.$event_club_id.' ORDER BY CLUB_ID DESC';
                $result=$connect->query($query);
                // generujemy wpisy z bazy jako komórki tabeli
                echo '<option value="'.$event_club_id.'" >'.$event_club_name.'</option>';
                if (mysqli_num_rows($result) > 0) {
                    while ($x = $result->fetch_assoc()) {
                        echo '<option value="'.$x['CLUB_ID'].'" >'.$x['CLUB_NAME'].'</option>';
                    }
                }
        echo '
            </select>
        </label>
            <label>
            <span>Zespół :</span>
            <select name="zespol">
            ';
            $query = 'SELECT * FROM BANDS_TB WHERE BAND_ID != '.$event_band_id.' ORDER BY BAND_ID DESC';
            $result=$connect->query($query);
            // generujemy wpisy z bazy jako komórki tabeli
            echo '<option value="'.$event_band_id.'" >'.$event_band_name.'</option>';
            if (mysqli_num_rows($result) > 0) {
                while ($x = $result->fetch_assoc()) {
                    echo '<option value="'.$x['BAND_ID'].'" >'.$x['BAND_NAME'].'</option>';
                }
            }
        echo '
            </select>
        </label>
        <label>
            <input type="submit" class="button" value="Dodaj" />
        </label>
    </div>
</form>
        ';
    }
    else if($action === 'd')
    {
        $sql = "DELETE FROM EVENTS_TB WHERE EVENT_ID='$id_event'";

        if ($connect->query($sql) === TRUE) {
            echo '<div class="lista">';
            echo "Masz szczęście :) - Wszystko przebiegło prawidłowo.";
            echo "</div>";
        } else {
            echo '<div class="lista">';
            echo "Błąd, polej komputer wodą lub zawołaj admina: " . $connect->error;
            echo "</div>";
        }
    }
    else
    {
        echo '<br> Zły wybór';
    }
}
else {
    $query = 'SELECT ev.EVENT_ID, ev.EVENT_NAME, ev.EVENT_START, cl.CLUB_NAME, ba.BAND_NAME FROM BANDS_TB ba, EVENTS_TB ev, BANDS_EVENTS_TB baev, CLUBS_TB cl WHERE ba.BAND_ID = baev.BAND_ID AND baev.EVENT_ID = ev.EVENT_ID AND ev.CLUB_ID = cl.CLUB_ID GROUP BY EVENT_ID ORDER BY EVENT_START DESC';

    $result=$connect->query($query);
    echo '<div class="lista">';
    // generujemy wpisy z bazy jako komórki tabeli
    $z = 0;
    if (mysqli_num_rows($result) > 0) {
        echo '
        <form method="post" action="edditevent.php">
    <table border="0" style="color: black">
    <tr>
    <th>Akcja</th>
    <th>Id</th>
    <th>Zespoły spoza listy</th>
    <th>Data</th>
    <th>Miejsce</th>
    <th>Zespół</th>
    </tr>
    ';
        while ($x = $result->fetch_assoc()) {
            echo '<tr class="ale' . $z . '">';
            echo '<td><input type="radio" name="delete" value="d' . $x['EVENT_ID'] . '" />Usuń <input type="radio" name="delete" value="e' . $x['EVENT_ID'] . '" />Edytuj</td>';
            echo '<td>' . $x['EVENT_ID'] . '</td>';
            echo '<td>' . $x['EVENT_NAME'] . '</td>';
            echo '<td>' . $x['EVENT_START'] . '</td>';
            echo '<td>' . $x['CLUB_NAME'] . '</td>';
            echo '<td>' . $x['BAND_NAME'] . '</td>';
            echo "</tr>";
            $z++;
            $z = $z % 2;

        }

        echo '
        <tr><td><input type="submit" class="button" value="Wykonaj" /></td></tr>
    </table>
    </form>
    ';
    }
    else {
        echo "Brak rekordów, dodaj je";
    }
    echo '</div>';
}
?>
</body>
</html>