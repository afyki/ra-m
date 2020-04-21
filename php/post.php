<?php
header("Content-type: application/xml: charset=UTF8");
$cate = $_POST['cate'];
var_dump($cate);
// SQL文

$result = mysqli_query($link, "SELECT title, category, image_url, ster, menu, comment, datetime FROM ramen WHERE category ='$cate' ORDER BY id DESC");

// 結果を格納する配列
$items = [];

// SELECT文で取ってきた結果を$itemsへ格納する
while($row = mysqli_fetch_assoc($result)) {
  $ramen_items = [];
  $ramen_items["title"] = $row["title"];
  $ramen_items["category"] = $row["category"];
  $ramen_items["image"] = $row["image_url"];
  $ramen_items["star"] = $row["star"];
  $ramen_items["menu"] = $row["menu"];
  $ramen_items["comment"] = $row["comment"];
  $ramen_items["datetime"] = $row["datetime"];
  $items[] = $ramen_items;
}

print $items;
?>
