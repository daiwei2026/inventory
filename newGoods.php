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
		<form action="createGoods.php" method="post" enctype="multipart/form-data">
		  	<input type="hidden" name="category" value="<?php echo $_GET['category']; ?>"><br>
			商品名：<input type="text" name="name"><br>
			商品单价：<input type="text" name="price"><br>
			库存：<input type="text" name="store"><br>
			已卖出：<input type="text" name="sell"><br>
			商品图片：<input type="file" name="image"><br>
			<input type="submit"><br>
			<input type="reset">
		</form>
	</div>
</body>

</html>
