<?php
/**
 * Author: WenJun
 * Date:   2013-01-12 下午3:49
 * Email:  wenjun1055@gmail.com
 *
 * File:   admin.php
 * Desc:   控制kvdb的一些数据的初始化和修改
 */
require_once 'class/kvdb.class.php';
$adminUrl = 'http://imgfucker.sinaapp.com/admin.php';

$kvdb = new Kvdb();
header('Content-type:text/html;charset=UTF-8');
if ($_POST['key']) {
    //TODO 更新kvdb里面配置
    if ($kvdb->add(trim($_POST['key']), trim($_POST['value']))) {
        echo "增加成功！<br>Key = {$_POST['key']}<br>Value = {$_POST['value']}<br>";
    } else {
        echo '添加失败！<br>';
    }
} else {
    if ($_GET['key'] == 'ad') {
        //TODO 展示广告的配置
        $result = $kvdb->pkrget('Ad');
    } elseif ($_GET['key'] == 'moderator') {
        //TODO 展示各个论坛版主的情况
        $result = $kvdb->pkrget('Moderator');
    } elseif ($_GET['key'] == 'log') {
        $num    = $kvdb->pkrget('LogofUser');
        $time   = $kvdb->pkrget('LogofLastUserTime');
        $result = array_merge($kvdb->pkrget('LogofUserCurrentNum'), $num, $time);
    } elseif ($_GET['key'] == 'delete') {
        if ($kvdb->delete($_GET['index'])) {
            echo '删除成功!';
            echo '<br><br><a href="admin.php">返回</a> ';
        } else {
            echo '删除失败！';
            echo '<br><br><a href="admin.php">返回</a> ';
        }
    } else {
        $ad     = $kvdb->pkrget('Ad');
        $result = array_merge($ad, $kvdb->pkrget('Moderator'));
    }

    if (isset($result)) {
        $html  = '<html><body><table border="1" cellspacing="0px"><tr><th>Key</th><th>Value</th><th>Handle</th></tr>';
        foreach ($result as $k => $v) {
            $html .= "<tr><td>&nbsp;&nbsp;$k&nbsp;&nbsp;</td><td>&nbsp;&nbsp;$v&nbsp;&nbsp;</td>";
            $html .= '<td>&nbsp;&nbsp;<a href="' . $adminUrl . '?key=delete&&index=' . $k . '">delete</a>&nbsp;&nbsp;</td></tr>';
        }
        $html .= '</table><br><br><br><form action="admin.php" method="post">';
        $html .= 'Key: <input type="text" name="key" size=50><br>';
        $html .= 'Value: <input type="text" name="value" size=80><br><input type="submit"><br>';
        $html .= '<br>广告的格式：&nbsp;&nbsp;&nbsp;&nbsp;Key = Ad.duowan&nbsp;&nbsp;&nbsp;&nbsp;Value = 广告图片地址';
        $html .= '</form></body></html>';
        echo $html;
    }

}