<?php

namespace common\models\forms;

use common\interfaces\Permission;
use common\models\Department;
use common\models\Document;
use yii\base\Model;

class CreateDepartmentPermission extends Model implements Permission
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
                    self::TYPE_DENIED,
                    self::TYPE_VIEW,
                    self::TYPE_READ,
                    self::TYPE_EDIT,
                    self::TYPE_ADMIN
                ],
                'allowArray' => true
            ]
        ];
    }
}