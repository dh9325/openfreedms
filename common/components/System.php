<?php

namespace common\components;

use common\models\Approver;
use common\models\Contributor;
use common\models\Department;
use common\models\DocumentCategory;
use common\models\Reviewer;
use common\models\User;
use Yii;
use yii\base\Component;

/**
 * Wrapper class for all messages sent from UI (see https://en.wikipedia.org/wiki/Facade_pattern)
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
        $user->setAttribute('department', $department);
        if ($user->save()) {
            // todo: allow configuration of email from and subject(?)
            // send email notification
            Yii::$app->mailer->compose('add-user', compact('username', 'password'))
                ->setFrom('dnr@openfreedms.com')
                ->setTo($email)
                ->setSubject(Yii::t('app', 'Document Management System credentials'))
                ->send();
            return $user->id;
        } else {
            return 0;
        }
    }

    public function addDepartment($name)
    {
        $model = new Department();
        $model->setAttribute('name', $name);
        if ($model->save()) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public function addDocumentCategory($name)
    {
        $model = new DocumentCategory();
        $model->setAttribute('name', $name);
        if ($model->save()) {
            return $model->id;
        } else {
            return 0;
        }
    }

    public function addContributor($user, $department)
    {
        $model = new Contributor();
        $model->setAttribute('user_id', $user);
        $model->setAttribute('department_id', $department);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function addReviewer($user, $department)
    {
        $model = new Reviewer();
        $model->setAttribute('user_id', $user);
        $model->setAttribute('department_id', $department);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function addApprover($user, $department)
    {
        $model = new Approver();
        $model->setAttribute('user_id', $user);
        $model->setAttribute('department_id', $department);
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function addDocument()
    {
        // todo: implement
    }

}