<?php

namespace common\models\forms;

use common\interfaces\Permission;
use common\models\Department;
use common\models\Document;
use yii\base\Model;

class CreateDepartmentPermission extends Model
{
    public $document;
    public $department;
    public $type;

    public function rules()
    {
        return [
            [['document', 'department', 'type'], 'required'],
            [
                ['document'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Document::className(),
                'targetAttribute' => ['document' => 'id']
            ],
            [
                ['department'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Department::className(),
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