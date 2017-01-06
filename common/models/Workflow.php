<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "workflow".
 *
 * @property integer $id
 * @property integer $steps
 * @property integer $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 */
class Workflow extends \yii\db\ActiveRecord
{
    const TYPE_NO_APPROVAL = 1;
    const TYPE_ONE_LEVEL_APPROVAL = 2;
    const TYPE_TWO_LEVEL_APPROVAL = 3;

    const STATUS_PUBLISHED = 1;
    const STATUS_AWAITING_REVIEW = 2;
    const STATUS_REJECTED = 3;
    const STATUS_AWAITING_APPROVAL = 4;
    const STATUS_DISAPPROVED = 5;


    public static $workflows = [
        // todo: translate
        self::TYPE_NO_APPROVAL => 'No Approval',
        self::TYPE_ONE_LEVEL_APPROVAL => 'One Level Approval',
        self::TYPE_TWO_LEVEL_APPROVAL => 'Two Level Approval'
    ];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%workflow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['steps', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['steps', 'created_at', 'updated_at'], 'integer'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
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
            'steps' => Yii::t('app', 'Steps'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
