<?php
include_once 'database.php';
$band_ID = $_GET[id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once 'head.php';
    ?>
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<?php
    require_once 'header-muzycy.php';
?>

<!-- Main -->

<!-- Muzycy -->
<div id="muzycy2" class="page">
        <?php
            $name = 'Nazwa zespolu';
            $query = 'SELECT * FROM BANDS_TB WHERE BAND_ID = "'.$band_ID.'" ';
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
            }

        
 echo  '<div class="container">
      <!-- Title Page -->
        <div class="row">
            <div class="span12">
                <div class="title-page2">
                    <h2 id="band" class="title">' . $band_name . '</h2>
                </div>
            </div>
        </div>
        <!-- End Title Page -->
        
        <!-- Portfolio Projects -->
        <div class="row">

            <div class="span7">
              <div id="band_url" class="row">'
                  . $band_url .         
              '</div>
            </div>

          <div id="band_desc" class="span5">'
            . $band_desc .  '
            <h6 id="contact-form"> Email: '.$band_email.'</h6>
          </div>
            
        </div>
        <!-- End Portfolio Projects -->
    </div>'
?>
</div>
<!-- End Our Muzycy Section -->


<div id="kontakt">

    <?php
        require_once 'footer.php';
    ?>
</div>
<?php
    require_once 'bootstrapjs.php';
?>

</body>
</html>