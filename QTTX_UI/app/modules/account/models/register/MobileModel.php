<?php
/**
 * This file is part of QTTX frame.
 *
 * @author    hyunsu
 * @date      2020-09-07 11:03 上午
 */

namespace app\modules\account\models\register;


use qttx_frm\libs\helper\StringHelper;
use qttx_frm\libs\ui\Model;

class MobileModel extends Model
{
    // 用户提交参数
    public $mobile;
    // 用户提交参数
    public $code;
    // 用户提交参数
    public $password;

    /**
     * 验证参数
     * @return array|void
     */
    public function rules()
    {
        return [
            [['mobile','code'],'required'],
            ['mobile','mobile'],
            ['mobile','unique',['table'=>'sp_tiktok_user','field'=>'mobile']],
            ['code','match','pattern'=>'/^\d+$/'],
            ['password','string'],
            ['code','checkCode']
        ];
    }

    public function checkCode($value)
    {
        // todo 查询验证码是否正确
        return true;
    }

    public function attributeLangs()
    {
        return [
            'mobile'=>'手机号',
            'code'=>'验证码',
            'password'=>'密码'
        ];
    }

    public function run()
    {
        //todo  新建用户

        return [
            'uuid' => StringHelper::random(32),
        ];
    }

}