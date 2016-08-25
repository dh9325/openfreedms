<?php

namespace common\models;

use Yii;
use yii\base\InvalidParamException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $reference_number
 * @property integer $revision_number
 * @property integer $document_category
 * @property integer $department
 * @property integer $workflow
 * @property integer $file
 * @property integer $status
 * @property integer $is_archived
 * @property integer $is_checked_out
 * @property integer $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 *
 * @property DepartmentPermission[] $departmentPermissions
 * @property Department $department0
 * @property DocumentCategory $documentCategory
 * @property File $file0
 * @property Workflow $workflow0
 * @property UserPermission[] $userPermissions
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    public static function findNoDepartmentPermissions($department)
    {
        return self::find()
            ->leftJoin('{{%department_permission}}', '{{%document}}.id = {{%department_permission}}.document_id')
            ->where('{{%department_permission}}.department_id != :id', [':id' => $department])
            ->orWhere('{{%department_permission}}.department_id IS NULL')
            ->all();
    }

    public static function findNoUserPermissions($user)
    {
        return self::find()
            ->leftJoin('{{%user_permission}}', '{{%document}}.id = {{%user_permission}}.document_id')
            ->where('{{%user_permission}}.user_id != :id', [':id' => $user])
            ->orWhere('{{%user_permission}}.user_id IS NULL')
            ->all();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'reference_number',
                    'revision_number',
                    'document_category',
                    'department',
                    'workflow',
                    'file',
                ],
                'required'
            ],
            [
                [
                    'revision_number',
                    'document_category',
                    'department',
                    'workflow',
                    'file',
                    'status',
                    'is_archived',
                    'is_checked_out',
                    'created_at',
                    'updated_at'
                ],
                'integer'
            ],
            [['title', 'reference_number', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['reference_number'], 'unique'],
            [
                ['department'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Department::className(),
                'targetAttribute' => ['department' => 'id']
            ],
            [
                ['document_category'],
                'exist',
                'skipOnError' => true,
                'targetClass' => DocumentCategory::className(),
                'targetAttribute' => ['document_category' => 'id']
            ],
            [
                ['file'],
                'exist',
                'skipOnError' => true,
                'targetClass' => File::className(),
                'targetAttribute' => ['file' => 'id']
            ],
            [
                ['workflow'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Workflow::className(),
                'targetAttribute' => ['workflow' => 'id']
            ],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'reference_number' => Yii::t('app', 'Reference Number'),
            'revision_number' => Yii::t('app', 'Revision Number'),
            'document_category' => Yii::t('app', 'Document Category'),
            'department' => Yii::t('app', 'Department'),
            'workflow' => Yii::t('app', 'Workflow'),
            'file' => Yii::t('app', 'File'),
            'status' => Yii::t('app', 'Status'),
            'is_archived' => Yii::t('app', 'Is Archived'),
            'is_checked_out' => Yii::t('app', 'Is Checked Out'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentPermissions()
    {
        return $this->hasMany(DepartmentPermission::className(), ['document_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentCategory()
    {
        return $this->hasOne(DocumentCategory::className(), ['id' => 'document_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkflow()
    {
        return $this->hasOne(Workflow::className(), ['id' => 'workflow']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPermissions()
    {
        return $this->hasMany(UserPermission::className(), ['document_id' => 'id']);
    }

    public function setStatusOnCreate()
    {
        switch ($this->workflow) {
            case Workflow::TYPE_NO_APPROVAL:
                $this->status = Workflow::STATUS_PUBLISHED;
                break;
            case Workflow::TYPE_ONE_LEVEL_APPROVAL:
            case Workflow::TYPE_TWO_LEVEL_APPROVAL:
                $this->status = Workflow::STATUS_AWAITING_REVIEW;
                break;
            default:
                throw new InvalidParamException('Incorrect workflow - cannot set status');
        }
    }
}
