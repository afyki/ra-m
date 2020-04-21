<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8"/>
  <title>週プレ</title>
  <link rel="stylesheet" type="text/css" href="./css/form.css">
  <!-- drawer.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
  <!-- jquery & iScroll -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
  <!-- drawer.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
  <script>
  $(document).ready(function() {
    $('.drawer').drawer();
  });
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

</head>
<body class="drawer drawer--top drawer--navbarTopGutter">
  <header class="drawer-navbar drawer-navbar--fixed" role="banner">
    <div class="drawer-container">
      <div class="drawer-navbar-header">
        <a class="drawer-brand" href="index.php"><img src="images/logo.png" height="50" width="" alt=""></a>
        <button type="button" class="drawer-toggle drawer-hamburger">
          <span class="sr-only">toggle navigation</span>
          <span class="drawer-hamburger-icon"></span>
        </button>
      </div>
      <nav class="drawer-nav" role="navigation">
        <ul class="drawer-menu ">
          <li><a class="drawer-menu-item" href="index.php">TOP</a></li>
          <li><a class="drawer-menu-item" href="#">Nav2</a></li>
          <li><a class="drawer-menu-item" href="#">Nav3</a></li>
          <li><a class="drawer-menu-item" href="#">Nav4</a></li>
          <li><a class="drawer-menu-item" href="#">Nav5</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div id="back">
    <div class="f_pos">
      <div class="f_wrap">
        <h2><img src="./images/S__22962187.jpg" width="130px;" alt=""></h2>
        <h3>ramen</h3>
      </div>
    </div>
    <!-- <form method="post" action="bbs.php"> -->
    <form action="submit.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" value="write">
      <!-- 評価★ -->
      <div class="evaluation">
        <input id="star1" type="radio" name="star" value="5.0" />
        <label for="star1"><span class="text">最高</span>★</label>
        <input id="star2" type="radio" name="star" value="4.0" />
        <label for="star2"><span class="text">良い</span>★</label>
        <input id="star3" type="radio" name="star" value="3.0" />
        <label for="star3"><span class="text">普通</span>★</label>
        <input id="star4" type="radio" name="star" value="2.0" />
        <label for="star4"><span class="text">悪い</span>★</label>
        <input id="star5" type="radio" name="star" value="1.0" />
        <label for="star5"><span class="text">最悪</span>★</label>
      </div>
      <input id="title" type="text" name="title" size="20" placeholder="タイトル"><br>
      <select id="category" name="category">
        <option value="--">--</option>
        <option value="こってり">こってり</option>
        <option value="あっさり">あっさり</option>
        <option value="白湯">白湯</option>
        <option value="魚介">魚介</option>
        <option value="煮干し">煮干し</option>
        <option value="塩">塩</option>
        <option value="醤油">醤油</option>
        <option value="豚骨">豚骨</option>
        <option value="まぜそば">まぜそば</option>
        <option value="つけ麺">つけ麺</option>
      </select>
      <input id="menu" type="text" name="menu" size="20" placeholder="料理名を入力してください"><br>
      <textarea name="comment" rows="10" cols="80" placeholder="内容を入力してください"></textarea><br>
      <div id="fileimg">
        <div id="btn"><img src="./images/a.png" width="130px;" alt=""></div>
        <input id="file" type="file" name="upfile">
        <input type="text" id="filename" placeholder="選択されていません" readonly />
      </div><br>

      <!-- <div class="star-rating">
      <div class="star-rating-front" style="width: 20%">★★★★★</div>
      <div class="star-rating-back">★★★★★</div>
    </div> -->

    <input type="submit" id="button" value="　投稿する　">
  </form>
</div>

</body>
</html>
