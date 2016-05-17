MenuBundle
===========

MenuBundle 基于 "knplabs/knp-menu-bundle" 进行菜单数据库存储

介绍
------------

### Composer

添加 `composer.json` 到你的项目依赖
```json
{
    "foreverglory/menu-bundle": "dev-master"
}
```
### Kernel

添加 `Kernel` 依赖，并启用 `Bundle`
```php
//app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        new Glory\Bundle\MenuBundle\GloryMenuBundle(),
        // ...
    );
}
```

### KnpMenuBundle 
@see http://symfony.com/doc/master/bundles/KnpMenuBundle/index.html
