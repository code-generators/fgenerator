<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseGenerator extends Controller
{
    protected $group;
    protected $module;
    protected $model;
    protected $mode;
    protected $customFile;
    protected $customTemplate;

    /**
     * 构造
     * @param $group
     * @param $module
     * @param $model
     * @param $mode
     * @param $customFile
     * @param string $customTemplate
     */
    public function __construct($group, $module, $model, $mode, $customFile, $customTemplate = "")
    {
        $this->group            = $group;
        $this->module           = $module;
        $this->model            = $model;
        $this->mode             = $mode;
        $this->customFile       = $customFile;
        $this->customTemplate   = $customTemplate;
    }

    /**
     * 生成模板
     * @author nash.tang <112614251@qq.com>
     *
     * @param $filePath
     * @param $templatePath
     * @param $data
     */
    public function makeView($filePath, $templatePath, $data)
    {
        if(!file_exists(resource_path($filePath)))
        {
            $view =  View::file($templatePath, $data);
            file_put_contents(resource_path($filePath), str_replace(["<%", "%>", "#", "*"], ["{{", "}}", "@", "$"], $view->render()));
        }else{
            if($this->mode == "overwrite")
            {
                $view =  View::file($templatePath, $data);
                file_put_contents(resource_path($filePath), str_replace(["<%", "%>", "#", "*"], ["{{", "}}", "@", "$"], $view->render()));
            }
        }
    }
}