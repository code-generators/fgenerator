<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;


use App\Http\Controllers\Controller;

class BaseGenerator extends Controller
{
    protected $group;
    protected $module;
    protected $model;
    protected $customFile;
    protected $customTemplate;

    /**
     * 构造
     * @param $group
     * @param $module
     * @param $model
     * @param $customFile
     * @param string $customTemplate
     */
    public function __construct($group, $module, $model, $customFile, $customTemplate = "")
    {
        $this->group            = $group;
        $this->module           = $module;
        $this->model            = $model;
        $this->customFile       = $customFile;
        $this->customTemplate   = $customTemplate;
    }
}