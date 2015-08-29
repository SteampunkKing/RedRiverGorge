<?php
include('includes/connect/mysql_conn.php');
include('includes/functions.php');
list($searchNameArray, $searchFromDateArray, $searchToDateArray, $searchAdultsArray, $searchChildrenArray, $searchPetsArray) = explode(",", $_SESSION['searchparms']);
list($searchNameKwd, $searchIDNameArray) = explode("~", $searchNameArray);
list($searchID, $searchName) = explode("_", $searchIDNameArray);
list($searchFromKwd, $searchFromDate) = explode("~", $searchFromDateArray);
list($searchToKwd, $searchToDate) = explode("~", $searchToDateArray);
list($searchAdultsKwd, $searchAdults) = explode("~", $searchAdultsArray);
list($searchChildrenKwd, $searchChildren) = explode("~", $searchChildrenArray);
list($searchPetsKwd, $searchPets) = explode("~", $searchPetsArray);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red River Gorge Cabin Rentals</title>

    <!-- Bootstrap -->
    <link href="dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="assets/css/custom.css" rel="stylesheet" media="screen">

    <!-- Carousel -->
    <link href="examples/carousel/carousel.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Fonts -->	
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	
    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="screen" />
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="css/fullscreen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

    <!-- Picker UI-->	
    <link rel="stylesheet" href="assets/css/jquery-ui.css" />		

    <!-- jQuery -->	
    <script src="assets/js/jquery.v2.0.3.js"></script>


  </head>
  <body id="top">

    <?php include('includes/header.php'); ?>


    <!--
    #################################
      - THEMEPUNCH BANNER -
    #################################
    -->
    <div id="dajy" class="fullscreen-container mtslide sliderbg fixed">
      <div class="fullscreenbanner">
        <ul>

          <!-- papercut fade turnoff flyin slideright slideleft slideup slidedown-->

          <!-- FADE -->
          <?php print GetSlideShow(); ?>
        </ul>
        <div class="tp-bannertimer none"></div>
      </div>
    </div>

    <!--
    ##############################
     - ACTIVATE THE BANNER HERE -
    ##############################
    -->
    <script type="text/javascript">

      var tpj = jQuery;
      tpj.noConflict();

      tpj(document).ready(function () {

        if (tpj.fn.cssOriginal != undefined)
          tpj.fn.css = tpj.fn.cssOriginal;

        tpj('.fullscreenbanner').revolution(
                {
                  delay: 9000,
                  startwidth: 1170,
                  startheight: 600,
                  onHoverStop: "on", // Stop Banner Timet at Hover on Slide on/off

                  thumbWidth: 100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                  thumbHeight: 50,
                  thumbAmount: 3,
                  hideThumbs: 0,
                  navigationType: "bullet", // bullet, thumb, none
                  navigationArrows: "solo", // nexttobullets, solo (old name verticalcentered), none

                  navigationStyle: false, // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


                  navigationHAlign: "left", // Vertical Align top,center,bottom
                  navigationVAlign: "bottom", // Horizontal Align left,center,right
                  navigationHOffset: 30,
                  navigationVOffset: 30,
                  soloArrowLeftHalign: "left",
                  soloArrowLeftValign: "center",
                  soloArrowLeftHOffset: 20,
                  soloArrowLeftVOffset: 0,
                  soloArrowRightHalign: "right",
                  soloArrowRightValign: "center",
                  soloArrowRightHOffset: 20,
                  soloArrowRightVOffset: 0,
                  touchenabled: "on", // Enable Swipe Function : on/off


                  stopAtSlide: -1, // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                  stopAfterLoops: -1, // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

                  hideCaptionAtLimit: 0, // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                  hideAllCaptionAtLilmit: 0, // Hide all The Captions if Width of Browser is less then this value
                  hideSliderAtLimit: 0, // Hide the whole slider, and stop also functions if Width of Browser is less than this value


                  fullWidth: "on", // Same time only Enable FullScreen of FullWidth !!
                  fullScreen: "off", // Same time only Enable FullScreen of FullWidth !!


                  shadow: 0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

                });


      });
    </script>






    <!-- WRAP -->
    <div class="wrap cstyle03">

      <div class="container mt-200 z-index100">		
        <div class="row">
          <div class="col-md-4">
            <div class="bs-example bs-example-tabs cstyle04">

              <ul class="nav nav-tabs" id="myTab">
                <li onclick="ChangeSearchBtn('Search');
                    mySelectUpdate()" class="active"><a data-toggle="tab" href="#cabin"><span class="cabin"></span> Cabins</a></li>
                <li onclick="ChangeSearchBtn('Search');
                    mySelectUpdate()" class=""><a data-toggle="tab" href="#yurt"><span class="yurt"></span> Yurts</a></li>
                <li onclick="ChangeSearchBtn('Purchase');
                    mySelectUpdate()" class=""><a data-toggle="tab" href="#vacations"><span class="thrills"></span> Thrillsville Tickets</a></li>
              </ul>

              <div class="tab-content3" id="myTabContent">


                <div id="cabin" class="tab-pane fade  active in">
                  <form action="homePageSearch.php" method="post">
                    <span class="opensans size18">Select A Cabin?</span>

                    <select class="form-control mySelectBoxClass" name="cabin_name" placeholder="Please Select">
                      <option value="0_">Please Select</option>
                      <?php print GetPropertyList(1); ?>
                    </select>

                    <br/>

                    <div class="w50percent">
                      <div class="wh90percent textleft">
                        <span class="opensans size13"><b>Check in date</b></span>
                        <input type="text" class="form-control mySelectCalendar" name="fromdate" id="datepicker" placeholder="mm/dd/yyyy" value="<?= $searchFromDate ?>"/>
                      </div>
                    </div>

                    <div class="w50percentlast">
                      <div class="wh90percent textleft right">
                        <span class="opensans size13"><b>Check in date</b></span>
                        <input type="text" class="form-control mySelectCalendar" name="todate" id="datepicker2" placeholder="mm/dd/yyyy" value="<?= $searchToDate ?>"/>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="room1 margtop15">
                      <div class="w50percent">
                        <div class="wh90percent textleft">
                          <span class="opensans size13"></span><br/>

                          <div class="addroom1 block"><a href="/cabin-rentals/" class="grey">View All Cabins</a></div>
                        </div>
                      </div>

                      <div class="w50percentlast">	
                        <div class="wh90percent textleft right ohidden">
                          <div class="w50percent">
                            <div class="wh90percent textleft left">
                              <span class="opensans size13"><b>Adult</b></span>
                              <select class="form-control mySelectBoxClass" name="adults">
                                <option>1</option>
                                <option selected>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <script>
                                jQuery("[name=adults] option:nth-child(<?= $searchAdults ?>)").attr({selected: "selected"});
                              </script>
                            </div>
                          </div>							
                          <div class="w50percentlast">
                            <div class="wh90percent textleft right ohidden">
                              <span class="opensans size13"><b>Child</b></span>
                              <select class="form-control mySelectBoxClass" name="children">
                                <option>0</option>
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <script>
                                jQuery("[name=children] option:nth-child(<?= ($searchChildren + 1) ?>)").attr({selected: "selected"});
                              </script>
                            </div>
                          </div>
                          <div class="w50percentlast">
                            <div class="wh90percent textleft right ohidden">
                              <span class="opensans size13"><b>Pets</b></span>
                              <select class="form-control mySelectBoxClass" name="pets">
                                <option selected>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <script>
                                jQuery("[name=pets] option:nth-child(<?= ($searchPets + 1) ?>)").attr({selected: "selected"});
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="clearfix"></div>

                    <button type="submit" id="mainSearchBtnc" class="btn-search">Search</button>

                  </form>



                </div>
                <!--End of Cain tab -->
                <!-- START Yurt Tab -->
                <div id="yurt" class="tab-pane fade">
                  <form action="homePageSearch.php" method="post">
                    <span class="opensans size18">Select A Yurt?</span>

                    <select class="form-control mySelectBoxClass" name="yurt_name" placeholder="Please Select">
                      <option value="0_">Please Select</option>
                      <?php print GetPropertyList(2); ?>
                    </select>

                    <br/>

                    <div class="w50percent">
                      <div class="wh90percent textleft">
                        <span class="opensans size13"><b>Check in date</b></span>
                        <input type="text" class="form-control mySelectCalendar" name="fromdate" id="datepicker" placeholder="mm/dd/yyyy"/>
                      </div>
                    </div>

                    <div class="w50percentlast">
                      <div class="wh90percent textleft right">
                        <span class="opensans size13"><b>Check in date</b></span>
                        <input type="text" class="form-control mySelectCalendar" name="todate" id="datepicker2" placeholder="mm/dd/yyyy"/>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="room1 margtop15">
                      <div class="w50percent">
                        <div class="wh90percent textleft">
                          <span class="opensans size13"></span><br/>

                          <div class="addroom1 block"><a href="/yurts/" class="grey">View All Yurts</a></div>
                        </div>
                      </div>

                      <div class="w50percentlast">	
                        <div class="wh90percent textleft right ohidden">
                          <div class="w50percent">
                            <div class="wh90percent textleft left">
                              <span class="opensans size13"><b>Adult</b></span>
                              <select class="form-control mySelectBoxClass" name="adults">
                                <option>1</option>
                                <option selected>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <script>
                                jQuery("[name=adults] option:nth-child(<?= $searchAdults ?>)").attr({selected: "selected"});
                              </script>
                            </div>
                          </div>							
                          <div class="w50percentlast">
                            <div class="wh90percent textleft right ohidden">
                              <span class="opensans size13"><b>Child</b></span>
                              <select class="form-control mySelectBoxClass" name="children">
                                <option>0</option>
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <script>
                                jQuery("[name=children] option:nth-child(<?= ($searchChildren + 1) ?>)").attr({selected: "selected"});
                              </script>
                            </div>
                          </div>
                          <div class="w50percentlast">
                            <div class="wh90percent textleft right ohidden">
                              <span class="opensans size13"><b>Pets</b></span>
                              <select class="form-control mySelectBoxClass" name="pets">
                                <option selected>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                              <script>
                                jQuery("[name=pets] option:nth-child(<?= ($searchPets + 1) ?>)").attr({selected: "selected"});
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="clearfix"></div>

                    <button type="submit" id="mainSearchBtny" class="btn-search">Search</button>


                  </form>



                </div>
                <!-- End Yurt Tab-->

                <!--End of 3rd tab -->

                <div id="vacations" class="tab-pane fade">
                  <form action="homePageSearch.php" method="post">
                    <span class="opensans size18">Purchase Thrillsville Tickets!</span>

                    <div class="w50percent">
                      <div class="wh90percent textleft">
                        <span class="opensans size13"><b>Arrival date</b></span>
                        <input type="text" class="form-control mySelectCalendar" id="datepicker7" name="fromdate" placeholder="mm/dd/yyyy"/>
                      </div>
                    </div>

                    <div class="w50percentlast">
                      <div class="wh90percent textleft right">
                        <span class="opensans size13"><b>Number of Days</b></span>
                        <select class="form-control mySelectBoxClass" name="ticketdays">
                          <option>1</option>
                          <option selected>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="room1 margtop15">
                      <div class="w50percent">
                        <div class="wh90percent textleft">
                          <span class="opensans size13"></span><br/>

                          <div class="addroom1 block"><a href="#"  class="grey">View All Attractions</a></div>
                        </div>
                      </div>

                      <div class="w50percentlast">	
                        <div class="wh90percent textleft right">
                          <div class="w50percent">
                            <div class="wh90percent textleft left">
                              <span class="opensans size13"><b>Adult</b></span>
                              <select class="form-control mySelectBoxClass" name="adults">
                                <option>1</option>
                                <option selected>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                          </div>							
                          <div class="w50percentlast">
                            <div class="wh90percent textleft right">
                              <span class="opensans size13"><b>Child</b></span>
                              <select class="form-control mySelectBoxClass" name="children">
                                <option>0</option>
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="clearfix"></div>

                    <button type="submit" id="mainSearchBtnt" class="btn-search">Search</button>


                  </form>


                </div>
                <!--End of 4th tab -->
              </div>


            </div>
          </div>


          <?php print GetFeaturedProperties(2); ?>
        </div>
      </div>

      <div class="deals3">
        <div class="container">	
          <div class="row">
            <div class="col-md-4">



              <?php print GetSmallFeaturedProperties(3, 2); ?>				
            </div>
            <!-- End of first row-->

            <div class="col-md-4">
              <?php print GetSmallFeaturedProperties(3, 3); ?>						
            </div>	


            <!-- End of second row-->

            <div class="col-md-4">
              <?php print GetSmallFeaturedProperties(3, 4); ?>					
            </div>
            <!-- End of third row-->			
          </div>
        </div>
      </div>

      <div class="lastminute3">
        <div class="container">	
          <?= getSingularDeal(); ?>
        </div>
      </div>	

      <div class="container cstyle06">	

        <div class="row anim2">
          <div class="col-md-3">
            <?= getSectionTitles(1); ?>

          </div>
          <div class="col-md-9">



            <!-- Carousel -->
            <div class="wrapper">
              <div class="list_carousel">
                <ul id="foo">
                  <?php print getAttractions(); ?>
                </ul>
                <div class="clearfix"></div>
                <a id="prev_btn" class="prev" href="#"><img src="images/spacer.png" alt=""/></a>
                <a id="next_btn" class="next" href="#"><img src="images/spacer.png" alt=""/></a>
              </div>
            </div>


          </div>
        </div>	

        <hr class="featurette-divider2">

        <div class="row anim3">
          <div class="col-md-3">
            <?= getSectionTitles(2); ?>

          </div>
          <div class="col-md-9">

            <!-- Carousel -->
            <div class="wrapper">
              <div class="list_carousel">		
                <ul id="foo2">
                  <?php print getAdds(); ?>
                </ul>
                <div class="clearfix"></div>
                <a id="prev_btn2" class="prev" href="#"><img src="images/spacer.png" alt=""/></a>
                <a id="next_btn2" class="next" href="#"><img src="images/spacer.png" alt=""/></a>
              </div>
            </div>

          </div>
        </div>			

      </div>



      <!-- FOOTER -->

      <?php include('includes/footer.php'); ?>





    </div>
    <!-- / WRAP -->


    <!-- Javascript -->

    <!-- This page JS -->
    <script src="assets/js/js-index3.js"></script>	

    <!-- Custom functions -->
    <script src="assets/js/functions.js"></script>

    <!-- Picker UI-->	
    <script src="assets/js/jquery-ui.js"></script>		

    <!-- Easing -->
    <script src="assets/js/jquery.easing.js"></script>

    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Nicescroll  -->	
    <script src="assets/js/jquery.nicescroll.min.js"></script>

    <!-- CarouFredSel -->
    <script src="assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="assets/js/helper-plugins/jquery.transit.min.js"></script>
    <script type="text/javascript" src="assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

    <!-- Custom Select -->
    <script type='text/javascript' src='assets/js/jquery.customSelect.js'></script>	

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
    <script>
      var ajaxSource = "http://<?= $_SERVER['HTTP_HOST'] ?>/";
    </script>
  </body>
</html>
