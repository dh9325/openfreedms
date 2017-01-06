<?php
namespace common\models;

use common\interfaces\Permission;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $department
 * @property boolean $is_admin
 * @property boolean $is_master_admin
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static $statuses = [
        self::STATUS_DELETED => 'Deleted',
        self::STATUS_ACTIVE => 'Active'
    ];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'blame' => [
                'class' => BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['email', 'username'], 'unique'],
            [['department', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findAllActive()
    {
        return self::find()->where('status = :status', [':status' => self::STATUS_ACTIVE])->all();
    }

    /**
     * @param bool $active
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findNonAdmins($active = false)
    {
        $query = self::find()
            ->where('is_admin = 0')
            ->andWhere('is_master_admin = 0');
        if ($active) {
            $query->andWhere('status = :status', [':status' => self::STATUS_ACTIVE]);
        }
        return $query->all();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return (bool)($this->is_admin || $this->is_master_admin);
    }

    /**
     * @return bool
     */
    public function isMasterAdmin()
    {
        return (bool)$this->is_master_admin;
    }

    /**
     * @return bool
     */
    public function isContributor()
    {
        if ($this->isAdmin()) {
            return true;
        }
        return (bool)self::find()
            ->innerJoin('{{%contributor}}', '{{%user}}.id = {{%contributor}}.user_id')
            ->where('{{%user}}.id = :id', [':id' => $this->id])
            ->count();
    }

    /**
     * @return bool
     */
    public function isApprover()
    {
        return (bool)self::find()
            ->innerJoin('{{%approver}}', '{{%user}}.id = {{%approver}}.user_id')
            ->where('{{%user}}.id = :id', [':id' => $this->id])
            ->count();
    }


    /**
     * @return bool
     */
    public function isReviewer()
    {
        return (bool)self::find()
            ->innerJoin('{{%reviewer}}', '{{%user}}.id = {{%reviewer}}.user_id')
            ->where('{{%user}}.id = :id', [':id' => $this->id])
            ->count();
    }

    /**
     * @param $document
     * @return bool
     */
    public function canView($document)
    {
        if ($this->isAdmin()) {
            return true;
        }
        // check user permissions first as they take priority over department permissions
        $userPermission = UserPermission::findType($this->getId(), $document->id);
        if ($userPermission && $userPermission >= Permission::TYPE_VIEW) {
            return true;
        }
        // check department permissions
        $departmentPermission = DepartmentPermission::findType($this->department, $document->id);
        if ($departmentPermission && $departmentPermission >= Permission::TYPE_VIEW) {
            return true;
        }
        return false;
    }

    /**
     * @param $document
     * @return bool
     */
    public function canRead($document)
    {
        if ($this->isAdmin()) {
            return true;
        }
        // check user permissions first as they take priority over department permissions
        $userPermission = UserPermission::findType($this->getId(), $document->id);
        if ($userPermission && $userPermission >= Permission::TYPE_READ) {
            return true;
        }
        // check department permissions
        $departmentPermission = DepartmentPermission::findType($this->department, $document->id);
        if ($departmentPermission && $departmentPermission >= Permission::TYPE_READ) {
            return true;
        }
        return false;
    }

    /**
     * @param $document
     * @return bool
     */
    public function canEdit($document)
    {
        if ($this->isAdmin()) {
            return true;
        }
        // check user permissions first as they take priority over department permissions
        $userPermission = UserPermission::findType($this->getId(), $document->id);
        if ($userPermission && $userPermission >= Permission::TYPE_EDIT) {
            return true;
        }
        // check department permissions
        $departmentPermission = DepartmentPermission::findType($this->department, $document->id);
        if ($departmentPermission && $departmentPermission >= Permission::TYPE_EDIT) {
            return true;
        }
        return false;
    }

    /**
     * @param $document
     * @return bool
     */
    public function canAdmin($document)
    {
        if ($this->isAdmin()) {
            return true;
        }
        // check user permissions first as they take priority over department permissions
        $userPermission = UserPermission::findType($this->getId(), $document->id);
        if ($userPermission && $userPermission == Permission::TYPE_ADMIN) {
            return true;
        }
        // check department permissions
        $departmentPermission = DepartmentPermission::findType($this->department, $document->id);
        if ($departmentPermission && $departmentPermission == Permission::TYPE_ADMIN) {
            return true;
        }
        return false;
    }

    /**
     * @param $document
     * @return bool
     */
    public function canReview($document)
    {
        if ($this->isAdmin()) {
            return true;
        }
        return (bool)count(Reviewer::getForDepartment($document->department, $this->getId()));
    }

    /**
     * @param $document
     * @return bool
     */
    public function canApprove($document)
    {
        if ($this->isAdmin()) {
            return true;
        }
        return (bool)count(Approver::getForDepartment($document->department, $this->getId()));
    }
}
