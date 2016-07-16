<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%file_format}}".
 *
 * @property integer $id
 * @property string $extension
 * @property integer $created_at
 * @property string $created_by
 *
 * @property File[] $files
 */
class FileFormat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file_format}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extension'], 'required'],
            [['created_at'], 'integer'],
            [['extension'], 'string', 'max' => 4],
            [['created_by'], 'string', 'max' => 255],
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
                'updatedByAttribute' => false
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
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
            'extension' => Yii::t('app', 'Extension'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['file_format' => 'id']);
    }
}
