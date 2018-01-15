<?php
	header("content-type:text/html; charset=utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="multiupload.php" method="post" enctype="multipart/form-data">
		上传文件：<input type="file" name="pic[]"><hr/>
		 上传文件：<input type="file" name="pic[]"><hr/>
		上传文件：<input type="file" name="pic[]"><hr/> 
		<input type="submit" value="上传">
	</form>
	<a href="download.php">下载</a>
</body>
</html>
