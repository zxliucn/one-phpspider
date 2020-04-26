<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => 'one',
    'domains' => array(
        'wufazhuce.com'
    ),
    'log_type' => 'error,debug',
    'log_show' => false,//显示爬取面板
    'scan_urls' => array(
        'http://wufazhuce.com/'
    ),
    'content_url_regexes' => array(
     "http://wufazhuce.com/one/\d+",
        // "http://wufazhuce.com/one/\d+"
    ),
    'list_url_regexes' => array(
       "http://wufazhuce.com/one/\d+",
    ),

    'fields' => array(
        array(
            'name' => "title",//描述
            'selector' => "//div[contains(@class,'one-cita')]//div",
            'required' => true
        ),
        array(
            'name' => "pic_url",//作者
            'selector' => "//div[contains(@class,'one-imagen')]//img",
        ),   
        array(
            'name' => "month",//标题
            'selector' => "//p[contains(@class,'dom')]",
   
        ),    
        array(
            'name' => "day",//内容
            'selector' => "//div[contains(@class,'may')]",
        ),   
    ),
// 'export' => array(
//     'type'  => 'sql',
//     'file'  => './ceshi.sql',
//     'table' => 'aaa',
// ),
    'db_config' => array(
     'host'  => '127.0.0.1',
     'port'  => 3306,
     'user'  => 'root',
     'pass'  => 'pklsx0012',
     'name'  => 'depp',
 ),
 'export' => array(
      'type' => 'db',
      'table' => 'one_pic',  // 如果数据表没有数据新增请检查表结构和字段名是否匹配
 ),
);
$spider = new phpspider($configs);
$spider->on_start = function ($spider) 
{
    // 生成列表页URL入队列
    for ($i = 14; $i <= 2799; $i++) 
    {
        $url = "http://wufazhuce.com/one/{$i}";
        $spider->add_url($url);
    }
};

$spider->start();