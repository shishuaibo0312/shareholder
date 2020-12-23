<?php
/**
 * This file is part of QTTX frame.
 *
 * @author    hyunsu
 * @date      2020-08-15 3:08 下午
 */

namespace app\controllers;


use example\models\validator\CompareModel;
use example\models\validator\CustomModel;
use qttx_frm\libs\ui\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        echo "Welcome Qttx Frm1";
    }


    public function actionTest()
    {
        var_dump(11111);
    }

    public function actionField()
    {
        $table = \QTTX::$request->get('table');

        if (empty($table)) {
            echo '需要数据表参数';
            return;
        }

        $sql = "SHOW FULL COLUMNS FROM {$table}";

        $resp = \QTTX::$app->db->query($sql);

        $str = "[\r\n";

        foreach ($resp as $item) {
            $field = $item['Field'];
            $str .= "'{$field}'=>'',\r\n";
        }

        $str .= ']';

        echo $str;
    }



    public  $username;

    public function log()
    {
        $db = \QTTX::$app->db;

        $a = "' or 1=1#";

        // 这样是安全的,查询出来是空值
        $b = $db->select()
            ->from('frm_test')
            ->where("title= :title")
            ->bindValue('title',$a)
            ->query();

        // 这样相当于  select * from frm_test
        $c = $db->select()
            ->from('frm_test')
            ->where("title='{$a}'")
            ->query();

        var_dump($b);

        var_dump($c);
        
    }
}