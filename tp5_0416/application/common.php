<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

define('BASETITLE', '北京安太妇产医院-客服预约管理系统');


/**
 * 过滤掉emoji表情
 * @param 微信昵称 $str
 * @return 处理后的昵称
 */
function filterEmoji($str)
{
	$str = preg_replace_callback(
		'/./u',
		function (array $match) {
			return strlen($match[0]) >= 4 ? '' : $match[0];
		},
		$str);
	return $str;
}

