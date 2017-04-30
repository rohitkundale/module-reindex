# Magento 2 Reindex Module #

## Installation

Log in to the Magento server, go to your Magento install directory and run following commands:
```
composer require rpmkhatri/module-reindex

php -f bin/magento module:enable RohitKundale_Reindex
php -f bin/magento setup:upgrade

rm -rf pub/static/*; rm -rf var/view_preprocessed/*;
php -f bin/magento setup:static-content:deploy
```

## Screenshots
### Magento2 Reindex
![](https://rohitkundale.files.wordpress.com/2017/04/magento-2-reindex-from-backend-ui.gif)

