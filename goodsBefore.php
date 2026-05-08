<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
	<div id="left">
		<?php
		require "common.php";
		?>
	</div>
	<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '@Passw0rd';
	$dbname = 'inventory';
	$id = $_GET["id"];

	// 创建连接
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die('连接失败: ' . $conn->connect_error);
	}

	$sql = 'SELECT * FROM goods WHERE id=' . $id;
	$result = $conn->query($sql);
	$row = $result->fetch_row();
	?>
	<div id="right">
		<form action="modifyGoods.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id; ?>"><br>
			商品分类：<input type="text" name="category" value="<?php echo $row[1]; ?>"><br>
			商品名：<input type="text" name="name" value="<?php echo $row[2]; ?>"><br>
			商品单价：<input type="text" name="price" value="<?php echo $row[3]; ?>"><br>
			库存：<input type="text" name="store" value="<?php echo $row[4]; ?>"><br>
			售出：<input type="text" name="sell" value="<?php echo $row[5]; ?>"><br>
			商品图片：<input type="file" name="image"><br>
			<input type="submit"><br>
			<input type="reset">
		</form>
	</div>
</body>

</html>