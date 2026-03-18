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
        ini_set('display_errors', 'On');
        // 允许上传的图片后缀
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        echo $_FILES["image"];
        $temp = explode(".", $_FILES["image"]["name"]);
        echo $_FILES["image"]["size"];
        $extension = end($temp);     // 获取文件后缀名
        if ((($_FILES["image"]["type"] == "image/gif")
                || ($_FILES["image"]["type"] == "image/jpeg")
                || ($_FILES["image"]["type"] == "image/jpg")
                || ($_FILES["image"]["type"] == "image/pjpeg")
                || ($_FILES["image"]["type"] == "image/x-png")
                || ($_FILES["image"]["type"] == "image/png"))
            && ($_FILES["image"]["size"] < 2 * 1024 * 1024)   // 小于 2 mb
            && in_array($extension, $allowedExts)
        ) {
            if ($_FILES["image"]["error"] > 0) {
                echo "错误：: " . $_FILES["image"]["error"] . "<br>";
            } else {
                echo "上传文件名: " . $_FILES["image"]["name"] . "<br>";
                echo "文件类型: " . $_FILES["image"]["type"] . "<br>";
                echo "文件大小: " . ($_FILES["image"]["size"] / 1024) . " kB<br>";
                echo "文件临时存储的位置: " . $_FILES["image"]["tmp_name"] . "<br>";

                // 判断当前目录下的 image 目录是否存在该文件
                // 如果没有 image 目录，你需要创建它，image 目录权限为 777
                if (file_exists("images/" . $_FILES["image"]["name"])) {
                    echo $_FILES["image"]["name"] . " 文件已经存在。 ";
                } else {
                    // 如果 image 目录不存在该文件则将文件上传到 image 目录下
                    move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $_FILES["image"]["name"]);
                    echo "文件存储在: " . "images/" . $_FILES["image"]["name"];
                }

                $servername = "localhost";
                $username = "root";
                $password = "@Passw0rd";
                $dbname = "inventory";

                // 创建连接
                $conn = new mysqli($servername, $username, $password, $dbname);
                // 检测连接
                if ($conn->connect_error) {
                    die("连接失败: " . $conn->connect_error);
                }

                $conn->query("SET NAMES UTF8");

                date_default_timezone_set("Asia/Shanghai");

                $sql = "UPDATE goods SET category='" . $_POST["category"] . "',name='" . $_POST["name"] . "',price='" . $_POST["price"] . "',store='" . $_POST["store"] . "',sell='" . $_POST["sell"] . "',image='" . "images/" . $_FILES["image"]["name"] . "',date='" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "' WHERE id=" . $_POST["id"];

                if ($conn->query($sql) === TRUE) {
                    echo $id = $conn->insert_id;
                    echo "新记录插入成功";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
        } else {
            echo "非法的文件格式";
        }
        ?>
    </div>
</body>

</html>