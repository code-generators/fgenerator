<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator;

use LifeCode\Fgenerator\Generator\ControllerGenerator;
use LifeCode\Fgenerator\Generator\ModelGenerator;
use LifeCode\Fgenerator\Generator\RepositoryGenerator;
use LifeCode\Fgenerator\Generator\ViewGenerator;

class Fgenerator
{
    /**
     * 生成
     * @author nash.tang <112614251@qq.com>
     *
     * @param $group
     * @param $module
     * @param $model
     * @param string $type
     * @param bool $overwrite
     * @param string $file
     * @param string $customTemplate
     */
    public function run($group, $module, $model, $type = "", $overwrite = false, $file = "", $customTemplate = "")
    {
        switch ($type)
        {
            case "controller":
                $this->generateController($group, $module, $model, $overwrite, $file, $customTemplate);
                break;
            case "model":
                $this->generateModel($group, $module, $model, $overwrite, $file, $customTemplate);
                break;
            case "repository":
                $this->generateRepository($group, $module, $model, $overwrite, $file, $customTemplate);
                break;
            case "view":
                $this->generateView($group, $module, $model, $overwrite, $file, $customTemplate);
                break;
            default:
                $this->generateController($group, $module, $model, $overwrite, $file, $customTemplate);
                $this->generateModel($group, $module, $model, $overwrite, $file, $customTemplate);
                $this->generateRepository($group, $module, $model, $overwrite, $file, $customTemplate);
                $this->generateView($group, $module, $model, $overwrite, $file, $customTemplate);
        }
    }

    /**
     * 生成控制器
     * @author nash.tang <112614251@qq.com>
     *
     * @param $group
     * @param $module
     * @param $model
     * @param $mode
     * @param string $file
     * @param string $customTemplate
     */
    public function generateController($group, $module, $model, $mode, $file = "", $customTemplate = "")
    {
        $generator = new ControllerGenerator($group, $module, $model, $mode, $file, $customTemplate);
        $generator->run();
    }

    /**
     * 生成模型
     * @author nash.tang <112614251@qq.com>
     *
     * @param $group
     * @param $module
     * @param $model
     * @param $mode
     * @param string $file
     * @param string $customTemplate
     */
    public function generateModel($group, $module, $model, $mode, $file = "", $customTemplate = "")
    {
        $generator = new ModelGenerator($group, $module, $model, $mode, $file, $customTemplate);
        $generator->run();
    }

    /**
     * 生成仓库
     * @author nash.tang <112614251@qq.com>
     *
     * @param $group
     * @param $module
     * @param $model
     * @param $mode
     * @param string $file
     * @param string $customTemplate
     */
    public function generateRepository($group, $module, $model, $mode, $file = "", $customTemplate = "")
    {
        $generator = new RepositoryGenerator($group, $module, $model, $mode, $file, $customTemplate);
        $generator->run();
    }

    /**
     * 生成视图
     * @author nash.tang <112614251@qq.com>
     *
     * @param $group
     * @param $module
     * @param $model
     * @param $mode
     * @param string $file
     * @param string $customTemplate
     */
    public function generateView($group, $module, $model, $mode, $file = "", $customTemplate = "")
    {
        $generator = new ViewGenerator($group, $module, $model, $mode, $file, $customTemplate);
        $generator->run();
    }
}