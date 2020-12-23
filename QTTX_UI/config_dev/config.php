<?php
/**
 * Created by PhpStorm.
 * User: 张昊
 * Date: 20-7-27
 * Time: 下午5:03
 */

return array(
    'language' => 'zh_CN',
    // 路由配置
    'route' => array(
        // 默认模块
        'default_module' => 'app',
        // 是否只是用路由文件
        'only_route_file' => false,
    ),

    'request' => array(
        // 控制器类名的后缀
        'ctrlAfterFix' => 'Controller',
        'actionBeforeFix' => 'action',
    ),


    'components' => array(
//        'log' => [
////            'class' => '\qttx_frm\libs\log\LogRecordFile',
//            'class' => '\qttx_frm\libs\log\LogPrintScreen',
//        ]
    ),

    /** 数据库集群配置 */
    'db' => array(
        // 是否开启主从模式, 如果不开启都是用则只使用主数据库配置
        // 不论主从是否开启,主库配置多个的时候,都是随机选择
        'db_cluster' => false,
        'masters' => array(
            'master1' => array(
                'db_type' => 'mysql',             // 数据库类型
                'db_host' => '192.168.100.107',       // 服务器地址
                'db_name' => 'Shop_TikTok',              // 数据库名
                'db_user' => 'root',              // 数据库用户名
                'db_pass' => 'root',             // 数据库密码
                'db_port' => 3306,                // 数据库端口号
                'db_charset' => 'utf8mb4',              // 数据库字符集
            ),
        ),
    ),

    /** redis哨兵集群配置 */

    /** kafka集群配置 */
    'kafka' => array(
        /** 须要使用topic时在此处配置*/
        'topic-sms'=>'topic_sms',

        /** 向指定topic发送数据的key值*/
        'topic-sms-key'=>'topic_sms_key',

        /** topic-order 下订单topic*/
        'topic-order'=>'topic_order',
        'hosts'=>array(
            'host1'=>array(
                'host_ip'=>'',
                'host_port'=>'',
            ),
            'host2'=>array(
                'host_ip'=>'',
                'host_port'=>'',
            ),
            'host3'=>array(
                'host_ip'=>'',
                'host_port'=>'',
            ),
        ),
    ),
);

