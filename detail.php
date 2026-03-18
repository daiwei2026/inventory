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
	<div id="right">
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
		// 输出数据
		echo "<img src='$row[6]' width='100%'><p>商品名：$row[2]</p><p>价格：$row[3]</p><p>库存：$row[4]</p><p>已卖出：$row[5]</p></a><a href=goodsBefore.php?id=" . $row[0] . ">modify</a><a href=delete.php?id=" . $row[0] . ">delete</a><a href=addShopCart.php?id=" . $row[0] . ">添加到购物车</a><br>";
		if (!$_GET["category"]) {
			$sql = "SELECT * FROM category LIMIT 1;";
			$result = $conn->query($sql);
			$category = $result->fetch_row()[0];
		} else {
			$category = $_GET["category"];
		}
		$sql = 'SELECT * FROM goods WHERE category=' . $category . ' AND id < ' . $id . ' ORDER BY id DESC LIMIT 1';
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		if ($row)
			echo "<a href='detail.php?id=" . $row[0] . "'>previews</a>";
		$sql = 'SELECT * FROM goods WHERE category=' . $category . ' AND id > ' . $id . ' ORDER BY id ASC LIMIT 1';
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		if ($row)
			echo "<a href='detail.php?id=" . $row[0] . "'>next</a>";
		?>
	</div>
</body>

</html>
