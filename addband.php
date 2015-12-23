<?php
require_once 'checksession.php';
require_once 'database.php';
$query = 'SELECT * FROM BANDS_TB ORDER BY BAND_ID DESC LIMIT 1';
$result=$connect->query($query);
$row = $result->fetch_assoc();
$id_max = $row['BAND_ID'];
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

<form enctype="multipart/form-data" method="post" action="addbanddb.php">
        <div class="box">
            <h1>Dodaj zespół :</h1>
            <label>
                <span>Nazwa zespołu :</span>
                <input type="hidden" class="wpis" name="new_id" id="new_id" value="<?php echo $id_new; ?>"/>
                <input type="text" class="wpis" name="nazwa" id="nazwa"/>
            </label>
            <label>
                <span>E-mail :</span>
                <input type="text" class="wpis" name="email" id="email"/>
            </label>
            <label>
                <span>Nr tel (tylko cyfry, bez spacji lub -) :</span>
                <input type="text" class="wpis" name="tel" id="tel"/>
            </label>
            <label>
                <span>Youtube/Soundcloud :</span>
                <input type="text" class="wpis" name="youtube" id="youtube"/>
            </label>
            <label>
                <span>Facebook :</span>
                <input type="text" class="wpis" name="facebook" id="facebook"/>
            </label>
            <label>
                <span>Gatunek :</span>
                <select name="gat">
                    <option value="Rock">Rock</option>
                    <option value="Elektronika">Elektronika</option>
                    <option value="Hip-Hop">Hip-Hop</option>
                    <option value="Metal">Metal</option>
                    <option value="Blues">Blues</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Inny">Inny</option>
                </select>
            </label>
            <label>
                <span>Logo :</span>
                <input type="file" name="obrazek"/>
            </label>
            <label>
                <textarea class="wiadomosc" name="opis" id="opis">Opis zespołu</textarea>
                <input type="submit" class="button" value="Dodaj" />
            </label>
        </div>
    </form>
</body>
</html>
