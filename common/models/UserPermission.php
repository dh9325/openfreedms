<?php

namespace common\models;

use common\interfaces\Permission;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_permission".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $document_id
 * @property integer $type
 * @property integer $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 *
 * @property Document $document
 * @property User $user
 */
class UserPermission extends \yii\db\ActiveRecord implements Permission
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_permission}}';
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
            ->where('user_id = :id', [':id' => $entity])
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
            [['user_id', 'document_id', 'type'], 'required'],
            [['user_id', 'document_id', 'created_at', 'updated_at', 'type'], 'integer'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
            [
                ['document_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Document::className(),
                'targetAttribute' => ['document_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
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
            'user_id' => Yii::t('app', 'User ID'),
            'document_id' => Yii::t('app', 'Document ID'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
