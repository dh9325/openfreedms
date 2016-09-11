OpenFree DMS Software
===============================

OpenFree DMS is a free, open source document management software designed to benefit small and medium 
 sized organisations by providing document management software without excessive charges or a need of hiring
  a team of developers.
 
 Major features:
 -	Minimal dependencies and requirements
 -	Support for multiple languages
 -	Multiple methods of authentication (including LDAP and MySQL)
 -	Email notifications (e.g. when document is added, approved, rejected etc.)
 -	Support for multiple document formats (e.g. PDF, .doc, .xls)
 -	Multiple workflows
 -	Ability to upload a company logo
 -	Ability to customize look and feel of the software (via themes and/or CSS)
 
 Installation:
 - Using Git: run `git clone https://github.com/dh9325/openfreedms.git` and then  `git checkout develop`
 - Download `https://github.com/dh9325/openfreedms/archive/develop.zip` and unzip
 
 Running the application - production:
 - Run `composer install` (NOTE: by default this will initialise the application in production environment)
 - Go to `http://your-configured-domain.com/install` and configure the application
 
 Running the application - development:
 - Change configuration files in `environments/dev`
 - Run `yii init` and choose `development` to initialise the application 

 Dependencies:
 - PHP version min. 5.4
 - Composer
 - FXP Composer Asset Plugin 
 - MySQL database

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
public/                  contains entry script to the application and other public files
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
