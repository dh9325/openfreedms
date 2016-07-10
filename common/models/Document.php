<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property string $title
 * @property string $reference_number
 * @property integer $revision_number
 * @property integer $status
 * @property integer $is_archived
 * @property integer $is_checked_out
 * @property integer $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 *
 * @property DepartmentPermission[] $departmentPermissions
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
                    'status',
                    'is_archived',
                    'is_checked_out',
                    'created_at',
                    'created_by',
                    'updated_at',
                    'updated_by'
                ],
                'required'
            ],
            [['revision_number', 'status', 'is_archived', 'is_checked_out', 'created_at', 'updated_at'], 'integer'],
            [['title', 'reference_number', 'created_by', 'updated_by'], 'string', 'max' => 255],
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
    public function getUserPermissions()
    {
        return $this->hasMany(UserPermission::className(), ['document_id' => 'id']);
    }
}
