# laravel 代码生成器

## 截图

暂无

## 安装

- 引入扩展包

```bash
composer require "lifecode/fgenerator"
```

## 使用

- group 分组 示例 api、admin

- module 模块 示例 member

- model 模型 示例 user 

- type 生成类型 不传则为全部生成
    
    - controller (module下的model操作curd的控制器)
    - model (先生成数据表再操作)
    - repository (model下的curd数据操作封装)
    - view (包含lists view add edit 视图)
    
- mode 模式 default 默认模式(如果文件存在则跳过)、 overwrite 覆盖模式(慎用)、 append 追加模式(用于controller追加)

- output 输出方式 api(接口模式)、 view(视图模式 默认)

## 运行

```
php artisan fgenerator:run group module model type --mode=append --ouput=api
```   