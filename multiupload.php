<?php
	header("content-type:text/html;charset=utf-8");
	//多文件上传
	$data=multiupload($info);
	echo "<pre>";
	var_dump($data);
	var_dump($info);
	echo "</pre>";
	function multiupload(&$info,$dir="./uploads/",$name='pic',$size=3000000,$allow_mime=array('image/png','image/jpeg','image/gif','image/png','image/jpeg','image/gif','image/wbmp'),$allow_ext=array('gif','jpeg','jpg','png','bmp')){
		//组装数组
		foreach ($_FILES[$name] as $key => $val) {
			foreach ($val as $k => $v) {
				$data[$k][$key]=$v; 
			}
		}
		foreach($data as $key=>$upfile){
			//判断错误
			if($upfile['error']>0){
				switch($upfile['error']){
					case 1:
						$info[$key]="文件太大，超出，php.ini里upload_max_filesize设定值";
						continue;
					case 2:
						$info[$key]="超出了html表单的预设值限制";
						continue;
					case 3:
						$info[$key]="上传终端";
						continue;
					case 4:
						$info[$key]="没有上传文件";
						continue;
					case 6:
						$info[$key]="临时文件夹找不到了";
						continue;
					case 7:
						default:
						$info[$key]="临时文件夹已满或者是磁盘已满";
						continue;
				}
			}
			//判断文件大小
			if($upfile['size']>$size){
				$info[$key]="文件太大";
				continue;
			}
			//判断文件的mime类型
			if(!in_array($upfile['type'],$allow_mime)){
				$info[$key]="检查你的文件类型是否允许，允许类型为：".join(",",$allow_mime);
				continue;
			}
			//判断文件的扩展名
			$ext=pathinfo($upfile['name'],PATHINFO_EXTENSION);
			if(!in_array($ext, $allow_ext)){	
				$info[$key]="你的扩展名不允许，允许的扩展名为：".join(",",$allow_ext);
				continue;
			}
			//新建目录
			if(!file_exists($dir)){
				mkdir($dir,0755,true);
			}
			//新建文件的随机名
			$name=md5(time().mt_rand()).".".$ext;
			//执行移动(核心代码)
			if(is_uploaded_file($upfile['tmp_name'])){
				if(move_uploaded_file($upfile['tmp_name'], $dir."/".$name)){
					$info[$key]="文件上传成功";
				//保存信息
				$data[$key]=array('name'=>$upfile['name'],'new_name'=>$name,'ext'=>$ext,'size'=>$upfile['size'],'mime'=>$upfile['type']);
				}
			}
		}
		return $data;
	}