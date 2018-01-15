<?php
// var_dump($_FILES);
header("content-type:text/html; charset=utf8");
$arr=$_FILES;
 var_dump($arr);
// var_dump($arr);
foreach ($arr[file][name] as $key => $value) {
	echo "文件名:".$value."类型是：".$arr[file][type][$key]."临时文件为：".$arr[file][tmp_name][$key]."文件大小为：".$arr[file][size][$key]."错误号为：".$arr[file][error][$key]."<br/>";
}
echo "<hr/>";
foreach($arr['file'] as $key=>$val){
	foreach($val as $k=>$v){
		$data[$k][$key]=$v;
	}
}
var_dump($data);