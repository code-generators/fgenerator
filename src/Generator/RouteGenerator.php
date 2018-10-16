<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;

use Illuminate\Support\Facades\View;

class RouteGenerator extends BaseGenerator
{
    /**
     * 生成
     * @author nash.tang <112614251@qq.com>
     *
     */
    public function run()
    {
        $templatePath = $this->customTemplate ?: __DIR__."/template/route.blade.php";

        $module  = camel_case($this->module);
        $model   = camel_case($this->model);

        $view =  View::file($templatePath, [
            "group"         => $this->group,
            "module"        => $module,
            "model"         => $model,
        ]);

        $routeFile = file_get_contents(base_path("routes/web.php"));

        if(strpos($routeFile, ucfirst($module)."Controller@".lcfirst($model)."Lists") === false)
        {
            file_put_contents(base_path("routes/web.php"), str_replace("#", "@", $view->render()), FILE_APPEND);
        }
    }
}