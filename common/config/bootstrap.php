<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/modules');
Yii::setAlias('@user', dirname(dirname(__DIR__)) . '/modules/user');
Yii::setAlias('@admin', dirname(dirname(__DIR__)) . '/modules/admin');
Yii::setAlias('@install', dirname(dirname(__DIR__)) . '/modules/install');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@webroot', dirname(dirname(__DIR__)) . '/public');
Yii::setAlias('@app', dirname(dirname(__DIR__)));
