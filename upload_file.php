<?php
header("content-type:text/html;charset=utf-8");
require "lib/string.func.php";
//$code->doimg();
//echo "<br>";
//echo $code->getCode();

//echo getStringRand();

$img_size = $_FILES['uploadfile']['size'];
$fileName = $_FILES['uploadfile']['name'];
$tmp_name = $_FILES['uploadfile']['tmp_name'];
$img_type = $_FILES['uploadfile']['type'];

echo "<pre>";
var_dump($_FILES);
//判断是否为post提交
if (!is_uploaded_file($tmp_name)) {
	die("上传文件出现了问题，不是post提交的");
}

if ($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) {
	switch ($_FILES['uploadfile']['error']) {
		case UPLOAD_ERR_INI_SIZE://其值为 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值
			die('The upload file exceeds the upload_max_filesize directive in php.ini');
			break;
		case UPLOAD_ERR_FORM_SIZE://其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
			die('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
			break;
		case UPLOAD_ERR_PARTIAL://其值为 3，文件只有部分被上传
			die('The uploaded file was only partially uploaded.');
			break;
		case UPLOAD_ERR_NO_FILE://其值为 4，没有文件被上传
			die('No file was uploaded.');
			break;
		case UPLOAD_ERR_NO_TMP_DIR://其值为 6，找不到临时文件夹
			die('The server is missing a temporary folder.');
			break;
		case UPLOAD_ERR_CANT_WRITE://其值为 7，文件写入失败
			die('The server failed to write the uploaded file to disk.');
			break;
		case UPLOAD_ERR_EXTENSION://其他异常
			die('File upload stopped by extension.');
			break;

	}
}
//允许的图片类型
$allowType = array('image/gif', 'image/jpg', 'image/png', 'image/BMP', 'image/jpeg');
if (!in_array($img_type, $allowType)) {
	die("不允许上传这类类型的文件.");
}

//文件上传的路径问题
//默认路径是
$dir          = dirname(__file__);
$uploads_path = "uploads";
$dir_path     = Date("Ymd", time());
//判断文件夹是否存在
$path = $dir."/".$uploads_path."/".$dir_path;
if (!file_exists($path)) {
	mkdir($path, 0777, true);
}

$file_true_dir = $path."/".getStringRand().".".getStringSuffix($fileName);
if (move_uploaded_file($tmp_name, $file_true_dir)) {
	echo "上传成功";
} else {
	echo "临时文件不存在，上传失败";
}
