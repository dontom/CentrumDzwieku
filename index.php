<?php
        require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en-US"> <!--<![endif]-->
<head>
    <?php
        require_once 'head.php';
    ?>
</head>

<body>
<?php include_once("analyticstracking.php") ?>

<!-- This section is for Splash Screen -->
<div class="ole">
<section id="jSplash">
  <div id="circle"></div>
</section>
</div>
<!-- End of Splash Screen -->

  <?php
    require_once 'slide.php';
  ?>

  <?php
    require_once 'header.php';
  ?>

<!-- Eventy -->
<div id="eventy">
      <div id="eventConteiner"> 
          <div id="eventList">    

                  <div id="nadchodzace">
                     <h2>KONCERTY</h2>
                  </div>

                  <a id="info" class="brow">
                    <div class="tabRow">                                            
                      <div class="colTab  phoneOff" id="dataFirst"> Data </div>
                      <div class="colTab  phoneOff" id="godzFirst"> Godzina </div>
                      <div class="colTab  phoneOff" id="lokalFirst"> Lokal </div>
                      <div class="colTab  phoneOff" id="ulicaFirst"> Ulica </div>
                      <div class="colTab  phoneOff" id="zespolFirst"> Zespół </div>
                      <div class="colTab  phoneOff" id="gatunekFirst"> Gatunek </div>
                    </div>          
                  </a> 

                <?php
                //$query = "SELECT EVENT_ID FROM EVENTS_TB";
                $query = "SELECT ev.EVENT_ID , DATE_FORMAT(ev.EVENT_START, '%d.%m'), ev.EVENT_DESC , DATE_FORMAT(ev.EVENT_START, '%H:%i'), cl.CLUB_ID , cl.CLUB_NAME , cl.STREET , ba.BAND_NAME, ba.GATUNEK, DAYOFWEEK(ev.EVENT_START), ev.EVENT_NAME, ev.GAT_NEW FROM BANDS_TB ba, EVENTS_TB ev, BANDS_EVENTS_TB baev, CLUBS_TB cl WHERE ba.BAND_ID = baev.BAND_ID AND baev.EVENT_ID = ev.EVENT_ID AND ev.CLUB_ID = cl.CLUB_ID AND ev.EVENT_START > NOW() GROUP BY EVENT_ID ORDER BY EVENT_START ASC LIMIT 7";
                $result = $connect->query($query) or
                die("Bład bazy/query");

                while($x = $result->fetch_row())
                {
                    $gat_new ="";
                    if($x[7] == "inny")
                    $dzien = "";
                    switch ($x[9]) {
                        case 7:
                            $dzien = "Sob";
                            break;
                        case 1:
                            $dzien = "Nd";
                            break;
                        case 2:
                            $dzien = "Pon";
                            break;

                        case 3:
                            $dzien = "Wt";
                            break;

                        case 4:
                            $dzien = "Śr";
                            break;

                        case 5:
                            $dzien = "Czw";
                            break;

                        case 6:
                            $dzien = "Pt";
                            break;
                    }
                    if($x[11] && $x[7] == "inny")
                        $gat_new =  "$x[11]";
                    else if($x[11])
                        $gat_new = ", $x[11]";
                    if($x[10] && $x[7] == "inny")
                    {
                        echo '
                    <a class="brow" href="' . $x[2] . '" target="_blank">
                    <div class="tabRow">
                      <div class="colTab middle">
                       <div class="colData" id="data"><span class="colDataDay">' . $x[1] . ' </span> ' . $dzien . ' </div>
                      </div>
                      <div class="colTab middle">
                       <div class="colData" id="godz">' . $x[3] . '</div>
                      </div>
                      <div class="colTab big">' . $x[5] . '</div>
                      <div class="colTab small" id="adres"> ' . $x[6] . ' </div>
                      <div class="colTab big phoneOff" id="zespol">' .$x[10]. ' </div>
                      <div class="colTab small" id="gatunek">'.$gat_new.' </div>
                    </div>
                  </a>
                    ';
                    }
                    else if ($x[10]){
                        echo '
                    <a class="brow" href="' . $x[2] . '" target="_blank">
                    <div class="tabRow">
                      <div class="colTab middle">
                       <div class="colData" id="data"><span class="colDataDay">' . $x[1] . ' </span> ' . $dzien . ' </div>
                      </div>
                      <div class="colTab middle">
                       <div class="colData" id="godz">' . $x[3] . '</div>
                      </div>
                      <div class="colTab big">' . $x[5] . '</div>
                      <div class="colTab small" id="adres"> ' . $x[6] . ' </div>
                      <div class="colTab big phoneOff" id="zespol"> ' . $x[7] . ', '.$x[10].' </div>
                      <div class="colTab small" id="gatunek">' . $x[8] . ''.$gat_new. '</div>
                    </div>
                  </a>
                    ';
                    }
                    else{
                        echo '
                    <a class="brow" href="' . $x[2] . '" target="_blank">
                    <div class="tabRow">
                      <div class="colTab middle">
                       <div class="colData" id="data"><span class="colDataDay">' . $x[1] . ' </span> ' . $dzien . ' </div>
                      </div>
                      <div class="colTab middle">
                       <div class="colData" id="godz">' . $x[3] . '</div>
                      </div>
                      <div class="colTab big">' . $x[5] . '</div>
                      <div class="colTab small" id="adres"> ' . $x[6] . ' </div>
                      <div class="colTab big phoneOff" id="zespol"> ' . $x[7] . ' </div>
                      <div class="colTab small" id="gatunek">' . $x[8] . ''.$gat_new. '</div>
                    </div>
                  </a>
                    ';
                    }
                }

              ?>
          </div>  
      </div>  
