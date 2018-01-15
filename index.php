<?php 
	header("content-type:text/html; charset=utf-8");
	date_default_timezone_set('PRC');
	echo '<br/><br/><form><input type="text" name="path"><input type="submit" value="请输入扫描路径">&nbsp;&nbsp;默认是当前路径</form><br/>';
	echo '<font color="red">使用说明：输入./是当前路径，输入../是上级目录，输入../../是上级的上级的目录，输入./a进入a文件夹</font>';
	//$path=$_GET['path']; //这是写入你要遍历的目录
	$paths=$_GET['path'];
	if($paths==''){
		$path='./';
	}else{
		$path=$paths;
	}
	//$path=$_GET['path']; //这是写入你要遍历的目录
	// echo "<form act='post.php' meathod='post'>";
	echo "<table class='table table-striped'>";
 	echo "<tr><td colspan='10'>无敌文件遍历扫描系统</td></tr>";
 	echo "<tr><td>文件ID</td><td>文件名称</td><td>类型</td><td>相对路径</td><td>文件大小</td><td>创建时间</td><td>修改时间</td><td>访问时间</td><td>操作</td></tr>";
		function dirs($path){
		//1，打开目录
		static $i=1;
		$res=opendir($path);
		//2，读取目录
		//防止文件名或者目录名为false的七种情况
		while(false!==($f=readdir($res))){
			//跳过.和..
			if($f=='.'||$f=='..'){
				continue;
			}
		
			//获取文件的真实路径
			$file=rtrim($path,"/")."/".$f;
			//根据级别添加缩进，级别越深，缩进越多
			for($j=1;$j<$i;$j++){
				$prefix.="&nbsp;&nbsp";
			}
			static $a=1;
			// echo $prefix.$f."----".filetype($file)." 物理路径：".dirname($file)."<br/>";
			// $prefix="";
			echo '<tr><td>'.$a++.'<td>'.iconv("gb2312","utf-8",$f).'</td>
			<td>'.filetype($file).'</td><td>'.iconv("gb2312","utf-8",dirname($file)).'</td><td>'.filesize($file).'B</td><td>'.date("Y-m-d H:m:s",filectime($file)).'<td>'.date("Y-m-d H:m:s",filemtime($file)).'</td><td>'.date("Y-m-d H:m:s",fileatime($file)).'</td><td>
			<a href=/file/post.php?act=del&$file='.$file.'>删除</a>
			<a href=/file/post.php?act=del&$file='.$file.'>编辑</a>
			<a href=/file/post.php?act=del&$file='.$file.'>进入</a>
			<a href=/file/post.php?act=del&$file='.$file.'>上级</a>
			</td><td></tr>';
			//如果改文件系统为目录
			
			//如果开启如下，它会遍历本文件夹下面的所有的文件夹和文件	
			 if(is_dir($file)){ //如果遇到目录，开始递归目录
				$i++;//每次进入目录，让级别加一
				dirs($file);
			}  
			//关闭目录	
		}
		closedir($res);
		$i--;//关闭目录的时候让级别减一，回复到上级目录的级别
}
	
	 echo dirs($path);  //开始遍历目录
	echo "</table>";
	// echo "</form>";
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<title>文件管理系统</title>
</head>
<body>
	
</body>
</html>
