<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Support\Helper
 */
class Helper extends Facade
{

    // このメソッドにバインドしたクラス名やバインド名「app-helperのような」を戻り値として指定する
    // 仕組みとしては、ファザードの仕組みとしては、クラス名が見つからなかったらgetFacadeAccessorの定義を参照するみたいな仕組みになってる
    protected static function getFacadeAccessor()
    {
        return 'app-helper';
    }
}
