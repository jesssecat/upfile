<?php
	$file="./uploads/1.jpg";
	//1，通知浏览器文件的类型
	header("content-type:image/jpeg");
	//2，通知浏览器的大小
	header("content-length:".filesize($file));
	//3，通知浏览器以文件的形式显示文件
	header('Content-Disposition:attachment;filename='.basename($file));

	//4，输出文件
	readfile($file);