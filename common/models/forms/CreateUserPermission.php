<?php

namespace common\models\forms;

use common\interfaces\Permission;
use common\models\Document;
use common\models\User;
use yii\base\Model;

class CreateUserPermission extends Model
{
    public $user;
    public $document;
    public $type;

    public function rules()
    {
        return [
            [['user', 'document', 'type'], 'required'],
            [
                ['user'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['document' => 'id']
            ],
            [
                ['document'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Document::className(),
                'targetAttribute' => ['department' => 'id']
            ],
            [
                ['type'],
                'in',
                'range' => [
                    Permission::TYPE_DENIED,
                    Permission::TYPE_VIEW,
                    Permission::TYPE_READ,
                    Permission::TYPE_EDIT,
                    Permission::TYPE_ADMIN
                ],
                'allowArray' => true
            ]
        ];
    }
}