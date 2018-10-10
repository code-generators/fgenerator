<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ModelGenerator extends BaseGenerator
{
    /**
     * 生成
     * @author nash.tang <112614251@qq.com>
     *
     */
    public function run()
    {
        if(Schema::hasTable(strtolower($this->model)))
        {
            $tableName = strtolower($this->model);
        }elseif(Schema::hasTable(strtolower($this->model)."s")) {
            $tableName = strtolower($this->model."s");
        }else{
            $tableName = "";
        }

        $module  = camel_case($this->module);
        $model   = camel_case($this->model);

        $templatePath = $this->customTemplate ?: __DIR__."/template/model.blade.php";

        $view =  View::file($templatePath, [
            "group"         => $this->group,
            "module"        => $module,
            "model"         => $model,
            "tableName"     => $tableName,
            "primaryKey"    => "id"
        ]);

        $filePath = "Models/".ucfirst($model).".php";

        if(!is_dir(app_path("Models/")))
        {
            mkdir(app_path("Models/"));
        }

        if(!file_exists(app_path($filePath)))
        {
            file_put_contents(app_path($filePath), "<?php \n\n" . $view->render());
        }else{
            if($this->mode == "overwrite")
            {
                file_put_contents(app_path($filePath), "<?php \n\n" . $view->render());
            }
        }
    }
}