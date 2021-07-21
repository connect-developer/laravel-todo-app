<?php

namespace App\Enums;

use BenSampo\Enum\Enum as BaseEnum;
use BenSampo\Enum\Contracts\LocalizedEnum;
use Illuminate\Support\Facades\Lang;

/**
 * enum base class
 *
 * @package \App\Enums
 */
abstract class Enum extends BaseEnum implements LocalizedEnum
{

    /**
     * 翻訳された詳細配列を取得
     *
     * @return array|null
     */
    public static function getLocalizedDescriptions(): ?array
    {
        if (static::isLocalizable()) {
            $localizedStringKey = static::getLocalizationKey();

            if (Lang::has($localizedStringKey)) {
                return __($localizedStringKey);
            }
        }

        return null;
    }
}
