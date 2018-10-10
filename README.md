# laravel 代码生成器

## 参数

- group 分组 示例 api、admin

- module 模块 示例 member

- model 模型 示例 user 

- type 生成类型 不传则为全部生成
    
    - controller (curd控制器)
    - model (先生成数据表再操作)
    - repository (curd数据操作)
    - view (包含curd所有的视图)

## 使用

```
php artisan fgenerator:run group module model type
```   