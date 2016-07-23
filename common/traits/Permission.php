<?php

namespace common\traits;

use common\interfaces\Permission as PermissionInterface;
use Yii;

trait Permission
{

    public function getPermissionTypes()
    {
        return [
            PermissionInterface::TYPE_DENIED => Yii::t('app', 'Denied'),
            PermissionInterface::TYPE_VIEW => Yii::t('app', 'View'),
            PermissionInterface::TYPE_READ => Yii::t('app', 'Read'),
            PermissionInterface::TYPE_EDIT => Yii::t('app', 'Edit'),
            PermissionInterface::TYPE_ADMIN => Yii::t('app', 'Admin')
        ];
    }
}