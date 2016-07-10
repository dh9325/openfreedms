<?php

namespace common\models\forms;

use yii\base\Model;

class AddUserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $department;
    public $isAdmin;
    public $isMasterAdmin;

    public function rules()
    {
        return [
            [['username', 'password', 'email', 'department'], 'required'],
            [['email'], 'email']
        ];
    }

}