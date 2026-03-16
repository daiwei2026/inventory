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

		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die('连接失败: ' . $conn->connect_error);
		}
		if (!$_GET["category"]) {
			$sql = "SELECT * FROM category LIMIT 1;";
			$result = $conn->query($sql);
			$category = $result->fetch_row()[0];
		} else {
			$category = $_GET["category"];
		}

		if ($_GET["current"])
			$start = ($_GET["current"] - 1) * 10;
		else $start = 0;
		$sql = 'SELECT * FROM goods WHERE category=' . $category . ' LIMIT ' . $start . ', 10';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// 输出数据
			while ($row = $result->fetch_assoc()) {
				echo "<a href='detail.php?id=" . $row["id"] . "' class='show'><img src='" . $row["image"] . "'><span class='goods'>商品名：" . $row["name"] . "</span><span class='price'>单价：￥" . $row["price"] . "</span><span class='store'>库存：" . $row["store"] . "</span></a>";
			}
		} else {
			echo "0 结果";
		}
		echo "<a class='link' href='newGoods.php?category=" . $category . "'>newGoods</a>";

		?>
	</div>
	<div id="nav">
		<?php
		$servername = 'localhost';
		$username = 'root';
		$password = '@Passw0rd';
		$dbname = 'inventory';
		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die('连接失败: ' . $conn->connect_error);
		}
		if (!$_GET["category"]) {
			$sql = "SELECT * FROM category LIMIT 1;";
			$result = $conn->query($sql);
			$category = $result->fetch_row()[0];
		} else {
			$category = $_GET["category"];
		}
		$sql = 'SELECT count(*) FROM goods WHERE category=' . $category;
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		if ($row[0] == 0)
			$pages = 0;
		else if ($row[0] % 10 == 0)
			$pages = $row[0] / 10;
		else
			$pages = (int)($row[0] / 10 + 1);
		if ($_GET["current"])
			$current = $_GET["current"];
		else $current = 1;
		if ($current > 1)
			echo "<a href='index-1.php?category=" . $category . "&current=" . $current - 1 . "'>&lt;preview</a>";
		for ($i = 1; $i <= $pages; $i++) {
			if ($i == $current)
				echo "<a href='javascript:void(0);' style='color:gray;'>" . $i . "</a>";
			else
				echo "<a href='index-1.php?category=" . $category . "&current=" . $i . "'>" . $i . "</a>";
		}
		if ($current < $pages)
			echo "<a href='index-1.php?category=" . $category . "&current=" . $current + 1 . "'>next&gt;</a>";
		?>
	</div>
</body>

</html>
