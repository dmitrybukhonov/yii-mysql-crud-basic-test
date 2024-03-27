<?php

namespace app\modules\subscribe\forms;

use yii\base\Model;

class ModelSubscriptionForm extends Model
{
    /**
     * @var string
     */
    public $entity;
    /**
     * @var integer
     */
    public $entity_id;
    /**
     * @var string
     */
    public $phone;

    public function rules()
    {
        return [
            [['entity_id', 'entity', 'phone'], 'required'],
            [['entity_id'], 'integer'],
            [['entity', 'phone'], 'string'],
            ['phone', 'match', 'pattern' => '/^7\d{10}$/', 'message' => 'Номер телефона должен быть в формате 79278092331.'],
        ];
    }
}
