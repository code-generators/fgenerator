# 用于生成laravel代码

## 参数

- group 分组

- module 模块

- model 模型

- type 生成类型 不传则为全部生成
    
    - controller (curd控制器)
    - model (先生成数据库再操作)
    - repository (curd数据操作)
    - view (包含curd所有的视图)

## 使用

```
php artisan fgenerator:run group module model type
```   