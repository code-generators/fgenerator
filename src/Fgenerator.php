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
     * @param string $mode
     * @param string $output
     * @param string $file
     * @param string $customTemplate
     */
    public function run($group, $module, $model, $type = "", $mode = "default", $output = "view", $file = "", $customTemplate = "")
    {
        switch ($type)
        {
            case "controller":
                $this->generateController($group, $module, $model, $mode, $output, $file, $customTemplate);
                break;
            case "model":
                $this->generateModel($group, $module, $model, $mode, $output, $file, $customTemplate);
                break;
            case "repository":
                $this->generateRepository($group, $module, $model, $mode, $output, $file, $customTemplate);
                break;
            case "view":
                $this->generateView($group, $module, $model, $mode, $output, $file, $customTemplate);
                break;
            default:
                $this->generateController($group, $module, $model, $mode, $output, $file, $customTemplate);
                $this->generateModel($group, $module, $model, $mode, $output, $file, $customTemplate);
                $this->generateRepository($group, $module, $model, $mode, $output, $file, $customTemplate);
                $this->generateView($group, $module, $model, $mode, $output, $file, $customTemplate);
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
     * @param $output
     * @param string $file
     * @param string $customTemplate
     */
    public function generateController($group, $module, $model, $mode, $output, $file = "", $customTemplate = "")
    {
        $generator = new ControllerGenerator($group, $module, $model, $mode, $output, $file, $customTemplate);
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
     * @param $output
     * @param string $file
     * @param string $customTemplate
     */
    public function generateModel($group, $module, $model, $mode, $output, $file = "", $customTemplate = "")
    {
        $generator = new ModelGenerator($group, $module, $model, $mode, $output, $file, $customTemplate);
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
     * @param $output
     * @param string $file
     * @param string $customTemplate
     */
    public function generateRepository($group, $module, $model, $mode, $output, $file = "", $customTemplate = "")
    {
        $generator = new RepositoryGenerator($group, $module, $model, $mode, $output, $file, $customTemplate);
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
     * @param $output
     * @param string $file
     * @param string $customTemplate
     */
    public function generateView($group, $module, $model, $mode, $output, $file = "", $customTemplate = "")
    {
        if($output != "api")
        {
            $generator = new ViewGenerator($group, $module, $model, $mode, $output, $file, $customTemplate);
            $generator->run();
        }
    }
}