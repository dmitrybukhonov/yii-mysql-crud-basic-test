<?php

namespace app\modules\image\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $entity_id
 * @property string $entity
 * @property string $path
 * @property string $filename
 * @property string|null $mime_type
 * @property int|null $width
 * @property int|null $height
 * @property int|null $file_size
 * @property string $created_at
 */
class Image extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity', 'path', 'filename', 'created_at'], 'required'],
            [['entity_id', 'width', 'height', 'file_size'], 'integer'],
            [['created_at'], 'safe'],
            [['entity', 'path', 'filename', 'mime_type'], 'string', 'max' => 255],
        ];
    }
}
