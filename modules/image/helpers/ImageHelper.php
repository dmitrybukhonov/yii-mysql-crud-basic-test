<?php

namespace app\modules\image\helpers;

use yii\base\Model;
use app\modules\image\models\Image;

final class ImageHelper
{
    /**
     * @param Model $model
     * @param string $attribute
     * @return string
     */
    public static function getImageUrl(Model $model, string $attribute): string
    {
        $image = Image::findOne([
            'id' => $model->{$attribute},
            'entity_id' => $model->id,
            'entity' => get_class($model)
        ]);

        if (!$image) {
            return '#';
        }

        return $image->path;
    }
}
