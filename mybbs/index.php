<?php
    // mysqliクラスのオブジェクトを作成
$mysqli = new mysqli('157.112.147.201', 'ppftech_user3', 'user1234', 'ppftech_db3');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

// 完成済みのSELECT文を実行する
$sql = "SELECT id, name, time, text FROM customer";

if(isset($_GET['page'])){
	$offset = (intval($_GET['page']) - 1) * 5;
	$sql .= " LIMIT 5 OFFSET ".$offset;
}

if ($result = $mysqli->query($sql)) {
    // 連想配列を取得
    while ($row = $result->fetch_assoc()) {
       $rows[] = $row;
    }
  
  // 結果セットを閉じる
    $result->close();
}

// DB接続を閉じる
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>My BBS</title>
</head>
<body>
 <table border="1">
    <tr>
      <th>No.</th>
      <th>投稿者</th>
      <th>投稿日時</th>
      <th>本文</th>
    </tr>
    
<?php
	$no = 1;
	if(isset($_GET['page'])){
		$no += (intval($_GET['page']) - 1) * 5;
	}
	foreach($rows as $row){
?> 
		<tr>
	      <td><?php echo $no; ?></td>
	      <td><?php echo $row["name"]; ?></td>
	      <td><?php echo $row["time"]; ?></td>
	      <td><?php echo $row["text"]; ?></td>
	    </tr>
<?php
		$no++;
	}
?>
  </table>
  <br />
  <a href="index.php">全表示</a>　<a href="index.php?page=1">1ページ目(最初の5件)</a>　<a href="index.php?page=2">2ページ目(次の5件)</a> <a href="index.php?page=3">3ページ目(次の5件)</a> <a href="index.php?page=4">4ページ目(次の5件)</a>
  <br /><br />
  <form method="POST" action="post_finish.php">
	  <label>名前：</label>
	  <input type="text" name="onamae" /><br />
	  <label>コメント：</label>
	  <input type="text" name="comment" />
	  <input type="submit" value="投稿する" />
  </form>
</body>
</html>

