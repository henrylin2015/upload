<?php
function getStringRand() {
	return md5(microtime());
}
/**
 * 获取文件后缀名
 */
function getStringSuffix($fileName) {
	return end(explode(".", $fileName));
}