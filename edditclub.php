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
    $id_club = substr($_POST['delete'], 1);
    if($action === 'e')
    {
        $query = "SELECT * FROM CLUBS_TB WHERE CLUB_ID='$id_club'";
        $result=$connect->query($query);
        if($result === false) {
            trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connect->error, E_USER_ERROR);
        }
        else {
            //$rows_returned = $result->num_rows;
        }//BAND_NAME,BAND_DESC,TEL_NUMBER,EMAIL,PHOTO_PATH,VIDEO_URL
        $result->data_seek(0);
        while($row = $result->fetch_assoc()){
            $club_name = $row['CLUB_NAME'];
            $club_tel = $row['TEL_NUMBER'];
            $club_email = $row['EMAIL'];
            $club_adress = $row['STREET'];
        }
        echo '
        <form enctype="multipart/form-data" method="post" action="edditclubdb.php">
    <div class="box">
        <h1>Edytuj klub :</h1>
        <label>
            <span>Nazwa klubu :</span>
            <input type="hidden" class="wpis" name="new_id" id="new_id" value="'.$id_club.'"/>
            <input type="text" class="wpis" name="nazwa" id="nazwa" value="'.$club_name.'"/>
        </label>
        <label>
            <span>E-mail :</span>
            <input type="text" class="wpis" name="email" id="email" value="'.$club_email.'"/>
        </label>
        <label>
            <span>Nr tel (tylko cyfry, bez spacji lub -) :</span>
            <input type="text" class="wpis" name="tel" id="tel" value="'.$club_tel.'"/>
        </label>
        <label>
            <span>Adres :</span>
            <input type="text" class="wpis" name="ulica" id="ulica" value="'.$club_adress.'"/>
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
        $sql = "DELETE FROM CLUBS_TB WHERE CLUB_ID='$id_club'";

        if ($connect->query($sql) === TRUE) {
            echo '<div class="lista">';
            echo "Masz szczęście :) - Wszystko przebiegło prawidłowo.";
            echo "</div>";
        } else {
            echo '<div class="lista">';
            echo "Błąd, polej komputer wodą lub zawołaj admina: " . $connect->error;
            echo "</div>";
        }
        $sql = "DELETE FROM EVENTS_TB WHERE CLUB_ID='$id_club'";

        if ($connect->query($sql) === TRUE) {

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
    $query = 'SELECT * FROM CLUBS_TB ORDER BY CLUB_ID DESC';
    $result=$connect->query($query);
    echo '<div class="lista">';
    // generujemy wpisy z bazy jako komórki tabeli
    $z = 0;
    if (mysqli_num_rows($result) > 0) {
        echo '
        <form method="post" action="edditclub.php">
    <table border="0" style="color: black">
    <tr>
    <th>Akcja</th>
    <th>Id</th>
    <th>Nazwa</th>
    <th>Tel</th>
    <th>E-mail</th>
    <th>Adres</th>
    </tr>
    ';
        while ($x = $result->fetch_assoc()) {
            echo '<tr class="ale' . $z . '">';
            echo '<td><input type="radio" name="delete" value="d' . $x['CLUB_ID'] . '" />Usuń <input type="radio" name="delete" value="e' . $x['CLUB_ID'] . '" />Edytuj</td>';
            echo '<td>' . $x['CLUB_ID'] . '</td>';
            echo '<td>' . $x['CLUB_NAME'] . '</td>';
            echo '<td>' . $x['TEL_NUMBER'] . '</td>';
            echo '<td>' . $x['EMAIL'] . '</td>';
            echo '<td>' . $x['STREET'] . '</td>';
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