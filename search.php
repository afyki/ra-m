<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8"/>
  <title>就プレ</title>

  <!-- drawer.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
  <!-- jquery & iScroll -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
  <!-- drawer.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>

  <script type="text/javascript" src="/iine/cn/cn.php"></script>

  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/design3.css">

  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script src="js/ajaxzip3.js" charset="utf-8">
  </script>

  <script type="text/javascript">
  $(function() {
    $('#file').css({
      'position': 'absolute',
      'top': '-9999px'
    }).change(function() {
      var val = $(this).val();
      var path = val.replace(/\\/g, '/');
      var match = path.lastIndexOf('/');
      $('#filename').css("display","inline-block");
      $('#filename').val(match !== -1 ? val.substring(match + 1) : val);
    });
    $('#filename').bind('keyup, keydown, keypress', function() {
      return false;
    });
    $('#filename, #btn').click(function() {
      $('#file').trigger('click');
    });
  });
</script>

<!-- 奥行スクロール -->
<script type="text/javascript">
$(function() {
  var isRunning = false,
  optimizedCallback = function() {
    changePerspective();
  };
  window.addEventListener("scroll", function() {
    if(!isRunning) {
      isRunning = true;
      window.requestAnimationFrame(function() {
        isRunning = false;
        optimizedCallback();
      });
    }
  });
  window.addEventListener("touchmove", function() {
    if(!isRunning) {
      isRunning = true;
      window.requestAnimationFrame(function() {
        isRunning = false;
        optimizedCallback();
      });
    }
  });
  var changePerspective = function() {
    $(".container").css({
      "-ms-perspective-origin": "0% " + (window.scrollY / document.body.clientHeight * 1000) + "%",
      "perspective-origin": "0% " + (window.scrollY / document.body.clientHeight * 1000) + "%"
    });
  }
  optimizedCallback();
});
</script>

</head>

<body class="drawer drawer--top drawer--navbarTopGutter">
  <header class="drawer-navbar drawer-navbar--fixed" role="banner">
    <div class="drawer-container">
      <div class="drawer-navbar-header">
        <a class="drawer-brand" href="#"><img src="images/logo.png" height="50" width="" alt=""></a>
        <button type="button" class="drawer-toggle drawer-hamburger">
          <span class="sr-only">toggle navigation</span>
          <span class="drawer-hamburger-icon"></span>
        </button>
      </div>
      <nav class="drawer-nav" role="navigation">
        <ul class="drawer-menu ">
          <li><a class="drawer-menu-item" href="#">TOP</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="container">
    <div class="bg">
      <div id="s_map"></div>
    </div>
    <div class="contents">
      <div id="s_map"></div>
    </div>
  </div>


  <div id="s_main"></div>

  <script type="text/javascript">
  var map;
  var markers = [];
  var infoWindows;

  function pinAction(location) {
    var address0 = location;
    geocoder = new google.maps.Geocoder();//ジオコーディング
    geocoder.geocode({'address': address0},//初期値
    function(result,status){
      if(status == google.maps.GeocoderStatus.OK){
        console.log(result[0]);
        console.log(status);
        var latlng = result[0].geometry.location;
        var marker = new google.maps.Marker({//マーカー
          map : map,
          icon: new google.maps.MarkerImage(
            './images/icon.png',//マーカー画像URL
          ),
          position : latlng
        });
        var infoWindow = new google.maps.InfoWindow({//infoWindow表示
          content: address0
        });
        marker.addListener('click', function() {
          if(infoWindows){
            infoWindows.close();
          }
          infoWindow.open(map, marker);
          infoWindows = infoWindow;
        });//addListener
        markers.push(marker);
      }else{
        // alert(status);
      };//else
    }//function(result,status)
  );//geocode
}

function initMap(){
  // var latlng = new google.maps.LatLng(34.699875, 135.493032);//初期値
  var latlng = new google.maps.LatLng(35.691655, 139.696937);//初期値
  var opts = {
    zoom: 16,
    center: latlng,
    mapTypeControl: false,
    fullscreenControl: false,
    streetViewControl: false,
    zoomControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById('s_map'),opts);

  var address0 = "";
  geocoder = new google.maps.Geocoder();//ジオコーディング

  $(function () {
    var areaUrl = "http://jws.jalan.net/APICommon/AreaSearch/V1/?key=sgr16b2f98547d";
    var area = areaUrl;
    var ParamText;
    var PTRegion;
    var PTPref;
    var PTLarge;
    var PTSmall;


    $(function () {
      $('#s_main').empty();
      var searchU = "http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=f56e581185071952&genre=G013&lat=35.691655&lng=139.696937&range=5";
      search = searchU;
      console.log(search);
      $.ajax({
        url: './php/wa-31-02-99.php',
        data: {
          url: search
        },
        type: 'GET',
        dataType: 'xml',
        success: function (data) {
          console.log(data);
          var count = 0;
          $(data).find('shop').each(function () {
            Name = $(this).find('name').text();
            logo = $(this).find('logo_image').text();
            ca = $(this).find('catch').text();
            urls = $(this).find('pc').text();
            Address = $(this).find('address').text();

            console.log(urls);
            pinAction(Address);
            $('#s_main').append(
              '<div class="s_rest">' +
              '<h2>' + Name + '</h2>' +
              '<img src="' + logo + '" alt="外観">' +
              '<p>' + ca + '</p>' +
              '<p>' + Address + '</p>' +
              '<p id="p_urls">詳細</p>' +
              '<a href="'+ urls +'"></a>' +
              '</div>'
            );
          })//find
        },//success
        error: function (XMLHttpRequest) {
          $('#s_main').empty();
          console.log("a");
        }//error
      })//ajax
    });




  });
}//initMap

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtYEhi52i3D0MyvkYGHic84OhCgNAUHEU&callback=initMap" async defer></script>

</body>
</html>
