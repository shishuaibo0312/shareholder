<?php
/**
 * This file is part of QTTX frame.
 *
 * @author    hyunsu
 * @date      2020-09-07 10:57 上午
 */

namespace app\modules\account;


class Module extends \qttx_frm\libs\ui\Module
{
    /**
     * 控制器过滤器之一,控制是否执行 controller
     * 在执行控制之前调用, 调用规则由 `$onlyFilter` 和 `$exceptFilter` 决定
     * @return bool 返回true,执行 controller ,其它值不执行 controller
     */
    public function beforeController()
    {
        // todo 判断权限
        if (false) {
            // 权限不足,返回指定http状态码
            \QTTX::$response->setStatusCode(401);
            // 返回false 则不执行接下来的操作
            return false;
        }

        return true;
    }
}