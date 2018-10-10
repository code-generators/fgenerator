<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class RepositoryGenerator extends BaseGenerator
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

        $tableColumns = $tableName != "" ? Schema::getColumnListing($tableName) : [];

        $module  = camel_case($this->module);
        $model   = camel_case($this->model);

        $templatePath = $this->customTemplate ?: __DIR__."/template/repository.blade.php";

        $paramColumns = array_diff($tableColumns, ["id", "created_at", "updated_at"]);

        $paramStrings = collect($paramColumns)->map(function($item){
            return "$".lcfirst(camel_case($item));
        })->toArray();

        $view =  View::file($templatePath, [
            "group"         => $this->group,
            "module"        => $module,
            "model"         => $model,
            "paramStrings"  => $paramStrings,
            "tableColumns"  => $paramColumns
        ]);

        $filePath = "Repositories/".ucfirst($model)."Repository.php";

        if(!is_dir(app_path("Repositories/")))
        {
            mkdir(app_path("Repositories/"));
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