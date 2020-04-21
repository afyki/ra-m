<?php
// MySQLへ接続
$link = mysqli_connect("localhost", "root", "", "ramen");
if (!$link) {
  die("接続失敗" . mysql_error());
}
// 文字化け防止
mysqli_set_charset($link, "utf8");
// SELECT文の発行
$cate = "";
if(isset($_POST['search']) && $_POST['category']!==''){
  $cate = $_POST['category'];
  $result = mysqli_query($link, "SELECT * FROM ramen WHERE category = '$cate' ORDER BY id DESC");
}else{
  $result = mysqli_query($link, "SELECT * FROM ramen ORDER BY id DESC");
}

if (!$result) {
  die("クエリーが失敗" . mysql_error());
}
$ramen_array = [];
// データの取得及び取得データの表示
while ($row = mysqli_fetch_assoc($result)) {
  $ramen_items = [];
  $ramen_items["title"] = $row["title"];
  $ramen_items["category"] = $row["category"];
  $ramen_items["image"] = $row["image_url"];
  $ramen_items["star"] = $row["star"];
  $ramen_items["menu"] = $row["menu"];
  $ramen_items["comment"] = $row["comment"];
  $ramen_items["datetime"] = $row["datetime"];
  $ramen_array[] = $ramen_items;
}
// MySQLの切断
$close = mysqli_close($link);
if ($close){
  // echo __DIR__;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8"/>
  <title>就プレ</title>
  <!-- drawer.css -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/index.css">
  <!-- jquery & iScroll -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
  <script type="text/javascript" src="/iine/cn/cn.php"></script>
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script src="js/ajaxzip3.js" charset="utf-8"></script>

  <!-- 画像アップロード -->
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
    <a class="drawer-brand" href="#"><img src="images/logo.png" height="50" width="" alt=""></a>
  </header>


  <ul class="bottom-menu">
    <li>
      <!--　↓↓項目1. ホーム 　＃の部分にホームのURLを入れる -->
      <a href="#">
        <i class="blogicon-home"></i><br><span class="mini-text">ホーム</span></a>
      </li>

      <li class="menu-width-max">
        <!-- ↓↓項目2. おすすめ　すぐ下の"＃"はそのまま -->
        <a href="#"><i class="blogicon-list"></i><br><span class="mini-text">おすすめ</span></a>

        <ul class="menu-second-level">
          <!-- 下の"#"の部分におすすめ"記事URL"とタイトル等を入れる -->
          <li><a href="#">タイトル１</a></li>
          <li><a href="#">タイトル２</a></li>
          <li><a href="#">タイトル３</a></li>
          <li><a href="#">タイトル４</a></li>
          <li><a href="#">タイトル５</a></li>
        </ul>
      </li>
      <li>
        <!-- ↓↓項目3.　読者登録 ↓↓の部分の書き換えが必要です -->
        <!--  ~hatena.ne.jp/自分のはてなID/URL(http://の部分は無し)/subscribe　-->
        <a href="https://blog.hatena.ne.jp/はてなID/自分のURL/subscribe" target="_blank">
          <i class="blogicon-hatenablog"></i><br><span class="mini-text">読者登録</span></a>
        </li>
        <li>
          <!-- ↓↓項目4.　ツイッター ↓↓の部分の書き換えが必要です-->
          <!-- screen_name=自分のツイッターID" ←＠マーク以降のIDを入れる -->
          <a href="https://twitter.com/intent/follow?screen_name=自分のツイッターID">
            <i class="blogicon-twitter"></i><br><span class="mini-text">Follow</span></a>
          </li>
        </ul>

        <div class="container">
          <div class="bg">
            <div id="map"></div>
          </div>
          <div class="contents">
            <div id="map"></div>
          </div>
        </div>

        <div class="shop">
          <a href="./search.php">店舗情報を見る</a>
        </div>

        <form id="main" method="post" action="./index.php">
          <!-- <img id="mo" src="./images/mo.jpg"> -->
          <!-- <div id="mo">
        </div> -->

        <h2 id="ca" >カテゴリで絞り込む</h2>
        <div id="category" class="ccc">

          <input id="a" class="category" type="radio" name="category" value="こってり" />
          <label for="a"><img src="./images/S__22962265.jpg"><p>こってり</p></label>

          <input id="b" class="category" type="radio" name="category" value="あっさり" />
          <label for="b"><img src="./images/S__22962257.jpg"><p>あっさり</p></label>

          <input id="c" class="category" type="radio" name="category" value="白湯" />
          <label for="c"><img src="./images/S__22962227.jpg"><p>白湯</p></label>

          <input id="d" class="category" type="radio" name="category" value="魚介" />
          <label for="d"><img src="./images/S__22962208.jpg"><p>魚介</p></label>

          <input id="e" class="category" type="radio" name="category" value="煮干し" />
          <label for="e"><img src="./images/S__22962236.jpg"><p>煮干し</p></label>

          <input id="f" class="category" type="radio" name="category" value="塩" />
          <label for="f"><img src="./images/S__22962255.jpg"><p>塩</p></label>

          <input id="g" class="category" type="radio" name="category" value="醤油" />
          <label for="g"><img src="./images/S__22962260.jpg"><p>醤油</p></label>

          <input id="h" class="category" type="radio" name="category" value="味噌" />
          <label for="h"><img src="./images/S__22962261.jpg"><p>味噌</p></label>

          <input id="i" class="category" type="radio" name="category" value="豚骨" />
          <label for="i"><img src="./images/S__22962254.jpg"><p>豚骨</p></label>

          <input id="j" class="category" type="radio" name="category" value="まぜそば" />
          <label for="j"><img src="./images/S__22962240.jpg"><p>まぜそば</p></label>

          <input id="k" class="category" type="radio" name="category" value="つけ麺" />
          <label for="k"><img src="./images/S__22962225.jpg"><p>つけ麺</p></label>

        </div>

        <h2 id="Area" >エリアで絞り込む</h2>
        <div id="area" class="ccc">

          <input id="tokyo" class="category" type="radio" name="category" value="こってり" />
          <label for="tokyo"><img src="./images/tokyou.jpeg"><p>東京</p></label>

          <input id="osaka" class="category" type="radio" name="category" value="あっさり" />
          <label for="osaka"><img src="./images/osaka.jpg"><p>大阪</p></label>

          <input id="kanagawa" class="category" type="radio" name="category" value="白湯" />
          <label for="kanagawa"><img src="./images/kanagawa.jpg"><p>神奈川</p></label>

          <input id="kyoto" class="category" type="radio" name="category" value="魚介" />
          <label for="kyoto"><img src="./images/kyoto.jpg"><p>京都</p></label>

          <input id="aichi" class="category" type="radio" name="category" value="煮干し" />
          <label for="aichi"><img src="./images/aichi.jpg"><p>愛知</p></label>

          <input id="hukuoka" class="category" type="radio" name="category" value="塩" />
          <label for="hukuoka"><img src="./images/hukuoka.jpg"><p>福岡</p></label>

        </div>
        <input id="search" type="submit" name='search' value="検索">
      </form>

      <main id="mainsp" role="main">
        <?php foreach ($ramen_array as $key => $value) { ?>
          <div class="pos">
            <div class="wrap">
              <h2>ra</h2>
              <h3>ramen</h3>
            </div>
            <article>
              <section>
                <div id=sam ><img src="<?php echo $value['image']; ?>" height="" width="" alt=""></div>
              </section>
              <h3><?php echo $value['title']; ?></h3>
              <div id="star"><h3>
                <?php if($value['star'] == 1){
                  echo "★☆☆☆☆"; ?>
                  <p><?php echo $value['star']; ?></p>
                <?php }elseif($value['star'] == 2){
                  echo "★★☆☆☆"; ?>
                  <p><?php echo $value['star']; ?></p>
                <?php }elseif($value['star'] == 3){
                  echo "★★★☆☆"; ?>
                  <p><?php echo $value['star']; ?></p>
                <?php }elseif($value['star'] == 4){
                  echo "★★★★☆"; ?>
                  <p><?php echo $value['star']; ?></p>
                <?php }elseif($value['star'] == 5){
                  echo "★★★★★"; ?>
                  <p><?php echo $value['star']; ?></p>
                <?php } ?>
              </h3></div>
              <div id="iine">
                <div class="ajax-iine" data-pid="d8xcw083ck203xdaqrrm" data-tid="tpl-sb-heart-l"></div>
              </div>
              <div id="menu0">
                <p><?php echo $value['menu']; ?></p>
              </div>
              <p><?php $comment = $value['comment'];
              $comment = nl2br($comment);
              echo $comment;
              ?></p>
              <div id="date">
                <p><?php echo $value['datetime']; ?></p>
              </div>
            </article>
          </div>
        <?php } ?>
      </main>

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
      var latlng = new google.maps.LatLng(34.699875, 135.493032);//初期値
      var opts = {
        zoom: 16,
        center: latlng,
        mapTypeControl: false,
        fullscreenControl: false,
        streetViewControl: false,
        zoomControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      map = new google.maps.Map(document.getElementById('map'),opts);
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
          // function rest(la){
          $('#output2').empty();
          var searchU = "https://api.gnavi.co.jp/RestSearchAPI/v3/?keyid=67e362143728e7d487271e6baec19742&freeword=ラーメン&hit_per_page=100&latitude=34.699875&longitude=135.493032&range=5";
          search = searchU;
          $.ajax({
            url: './php/wa-31-02-99.php',
            data: {
              url: search
            },
            type: 'GET',
            dataType: 'json',
            success: function (data) {
              var count = 0;
              console.log("rest");
              console.log(data["rest"]);
              $.each(data["rest"][0],function () {
                Name = $(this).find('name').text();
                logo = $(this).find('logo_image').text();
                ca = $(this).find('catch').text();
                Address = data["rest"][count]["address"];
                pinAction(Address);
                $('#output2').append(
                  '<div id="inn2">' +
                  '<h2>' + Name + '</h2>' +
                  '<img src="' + logo + '" alt="外観">' +
                  '<p>' + ca + '</p>' +
                  '<p>' + Address + '</p>' +
                  '</div>'
                );
                count++;
              })//find
              console.log("count");
              console.log(count);
            },//success
            error: function (XMLHttpRequest) {
              $('#output2').empty();
              console.log("error");
            }//error
          })//ajax
        });//function
      });
    }//initMap
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtYEhi52i3D0MyvkYGHic84OhCgNAUHEU&callback=initMap" async defer></script>

</body>
</html>
