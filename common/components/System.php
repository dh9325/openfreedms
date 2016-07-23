<?php

namespace common\components;

use common\models\Approver;
use common\models\Contributor;
use common\models\Department;
use common\models\DepartmentPermission;
use common\models\DocumentCategory;
use common\models\Reviewer;
use common\models\Document;
use common\models\User;
use common\models\UserPermission;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Wrapper class for all messages sent from UI (see https://en.wikipedia.org/wiki/Facade_pattern)
 *
 * Class System
 * @package common\components
 */
class System extends Component
{
    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $department
     * @return bool|int
     */
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
            return false;
        }
    }

    /**
     * @param $name
     * @return bool|int
     */
    public function addDepartment($name)
    {
        $model = new Department();
        $model->setAttribute('name', $name);
        if ($model->save()) {
            return $model->id;
        } else {
            return false;
        }
    }

    /**
     * @param $name
     * @return bool|int
     */
    public function addDocumentCategory($name)
    {
        $model = new DocumentCategory();
        $model->setAttribute('name', $name);
        if ($model->save()) {
            return $model->id;
        } else {
            return false;
        }
    }

    /**
     * @param $user
     * @param $department
     * @return bool
     */
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

    /**
     * @param $user
     * @param $department
     * @return bool
     */
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

    /**
     * @param $user
     * @param $department
     * @return bool
     */
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

    /**
     * @param $documentCategory
     * @param $department
     * @param $file
     * @param $workflow
     * @param $title
     * @param $revisionNo
     * @param $referenceNo
     * @return bool|int
     */
    public function addDocument($documentCategory, $department, $file, $workflow, $title, $revisionNo, $referenceNo)
    {
        $model = new Document();
        $model->setAttribute('document_category', $documentCategory);
        $model->setAttribute('department', $department);
        $model->setAttribute('file', $file);
        $model->setAttribute('workflow', $workflow);
        $model->setAttribute('title', $title);
        $model->setAttribute('revision_number', $revisionNo);
        $model->setAttribute('reference_number', $referenceNo);
        $model->setStatusOnCreate();
        if ($model->save()) {
            // todo: configuration of email from
            // send email notification to reviewers
            Yii::$app->mailer->compose('add-document', compact('model'))
                ->setFrom('dnr@openfreedms.com')
                ->setTo(ArrayHelper::map(Reviewer::getForDepartment($model->department), 'name', 'email'))
                ->setSubject(Yii::t('app', 'New document has been added'))
                ->send();
            return $model->id;
        } else {
            return false;
        }
    }

    /**
     * @param $department
     * @param $document
     * @param $type
     * @return bool|int
     */
    public function setDepartmentPermission($department, $document, $type)
    {
        $model = new DepartmentPermission();
        $model->setAttribute('department_id', $department);
        $model->setAttribute('document_id', $document);
        $model->setAttribute('type', $type);
        if ($model->save()) {
            return $model->id;
        } else {
            return false;
        }
    }

    /**
     * @param $user
     * @param $document
     * @param $type
     * @return bool|int
     */
    public function setUserPermission($user, $document, $type)
    {
        $model = new UserPermission();
        $model->setAttribute('user_id', $user);
        $model->setAttribute('document_id', $document);
        $model->setAttribute('type', $type);
        if ($model->save()) {
            return $model->id;
        } else {
            return false;
        }
    }

}