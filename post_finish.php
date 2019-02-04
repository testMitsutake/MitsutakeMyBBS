<?php 
$dsn = 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=ppftech_db3;charset=utf8';

$user = 'ppftech_user3';

$password = 'user1234';

$dbh = null;

try {
	$dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
  echo 'データベースにアクセスできません！' . $e->getMessage();
}

if(isset($_POST['onamae'])){
	$onamae = $_POST['onamae'];
}
if(isset($_POST['comment'])){
	$comment = $_POST['comment'];
}
$sql = "INSERT INTO customer(name,text) VALUES (:name,:text)";
 
$stmt = $dbh->prepare($sql);
 
$params = array(':name' => $onamae, ':text' => $comment);
 
$stmt->execute($params);

$dbh = null;
?>

<!DOCTYPE html>
<html>
<head>
<title>投稿完了</title>
</head>
<body>
<label>投稿完了しました！</label>

<input type="button" value="トップへ" onClick="document.location='index.php';">
</body>
</html>
