OpenFree DMS Software
===============================



OpenFree DMS is based on Yii 2 Advanced Project Template [Yii 2](http://www.yiiframework.com/).

DIRECTORY STRUCTURE
-------------------

```
common
    assets/              contains application's assets
    oomponents/          contains application's components
    config/              contains shared configurations
    interfaces/          contains interfaces
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    traits/              contains traits
    widgets/             contains widgets
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
modules
    admin/
        controllers/     contains Web controller classes
        views/           contains view files for admin module
    install/
        components/      contains module's components
        controllers/     contains Web controller classes
        models/          contains frontend-specific model classes
        views/           contains view files for the Web application
    user/
        controllers/     contains Web controller classes
        views/           contains view files for user module
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
