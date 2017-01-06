<?php

namespace common\models;

use common\interfaces\Permission;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "department_permission".
 *
 * @property integer $id
 * @property integer $department_id
 * @property integer $document_id
 * @property integer $type
 * @property integer $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 *
 * @property Document $document
 * @property Department $department
 */
class DepartmentPermission extends \yii\db\ActiveRecord implements Permission
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department_permission}}';
    }

    /**
     * @param $entity
     * @param $document
     * @return bool|int
     */
    public static function findType($entity, $document)
    {
        /** @var $model self */
        $model = self::find()
            ->where('department_id = :id', [':id' => $entity])
            ->andWhere('document_id = :doc', [':doc' => $document])
            ->one();
        if ($model) {
            return $model->type;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'document_id', 'type'], 'required'],
            [['department_id', 'document_id', 'created_at', 'updated_at', 'type'], 'integer'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
            [
                ['document_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Document::className(),
                'targetAttribute' => ['document_id' => 'id']
            ],
            [
                ['department_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Department::className(),
                'targetAttribute' => ['department_id' => 'id']
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
            'department_id' => Yii::t('app', 'Department ID'),
            'document_id' => Yii::t('app', 'Document ID'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
