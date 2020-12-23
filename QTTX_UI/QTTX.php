<?php

use qttx_frm\libs\basic\Event;
use qttx_frm\libs\exceptions\InvalidConfigException;
use qttx_frm\libs\factory\Container;
use qttx_frm\libs\helper\ArrayHelper;

/**
 * This file is part of QTTX frame.
 *
 * @author    hyunsu
 * @date      2020-07-24 12:25 下午
 */
class QTTX
{
    /**
     * 将系统配置和用户配置合并后的配置
     * @var array
     */
    public static $config = [];

    /**
     * @var array 多语言配置,合并后的配置数组
     */
    public static $lang = [];

    /**
     * @var \qttx_frm\libs\basic\Request
     */
    public static $request;

    /**
     * @var \qttx_frm\libs\response\Response
     */
    public static $response;

    /**
     * @var \qttx_frm\libs\basic\Application
     */
    public static $app;

    /**
     * 禁止实例化
     * QTTX constructor.
     */
    protected function __construct()
    {

    }

    /**
     * 获取配置
     * @param string $name 配置的键名,可以通过a.b.c的形式获取子数组
     * 例如 'route' => array(
                'default_module' => 'app',
                'only_route_file' => false,
            ),
     * 可以使用 getConfig('route.only_route_file') 获取配置
     *
     * @param mixed $default 没有配置时候默认值
     * @return array|string|null
     */
    public static function getConfig($name, $default = null)
    {
        $value = \qttx_frm\libs\helper\ArrayHelper::getValue(self::$config, $name);
        return $value === null ? $default : $value;
    }

    /**
     * 创建一个对象或组件实例
     * @param string|array $class 类名或者带有'class'下标的数组
     * @param array $conf 作为构造参数传入
     * @param string $name
     * @param bool $isComponent 实例化的是否是组件.该参数在$class为数组时候生效
     *              如果是组件,$class和$conf合并作为构造函数的参数
     *              非组件, $class作为依赖属性传入
     * @return object
     */
    public static function createObject($class, $conf = [], $name = '', $isComponent = true)
    {
        $param = [];
        if (is_array($class)) {
            // $class 是数组,则提取 'class' 下标作为类名
            if (!isset($class['class'])) {
                throw new InvalidConfigException("The configuration of component {$name} must have a key called `class`");
            }
            if ($isComponent) {
                // 组件,则合并 $conf
                $conf = ArrayHelper::merge($class, $conf);
                $class = $conf['class'];
                unset($conf['class']);
            } else {
                $param = $class;
                $class = $param['class'];
                unset($param['class']);
            }
        }

        if ($isComponent) {
            $com = Container::get($class, [$conf], $param);
        } else {
            $com = Container::get($class, $conf, $param);
        }

        if (method_exists($com, 'getEvents')) {
            foreach ($com->getEvents() as $en => $ev) {
                // 值是索引数组,就是一个事件多个监听
                if (ArrayHelper::isAssocArray($ev)) {
                    foreach ($ev as $item) {
                        Event::getInstance()->addEvent($en, $item);
                    }
                } else {
                    Event::getInstance()->addEvent($en, $ev);
                }
            }
        }

        return $com;
    }


    /**
     * 获取数据库Model的实例
     * @return \qttx_frm\libs\db\Model
     */
    public static function getDB()
    {
       return self::$app->db;
    }


    /**
     * 获取Redis
     * @return \qttx_frm\libs\redis\Redis
     */
    public static function getRedis()
    {
        return self::$app->redis;
    }

    /*
     * 获取Kafka实例
     * */
    public static function getKafka()
    {
        $config = 'kafka';
        $key = md5($config);

        $redis[$key] = new \qttx_frm\libs\queue\kafka\MyKafka();

        return $redis[$key];
    }

    /*
     * 获取RabbitMQ实例
     * */
    public static function getRabbitMQ()
    {
        $config = 'RabbitMQ';
        $key = md5($config);

        $redis[$key] = new \qttx_frm\libs\queue\rabbitmq\MyRabbitMQ();

        return $redis[$key];
    }

    /*
     * 获取Nsq实例
     * */
    public static function getNsq()
    {
        $config = 'Nsq';
        $key = md5($config);

        $redis[$key] = new \qttx_frm\libs\queue\nsq\MyNsq();

        return $redis[$key];
    }
}