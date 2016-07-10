<?php

namespace common\components;

use common\models\Department;
use common\models\User;
use yii\base\Component;

/**
 * Wrapper class for all methods sent from UI (see https://en.wikipedia.org/wiki/Facade_pattern)
 *
 * Class System
 * @package common\components
 */
class System extends Component
{
    public function addUser($username, $password, $email, $department)
    {
        $user = new User();
        $user->setAttribute('username', $username);
        $user->setAttribute('email', $email);
        $user->setPassword($password);
        if (is_int($department)) {
            $user->setAttribute('department', $department);
        }
        if ($department instanceof Department) {
            $user->setAttribute('department', $department->id);
        }
        return $user->save();
    }

}