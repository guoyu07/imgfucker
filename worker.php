<?php
/**
 * Author: WenJun
 * Date:   2013-01-10 下午11:03
 * Email:  wenjun1055@gmail.com
 *
 * File:   worker.php
 * Desc:   后台cron查找版主
 *         图片超过一天未被打开就算被封，默认一个板块有五个版主
 */

require_once 'class/kvdb.class.php';

//一天有多少秒
$oneDay = 24 * 60 * 60;
//获取当前时
$hour   = date('H');

if ($hour > 0 && $hour < 12) {
    exit();
}

$statistics = array();
$kvdb       = new Kvdb();
$result     = $kvdb->pkrget('LogofLastUserTime');

foreach($result as $k => $v) {
   if (time() - $v >= $oneDay) {
       $key      = str_replace('LogofLastUserTime', 'LogofUser', $k);
       $keyArray = explode('.', $key);
       $result   = array_unique($kvdb->pkrget($key));
       if ($statistics[$keyArray[1]][$keyArray[2]][$keyArray[3]]) {
           foreach ($result as $k => $v) {
               $statistics[$keyArray[1]][$keyArray[2]][$keyArray[3]] = $v;
           }
       } else {
           $statistics[$keyArray[1]][$keyArray[2]][$keyArray[3]] = $result;
       }
   }
}
//print_r($statistics);

foreach ($statistics as $siteK => $siteV) {
    foreach ($siteV as $formK => $formV) {
        if (count($formV) > 10) {
            //当前板块被封帖子超过10张，开始寻找版主ip
            $tempArray = array();
            foreach ($formV as $tK => $tV) {
                $tempArray = array_merge($tV, $tempArray);
            }
            $tempArray = array_count_values($tempArray);
            uasort($tempArray, 'cmp');
            $counter = count($tempArray) < 5 ? count($tempArray) : 5;

            foreach ($tempArray as $k => $v) {
                $counter--;
                if ($counter >= 0 && $v > 1) {
                    $key = "Moderator.{$siteK}.{$k}.{$formK}";
                    $kvdb->add($key, 1);
                }
            }
        }
    }
}

function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? 1 : -1;
}