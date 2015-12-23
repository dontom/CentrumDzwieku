<?php
require_once 'checksession.php';
require_once 'database.php';
$query = 'SELECT * FROM EVENTS_TB ORDER BY EVENT_ID DESC LIMIT 1';
$result=$connect->query($query);
$row = $result->fetch_assoc();
$id_max = $row['EVENT_ID'];
$id_new = $id_max + 1;
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

<form enctype="multipart/form-data" method="post" action="addeventdb.php">
    <div class="box">
        <h1>Dodaj wydarzenie :</h1>
        <label>
            <span>Zespoły spoza listy :</span>
            <input type="hidden" class="wpis" name="new_id" id="new_id" value="<?php echo $id_new; ?>"/>
            <input type="text" class="wpis" name="nazwa" id="nazwa"/>
        </label>
        <label>
            <span>Data (w formacie rrrr-mm-dd) :</span>
            <input type="text" class="wpis" name="data" id="data"/>
        </label>
        <label>
            <span>Godzina w formacie (hh:mm) :</span>
            <input type="text" class="wpis" name="godzina" id="godzina"/>
        </label>
        <label>
            <span>Link do FB :</span>
            <input type="text" class="wpis" name="link" id="link"/>
        </label>
        <label>
            <span>Dodatkowe gatunki :</span>
            <input type="text" class="wpis" name="gat_new" id="gat_new"/>
        </label>
        <label>
            <span>Miejsce :</span>
            <select name="miejsce">
            <?php
                $query = 'SELECT * FROM CLUBS_TB ORDER BY CLUB_ID DESC';
                $result=$connect->query($query);
                // generujemy wpisy z bazy jako komórki tabeli
                if (mysqli_num_rows($result) > 0) {
                    while ($x = $result->fetch_assoc()) {
                        echo '<option value="'.$x['CLUB_ID'].'" >'.$x['CLUB_NAME'].'</option>';
                    }
                }
            ?>
            </select>
        </label>
        <label>
            <span>Zespół :</span>
            <select name="zespol">
                <?php
                $query = 'SELECT * FROM BANDS_TB ORDER BY BAND_ID DESC';
                $result=$connect->query($query);
                // generujemy wpisy z bazy jako komórki tabeli
                if (mysqli_num_rows($result) > 0) {
                    while ($x = $result->fetch_assoc()) {
                        echo '<option value="'.$x['BAND_ID'].'" >'.$x['BAND_NAME'].'</option>';
                    }
                }
                ?>
            </select>
        </label>

        <label>
            <input type="submit" class="button" value="Dodaj" />
        </label>
    </div>
</form>
</body>
</html>