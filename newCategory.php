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
		<form action="createCategory.php" method="post" enctype="multipart/form-data">
			分类名：<input type="text" name="name"><br>
			<input type="submit"><br>
			<input type="reset">
		</form>
	</div>
</body>

</html>
