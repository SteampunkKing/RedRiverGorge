<?php
include('includes/connect/mysql_conn.php');
include('includes/functions.php');
include('includes/loginModule.php');
include('includes/cart.php');
//print print_r($_SERVER, true);
if (isset($_GET['unit']) && $_GET['unit'] != '') {
  $title = str_replace('-', ' ', $_GET['unit']) . ' | ';
  $otherCategory = (strtolower($_GET['category']) == 'cabin-details') ? "cabin-rentals" : $_GET['category'];
  $otherCategory = (stripos($_SERVER['HTTP_REFERER'], 'yurt') !== false) ? "yurts" : $otherCategory;
  $bread_cumbs = '<li>/</li>
					<li><a href="/">Home</a></li>
					<li>/</li>
					<li><a href="/' . $otherCategory . '/">' . ucwords(str_replace('-', ' ', $otherCategory)) . '</a></li>
					<li>/</li>
					<li><a href="/' . $_GET['category'] . '/' . $_GET['unit'] . '/">' . ucwords(str_replace('-', ' ', $_GET['category'] . "<span style='color: #ccc;'> &nbsp; &nbsp; / &nbsp; &nbsp; </span>" . $_GET['unit'])) . '</a></li>';
  $template = 'details.php';
} else {
  $title = ucwords(str_replace('-', ' ', $_GET['category'])) . ' | ';

  $bread_cumbs = '<li>/</li>
					<li><a href="/">Home</a></li>
					<li>/</li>
					<li><a href="/' . $_GET['category'] . '/">' . ucwords(str_replace('-', ' ', $_GET['category'])) . '</a></li>';

  if ($_GET['category'] == 'checkout') {
    $template = 'payment.php';
    $_SESSION['trantype'] = "Customer";
  } else {
    $template = 'listings.php';
  }
  if ($_GET['category'] == 'complete_cart') {
    $template = 'completecart.php';
  }
  if ($_GET['category'] == 'contact') {
    $template = 'contact.php';
  }

  if ($_GET['category'] == 'faq') {
    $template = 'faq.php';
  }
  if ($_GET['category'] == 'terms-and-conditions') {
    $template = 'termsandconditions.php';
  }

  //if ($_GET['category'] == 'search-results') {
  //  $template = 'searchresults.php';
  // }
}
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
    <title><?php echo $title; ?>Red River Gorge Cabin Rentals</title>

    <!-- Bootstrap -->
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/css/custom.css" rel="stylesheet" media="screen">

    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/examples/carousel/carousel.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Fonts -->	
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/css/fontello.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/css/fullscreen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/rs-plugin/css/settings.css" media="screen" />

    <!-- Picker -->	
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/css/jquery-ui.css" />	
    <link href="http://<?= $_SERVER['HTTP_HOST'] ?>/admin/css/select2.css" rel="stylesheet" />

    <!-- bin/jquery.slider.min.css -->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/css/jslider.css" type="text/css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/css/jslider.round.css" type="text/css">	

    <link href='http://<?= $_SERVER['HTTP_HOST'] ?>/css/fullcalendar.css' rel='stylesheet' />



    <!-- jQuery -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/jquery.v2.0.3.js"></script>

    <!-- bin/jquery.slider.min.js -->
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/js/jshashtable-2.1_src.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/js/tmpl.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/js/jquery.dependClass-0.1.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/js/draggable-0.1.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/plugins/jslider/js/jquery.slider.js"></script>
    <!-- end -->
    <script>
      var serverLocation = "<?= $_SERVER['HTTP_HOST'] ?>";
    </script>


    <style>
      #calendar {
        width: 90%;
        margin: 0 auto;
      }

      .fc-content{
        text-align:center;	
      }
    </style>
  </head>
  <body id="top" class="thebg" >

    <?php include('includes/header.php'); ?>




    <div class="container breadcrub">
      <div>
        <a class="homebtn left" href="/"></a>
        <div class="left">
          <ul class="bcrumbs">
            <?php echo $bread_cumbs; ?>			
          </ul>				
        </div>
        <a class="backbtn right" href="#"></a>
      </div>
      <div class="clearfix"></div>
      <div class="brlines"></div>
    </div>	

    <!-- CONTENT -->
    <div class="container">
      <div class="container pagecontainer offset-0">	

        <!-- FILTERS -->


        <?php include('templates/' . $template); ?>


      </div>
      <!-- END OF CONTENT -->


      <!-- FOOTER -->
      <?php include('includes/footer.php'); ?>
    </div>




    <!-- Javascript -->	


    <!-- Custom Select -->
    <script type='text/javascript' src='http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/jquery.customSelect.js'></script>

    <!-- Custom Select -->
    <script type='text/javascript' src='http://<?= $_SERVER['HTTP_HOST'] ?>/js/lightbox.js'></script>	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/admin/js/select2.min.js"></script>
    <!-- JS Ease -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/jquery.easing.js"></script>

    <!-- Custom functions -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/functions.js"></script>

    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Counter -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/counter.js"></script>	

    <!-- Nicescroll  -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/jquery.nicescroll.min.js"></script>

    <!-- Picker -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/jquery-ui.js"></script>

    <!-- Bootstrap -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/functions/ajax/ajax.js"></script>


    <!-- Googlemap -->	

    <?php
    //print print_R($propInfo,true);
    if ($propInfo['latitude'] == '' || $propInfo['longitude'] == '') {
      $propInfo['latitude'] = '37.76785';
      $propInfo['longitude'] = '-83.60880';
    }
    ?>
    <script>
    function initialize() {
      // Create an array of styles.
      var styles = [
        {
          featureType: 'road.highway',
          elementType: 'all',
          stylers: [
            {hue: '#e5e5e5'},
            {saturation: -100},
            {lightness: 72},
            {visibility: 'simplified'}
          ]
        }, {
          featureType: 'water',
          elementType: 'all',
          stylers: [
            {hue: '#30a5dc'},
            {saturation: 47},
            {lightness: -31},
            {visibility: 'simplified'}
          ]
        }, {
          featureType: 'road',
          elementType: 'all',
          stylers: [
            {hue: '#cccccc'},
            {saturation: -100},
            {lightness: 44},
            {visibility: 'on'}
          ]
        }, {
          featureType: 'landscape',
          elementType: 'all',
          stylers: [
            {hue: '#ffffff'},
            {saturation: -100},
            {lightness: 100},
            {visibility: 'on'}
          ]
        }, {
          featureType: 'poi.park',
          elementType: 'all',
          stylers: [
            {hue: '#d2df9f'},
            {saturation: 12},
            {lightness: -4},
            {visibility: 'on'}
          ]
        }, {
          featureType: 'road.arterial',
          elementType: 'all',
          stylers: [
            {hue: '#e5e5e5'},
            {saturation: -100},
            {lightness: 56},
            {visibility: 'on'}
          ]
        }, {
          featureType: 'administrative.locality',
          elementType: 'all',
          stylers: [
            {hue: '#000000'},
            {saturation: 0},
            {lightness: 0},
            {visibility: 'on'}
          ]
        }
      ];


      var myLatlng = new google.maps.LatLng(<?php echo $propInfo['latitude']; ?>, <?php echo $propInfo['longitude']; ?>);


      // Create a new StyledMapType object, passing it the array of styles,
      // as well as the name to be displayed on the map type control.
      var styledMap = new google.maps.StyledMapType(styles,
              {name: "Styled Map"});


      // Create a map object, and include the MapTypeId to add
      // to the map type control.
      var mapOptions = {
        zoom: 15,
        center: myLatlng,
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
      };

      var map = new google.maps.Map(document.getElementById('map-canvas'),
              mapOptions);

      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: "<?= $propInfo['propName'] ?>"
      });


      //Associate the styled map with the MapTypeId and set it to display.
      map.mapTypes.set('map_style', styledMap);
      map.setMapTypeId('map_style');
    }


    function loadScript() {
      setTimeout(function () {
        $('#map-canvas').css({'display': 'block'});
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
                'callback=initialize';
        document.body.appendChild(script);

        google.maps.event.trigger(map, 'resize');
      }, 500);
    }




    </script>
    <?php
    //}
    ?>
    <!-- Custom functions -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/functions.js"></script>

    <!-- CarouFredSel -->
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>

    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/helper-plugins/jquery.transit.min.js"></script>
    <script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

    <!-- Counter -->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/counter.js"></script>	

    <!-- Carousel-->	
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/js/initialize-carousel-detailspage.js"></script>		
    <script>

    </script>
    <script>
      function goToProperty(id, propType) {

        window.location = '/cabin-details/' + id + '/';
      }

      var dateToday = new Date();

      $('#datepickerArrive').datepicker({
        minDate: dateToday
      });
      $('#datepickerDepart').datepicker({
        minDate: dateToday
      });

      function searchThisProperty(id) {
        if (jQuery('#datepickerArrive').val().length == 0) {
          setTimeout(function() {jQuery('#datepickerArrive').focus();},400);
          return false;
        }
        if (jQuery('#datepickerDepart').val().length == 0) {
          setTimeout(function() {jQuery('#datepickerDepart').focus();},400);
          return false;
        }
        //alert(id);
        //alert("_"+$('#datepickerArrive').val()+"_");	
        //alert($('#datepickerDepart').val());	
        ajax('searchResults', 'http://<?= $_SERVER['HTTP_HOST'] ?>/actions/checkCabinPriceAvailability.php?propName=' + id + '&arrive=' + $('#datepickerArrive').val() + '&depart=' + $('#datepickerDepart').val());
      }

      function ShowModal() {
        alert('Here');
      }

      function goToCart() {
        window.location = '/checkout/'
      }

      function logMeOut() {
        window.location = '/logout.php'
      }

      function reloadPage() {
        if ($('#validation').val() == '1')
        {
          location.reload();
        }
      }


    </script>

    <script src='http://<?= $_SERVER['HTTP_HOST'] ?>/js/moment.min.js'></script>
    <script src='http://<?= $_SERVER['HTTP_HOST'] ?>/js/fullcalendar.min.js'></script>
    <script>

      $(document).ready(function () {



        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
          },
          defaultDate: '<?= date('Y-m-d'); ?>',
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          eventSources: [
            //a full blown EventSource-Object with custom coloring
            {
              events: [
<?php echo getBookedPropertyDates($_GET['unit']); ?>
              ],
              backgroundColor: 'red',
              borderColor: 'red',
              textColor: 'white'
            },
            //a normal events-array with the default colors used
            [
<?php echo getPropertyRates($_GET['unit']); ?>
            ]
          ]});

        /*
         $( ".fc-day" ).bind( "click", function() {
         
         var first = $('.selecteddate:first').attr('data-date');	
         alert(first);
         var first = $('.selecteddate:first').attr('data-date');	
         alert(last);	
         
         var arr = [];		
         var clickedDate = $(this).attr('data-date');
         
         
         $('.booked').each(function(i, obj) {
         arr.push($(this).val());
         });
         
         var isavailable = $.inArray(clickedDate, arr);
         if(isavailable == '-1'){
         $(this).addClass('selecteddate');
         $(this).css('background', '#cccccc');
         }
         
         });
         */
      });


    </script>
    <input type="hidden" name="used[]" value="2015-05-10" class="booked">
    <input type="hidden" name="used[]" value="2015-05-25" class="booked">
  </body>
</html>
