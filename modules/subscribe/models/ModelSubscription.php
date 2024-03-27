<?php

namespace app\modules\subscribe\models;

use yii\db\ActiveRecord;

class ModelSubscription extends ActiveRecord
{
    public static function tableName()
    {
        return 'model_subscription';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['entity_id', 'entity', 'phone'], 'required'],
            [['entity_id'], 'integer'],
            [['entity', 'phone'], 'string'],
            ['phone', 'match', 'pattern' => '/^7\d{10}$/', 'message' => 'Номер телефона должен быть в формате 79278092331.'],
        ];
    }

    // public function getModel()
    // {
    //     return $this->hasOne(Author::class, ['id' => 'entity_id']);
    // }
}
