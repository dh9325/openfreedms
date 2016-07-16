<?php

namespace common\models\forms;

use yii\base\Model;

class CreateContributor extends Model
{
    public $user;
    public $department;

    public function rules()
    {
        return [
            [['user', 'department'], 'required'],
            [['user', 'department'], 'integer']
        ];
    }
}