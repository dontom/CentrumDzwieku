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
    $id_band = substr($_POST['delete'], 1);
    if($action === 'e')
    {
        $query = "SELECT * FROM BANDS_TB WHERE BAND_ID='$id_band'";
        $result=$connect->query($query);
        if($result === false) {
            trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connect->error, E_USER_ERROR);
        }
        else {
            //$rows_returned = $result->num_rows;
        }//BAND_NAME,BAND_DESC,TEL_NUMBER,EMAIL,PHOTO_PATH,VIDEO_URL
        $result->data_seek(0);
        while($row = $result->fetch_assoc()){
            $band_name = $row['BAND_NAME'];
            $band_desc = $row['BAND_DESC'];
            $band_url = $row['VIDEO_URL'];
            $band_tel = $row['TEL_NUMBER'];
            $band_email = $row['EMAIL'];
            $band_photo = $row['PHOTO_PATH'];
            $gat = $row['GATUNEK'];
            $band_fb = $row['FACEBOOK'];
        }
        echo '
        <form enctype="multipart/form-data" method="post" action="edditbanddb.php">
        <div class="box">
            <h1>Edytuj zespół :</h1>
            <label>
                <span>Nazwa zespołu :</span>
                <input type="hidden" class="wpis" name="new_id" id="new_id" value="' .$id_band.'"/>
                <input type="text" class="wpis" name="nazwa" id="nazwa" value="'.$band_name.'"/>
            </label>
            <label>
                <span>E-mail :</span>
                <input type="text" class="wpis" name="email" id="email" value="'.$band_email.'" />
            </label>
            <label>
                <span>Nr tel (tylko cyfry, bez spacji lub -) :</span>
                <input type="text" class="wpis" name="tel" id="tel" value="'.$band_tel.'"/>
            </label>
            <label>
                <span>Youtube/Soundcloud :</span>
                <input type="text" class="wpis" name="youtube" id="youtube" value="'.htmlspecialchars($band_url).'"/>
            </label>
            <label>
            <span>Facebook :</span>
                <input type="text" class="wpis" name="facebook" id="facebook" value="'.htmlspecialchars($band_fb).'"/>
            </label>
            <label>
                <span>Gatunek :</span>
                    <select name="gat">
                            ';
                        $query = 'SELECT GATUNEK FROM BANDS_TB WHERE BAND_ID = '.$id_band.'';
                        $result=$connect->query($query);
                        // generujemy wpisy z bazy jako komórki tabeli
                        if (mysqli_num_rows($result) > 0) {
                            while ($x = $result->fetch_assoc()) {
                                echo '<option value="'.$x['GATUNEK'].'" >'.$x['GATUNEK'].'</option>';
                                $current_gat = $x['GATUNEK'];
                            }
                            if("Rock" != $current_gat) echo '<option value="Rock" >Rock</option>';
                            if("Jazz" != $current_gat) echo '<option value="Jazz" >Jazz</option>';
                            if("Hip-Hop" != $current_gat) echo '<option value="Hip-Hop" >Hip-Hop</option>';
                            if("Elektronika" != $current_gat) echo '<option value="Elektronika" >Elektronika</option>';
                            if("Metal" != $current_gat) echo '<option value="Metal" >Metal</option>';
                            if("Blues" != $current_gat) echo '<option value="Blues" >Blues</option>';
                            if("Inny" != $current_gat) echo '<option value="Inny" >Inny</option>';
                        }
                        echo '
                    </select>
            </label>
            <label>
                <span>Logo :</span>
                <input type="file" name="obrazek"/>
            </label>
            <label>
                <textarea class="wiadomosc" name="opis" id="opis"><h1>'.$band_desc.'</h1></textarea>
                <input type="submit" class="button" value="Aktualizuj" />
            </label>
        </div>
    </form>
        ';
    }
    else if($action === 'd')
    {
        $sql = "DELETE FROM BANDS_TB WHERE BAND_ID='$id_band'";

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
    $query = 'SELECT * FROM BANDS_TB ORDER BY BAND_ID DESC';
    $result=$connect->query($query);
    echo '<div class="lista">';
    // generujemy wpisy z bazy jako komórki tabeli
    $z = 0;
    if (mysqli_num_rows($result) > 0) {
        echo '
        <form method="post" action="edditband.php">
    <table border="0" style="color: black">
    <tr>
    <th>Akcja</th>
    <th>Id</th>
    <th>Nazwa</th>
    <th>Tel</th>
    <th>E-mail</th>
    </tr>
    ';
        while ($x = $result->fetch_assoc()) {
            echo '<tr class="ale' . $z . '">';
            echo '<td><input type="radio" name="delete" value="d' . $x['BAND_ID'] . '" />Usuń <input type="radio" name="delete" value="e' . $x['BAND_ID'] . '" />Edytuj</td>';
            echo '<td>' . $x['BAND_ID'] . '</td>';
            echo '<td>' . $x['BAND_NAME'] . '</td>';
            echo '<td>' . $x['TEL_NUMBER'] . '</td>';
            echo '<td>' . $x['EMAIL'] . '</td>';
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