<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%system}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $theme
 * @property string $language
 * @property string $authentication
 * @property string $data_path
 * @property string $revision_path
 */
class System extends \yii\db\ActiveRecord
{
    const THEME_CERULEAN = 'Cerulean';
    const THEME_COSMO = 'Cosmo';
    const THEME_CYBORG = 'Cyborg';
    const THEME_DARKLY = 'Darkly';
    const THEME_DEFAULT = 'Default';
    const THEME_FLATLY = 'Flatly';
    const THEME_JOURNAL = 'Journal';
    const THEME_LUMEN = 'Lumen';
    const THEME_PAPER = 'Paper';
    const THEME_READABLE = 'Readable';
    const THEME_SANDSTONE = 'Sandstone';
    const THEME_SIMPLEX = 'Simples';
    const THEME_SLATE = 'Slate';
    const THEME_SPACELAB = 'Spacelab';
    const THEME_SUPERHERO = 'Superhero';
    const THEME_UNITED = 'United';
    const THEME_YETI = 'Yeti';

    const AUTH_METHOD_SQL = 'SQL';
    const AUTH_METHODS_LDAP = 'LDAP';

    const DEFAULT_DATA_PATH = '@app/data/';
    const DEFAULT_DATA_REVISION_PATH = '@app/data/revision/';

    const DEFAULT_LOCALE = 'en-GB';
    const LOCALE_PL_PL = 'pl-PL';

    public static $themes = [
        self::THEME_CERULEAN => self::THEME_CERULEAN,
        self::THEME_COSMO => self::THEME_COSMO,
        self::THEME_CYBORG => self::THEME_CYBORG,
        self::THEME_DARKLY => self::THEME_DARKLY,
        self::THEME_DEFAULT => self::THEME_DEFAULT,
        self::THEME_FLATLY => self::THEME_FLATLY,
        self::THEME_JOURNAL => self::THEME_JOURNAL,
        self::THEME_LUMEN => self::THEME_LUMEN,
        self::THEME_PAPER => self::THEME_PAPER,
        self::THEME_READABLE => self::THEME_READABLE,
        self::THEME_SANDSTONE => self::THEME_SANDSTONE,
        self::THEME_SIMPLEX => self::THEME_SIMPLEX,
        self::THEME_SLATE => self::THEME_SLATE,
        self::THEME_SPACELAB => self::THEME_SPACELAB,
        self::THEME_SUPERHERO => self::THEME_SUPERHERO,
        self::THEME_UNITED => self::THEME_UNITED,
        self::THEME_YETI => self::THEME_YETI,
    ];

    public static $authMethods = [
        self::AUTH_METHOD_SQL => self::AUTH_METHOD_SQL,
        self::AUTH_METHODS_LDAP => self::AUTH_METHODS_LDAP
    ];

    public static $availableLanguages = [
        self::LOCALE_PL_PL => 'Polish / Polski'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system}}';
    }

    /**
     * @return bool|mixed
     */
    public static function getTheme()
    {
        $row = self::find()->one();
        if ($row) {
            return $row->theme;
        } else {
            return false;
        }
    }

    public static function getLanguage()
    {
        $row = self::find()->one();
        if ($row) {
            return $row->language;
        } else {
            return self::DEFAULT_LOCALE;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['name', 'logo', 'theme', 'language', 'authentication', 'data_path', 'revision_path'],
                'string',
                'max' => 255
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'logo' => Yii::t('app', 'Logo'),
            'theme' => Yii::t('app', 'Theme'),
            'language' => Yii::t('app', 'Language'),
            'authentication' => Yii::t('app', 'Authentication'),
            'data_path' => Yii::t('app', 'Data Path'),
            'revision_path' => Yii::t('app', 'Revision Path'),
        ];
    }
}
