<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property string $path
 * @property integer $file_format
 * @property integer $created_at
 * @property string $created_by
 *
 * @property Document[] $documents
 * @property FileFormat $fileFormat
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'file_format'], 'required'],
            [['file_format', 'created_at'], 'integer'],
            [['path', 'created_by'], 'string', 'max' => 255],
            [
                ['file_format'],
                'exist',
                'skipOnError' => true,
                'targetClass' => FileFormat::className(),
                'targetAttribute' => ['file_format' => 'id']
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
            'path' => Yii::t('app', 'Path'),
            'file_format' => Yii::t('app', 'File Format'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['file' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileFormat()
    {
        return $this->hasOne(FileFormat::className(), ['id' => 'file_format']);
    }
}
