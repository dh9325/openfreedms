<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%system}}".
 *
 * @property string $logo
 * @property string $theme
 * @property string $language
 * @property string $authentication
 */
class System extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logo'], 'required'],
            [['logo', 'theme', 'language', 'authentication'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'logo' => Yii::t('app', 'Logo'),
            'theme' => Yii::t('app', 'Theme'),
            'language' => Yii::t('app', 'Language'),
            'authentication' => Yii::t('app', 'Authentication'),
        ];
    }
}
