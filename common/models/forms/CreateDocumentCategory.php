<?php

namespace common\models\forms;

use yii\base\Model;

class CreateDocumentCategory extends Model
{
    public $name;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255]
        ];
    }
}