<?php
/**
 * Author: WenJun
 * Date:   2013-01-10 下午10:29
 * Email:  wenjun1055@gmail.com
 *
 * File:   config.php
 * Desc:   配置文件
 */

/**
 * 数据库配置区域
 */
 define("DB_HOST", SAE_MYSQL_HOST_M);
 define("DB_PORT", SAE_MYSQL_PORT);
 define("DB_USER", SAE_MYSQL_USER);
 define("DB_PASS", SAE_MYSQL_PASS);
 define("DB_NAME", SAE_MYSQL_DB);

function myLog($log = '')
{
    if ($log) {
        $db = new PDO('mysql:host='.DB_HOST.':'.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASS);
        $db->exec("insert into log(log) values ('{$log}')");
    }
}