</div>


<!-- Muzycy -->
<div id="muzycy" class="page">
  <div class="container">
      <!-- Title Page -->
        <div class="row">
            <div class="span12">
                <div class="title-page">
                    <h2 class="title">Zespoły</h2>
                </div>
            </div>
        </div>
        <!-- End Title Page -->
        
        <!-- Portfolio Projects -->
        <div class="row">
          <div class="span3">
              <!-- Filter -->
                <nav id="options" class="work-nav">
                    <ul id="filters" class="option-set" data-option-key="filter">
                      <li class="type-work">Gatunek</li>
                        <li><a href="#filter" data-option-value="*" class="selected">Wszystkie</a></li>
                        <li><a href="#filter" data-option-value=".Rock">Rock</a></li>
                        <li><a href="#filter" data-option-value=".Blues">Blues</a></li>
                        <li><a href="#filter" data-option-value=".Jazz">Jazz</a></li>
                        <li><a href="#filter" data-option-value=".Metal">Metal</a></li>
                        <li><a href="#filter" data-option-value=".Hip-Hop">Hip Hop</a></li>
                        <li><a href="#filter" data-option-value=".Elektronika">Elektronika</a></li>
                    </ul>
                </nav>
                <!-- End Filter -->
            </div>
            
            <div class="span9">
              <div class="row">
                  <section id="projects">
                      <ul id="thumbs">
              
                            <?php
                              $query = "SELECT GATUNEK, PHOTO_PATH, BAND_NAME, BAND_ID FROM BANDS_TB";
                              $result=$connect->query($query);

                                if(!$result) {
                                    trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connect->error, E_USER_ERROR);
                                }
                                
                                $result->data_seek(0);
                                while($row = $result->fetch_assoc()){ //local hosta na ip bazy danych - mysql connect
                                    if($row['BAND_NAME'] == "inny")
                                        continue;
                                    $band_name = $row['BAND_NAME'];
                                    $band_gatunek = $row['GATUNEK'];
                                    $band_photo = $row['PHOTO_PATH'];
                                    $band_id = $row['BAND_ID'];
                                    echo '
                                       <li class="item-thumbs span3 '.$band_gatunek.'">
                                                  <!-- Fancybox - Gallery Enabled - Title - Full Image -->
                                                  <a class="hover-wrap fancybox" href="band.php?id='.$band_id.'">
                                                      <span class="overlay-img"></span>
                                                      <span class="overlay-img-thumb">'.$band_name.'</span>
                                                    </a>
                                                    <!-- Thumb Image and Description -->
                                                    <img src="'.$band_photo.'" alt="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis elementum odio. Curabitur pellentesque, dolor vel pharetra mollis.">
                                                </li>
                                    ';

                                }
                               
                            ?>

                      </ul>
                  </section>
                    
              </div>
            </div>
        </div>
        <!-- End Portfolio Projects -->

        <div id="content">
  
        </div>
    </div>
</div>
<!-- End Our Muzycy Section -->


<!-- Socialize -->
<div id="social-area" class="page">
  <div class="container">
      <div class="row">
            <div class="span12">
                <nav id="social">
                    <ul>
                        <li><a href="https://twitter.com/CentrumDzwieku" title="Follow Us on Twitter" target="_blank"><span class="font-icon-social-twitter"></span></a></li>
                        <li><a href="https://www.facebook.com/pages/Centrum-D%C5%BAwi%C4%99ku/1100078810007779?fref=ts" title="Follow Us on Facebook" target="_blank"><span class="font-icon-social-facebook"></span></a></li>
                        <!-- <li><a href="#" title="Follow Us on Google Plus" target="_blank"><span class="font-icon-social-google-plus"></span></a></li> -->
                        <li><a href="https://instagram.com/centrumdzwieku/" title="Follow Us on Instagram" target="_blank"><span class="font-icon-camera"></span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Socialize -->

<!-- Footer -->
<?php
  require_once 'footer.php';
?>
<!-- End Footer -->

<!-- Back To Top -->
<a id="back-to-top" href="#home-slider">
  <i class="font-icon-arrow-simple-up"></i>
</a>
<!-- End Back to Top -->

  <?php
    require_once 'bootstrapjs.php';
  ?>

</body>
</html>