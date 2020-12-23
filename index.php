<?php
/*
 * 当前开发环境,不同环境读取的配置文件不同
 * dev:开发环境(config_dev)
 * test:测试环境(config_test)
 * prod:线上环境(config_prod)
 */
define('ENV', 'dev');

define('UI_DEV', ENV == 'dev');
define('UI_PROD', ENV == 'prod');
define('UI_TEST', ENV == 'test');

/*
 * 是否是debug模式
 * debug模式不限制于开发环境,线上环境也可以开启debug模式
 * debug模式下一些会输出一些特定信息,或者详细信息
 * 注:非必要情况,线上环境请关闭debug模式
 */
define('UI_DEBUG', true);


/*
 * 应用程序路径
 * Linux下固定路径(框架中固定)
 * 此处UI_PATH为QTTX_UI路径
 * */
define('UI_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'QTTX_UI' . DIRECTORY_SEPARATOR);

/*
 * 框架统一入口
 * */
require realpath(__DIR__) . '/../../frame/QTTX_FRM/UI_Application.php';
