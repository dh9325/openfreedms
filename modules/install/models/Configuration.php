<?php

namespace modules\install\models;

use Yii;
use yii\base\Model;

class Configuration extends Model
{
    const PLACEHOLDER_HOST = '{{host}}';
    const PLACEHOLDER_DB_NAME = '{{dbname}}';
    const PLACEHOLDER_USERNAME = '{{username}}';
    const PLACEHOLDER_PASSWORD = '{{password}}';
    const PLACEHOLDER_MASTER_ADMIN_USERNAME = '{{masterAdminUsername}}';
    const PLACEHOLDER_MASTER_ADMIN_PASSWORD = '{{masterAdminPassword}}';
    const PLACEHOLDER_MASTER_ADMIN_EMAIL = '{{email}}';
    const PLACEHOLDER_MASTER_ADMIN_DEPARTMENT = '{{department}}';

    public $host;
    public $databaseName;
    public $username;
    public $password;
    public $masterAdminUsername;
    public $masterAdminPassword;
    public $masterAdminEmail;
    public $department;

    protected $configured = false;

    public function rules()
    {
        return [
            [
                [
                    'host',
                    'databaseName',
                    'username',
                    'password',
                    'masterAdminUsername',
                    'masterAdminPassword',
                    'masterAdminEmail',
                    'department'
                ],
                'required'
            ],
            [['host', 'department'], 'string'],
            [['username', 'password'], 'string', 'max' => 16],
            [['masterAdminUsername', 'masterAdminPassword'], 'string', 'max' => 16],
            [['masterAdminEmail'], 'email'],
            [['databaseName'], 'match', 'pattern' => '/^[a-z0-9\_\-]{1,64}$/i']
        ];
    }

    public function attributeLabels()
    {
        return [
            'host' => Yii::t('install', 'Host'),
            'databaseName' => Yii::t('install', 'Database Name'),
            'username' => Yii::t('install', 'Username'),
            'password' => Yii::t('install', 'Password'),
        ];
    }

    public static function get()
    {
        try {
            // get config details using user module
            $db = Yii::$app->getComponents()['db'];
            $instance = new self;
            // explode dsn to get host and db name
            $tempArr = explode(';', $db['dsn']);
            $host = str_replace('mysql:host=', '', $tempArr[0]);
            $dbname = str_replace('dbname=', '', $tempArr[1]);
            $password = $db['password'];
            $username = $db['password'];
            if ($host != self::PLACEHOLDER_HOST && $dbname != self::PLACEHOLDER_DB_NAME && $password != self::PLACEHOLDER_PASSWORD && $username != self::PLACEHOLDER_USERNAME) {
                $instance->host = $host;
                $instance->databaseName = $dbname;
                $instance->username = $username;
                $instance->password = $password;
                $instance->configured = true;
            }
            return $instance;
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
        }
    }

    public function isConfigured()
    {
        return $this->configured;
    }

    /**
     * @return bool
     */
    public function saveConfiguration()
    {
        try {
            // grab main-local config and override the placeholders
            $file = Yii::getAlias('@app/common/config/main-local.php');
            $config = file_get_contents($file);
            $config = str_replace(self::PLACEHOLDER_HOST, $this->host, $config);
            $config = str_replace(self::PLACEHOLDER_DB_NAME, $this->databaseName, $config);
            $config = str_replace(self::PLACEHOLDER_USERNAME, $this->username, $config);
            $config = str_replace(self::PLACEHOLDER_PASSWORD, $this->password, $config);
            $commonConfig = (bool)file_put_contents($file, $config);
            // grab console main-local to override the placeholders
            $file = Yii::getAlias('@app/console/config/main-local.php');
            $config = file_get_contents($file);
            $config = str_replace(self::PLACEHOLDER_MASTER_ADMIN_USERNAME, $this->masterAdminUsername, $config);
            $config = str_replace(self::PLACEHOLDER_MASTER_ADMIN_PASSWORD, $this->masterAdminPassword, $config);
            $config = str_replace(self::PLACEHOLDER_MASTER_ADMIN_EMAIL, $this->masterAdminEmail, $config);
            $config = str_replace(self::PLACEHOLDER_MASTER_ADMIN_DEPARTMENT, $this->department, $config);
            $consoleConfig = (bool)file_put_contents($file, $config);
            if ($commonConfig && $consoleConfig) {
                $this->configured = true;
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return false;
        }
    }

}