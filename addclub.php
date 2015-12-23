<?php
require_once 'checksession.php';
require_once 'database.php';
$query = 'SELECT * FROM CLUBS_TB ORDER BY CLUB_ID DESC LIMIT 1';
$result=$connect->query($query);
$row = $result->fetch_assoc();
$id_max = $row['CLUB_ID'];
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

<form enctype="multipart/form-data" method="post" action="addclubdb.php">
    <div class="box">
        <h1>Dodaj klub :</h1>
        <label>
            <span>Nazwa klubu :</span>
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
            <span>Ulica :</span>
            <input type="text" class="wpis" name="ulica" id="ulica"/>
        </label>
        <label>
            <span>Nr domu :</span>
            <input type="text" class="wpis" name="nrdomu" id="nrdomu"/>
        </label>
        <label>
            <input type="submit" class="button" value="Dodaj" />
        </label>
    </div>
</form>
</body>
</html>