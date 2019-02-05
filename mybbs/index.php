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
      <th>投稿者</th>
      <th>投稿日時</th>
      <th>本文</th>
    </tr>
    
    <?php foreach($rows as $row){
	?> 
    <tr>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["time"]; ?></td>
      <td><?php echo $row["text"]; ?></td>
    </tr>
    <?php 
	} 
	?>
  </table>
  <form method="POST" action="post_finish.php">
<label>名前：</label>
<input type="text" name="onamae" /><br />
<label>コメント：</label>
<input type="text" name="comment" />
<input type="submit" value="投稿する" />
</form>
</body>
</html>

