<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


class ControllerGenerator extends BaseGenerator
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

        $templatePath = $this->customTemplate ?: __DIR__."/template/controller.blade.php";

        $paramColumns = array_diff($tableColumns, ["id", "created_at", "updated_at"]);

        $paramStrings = collect($paramColumns)->map(function($item){
            return "$".lcfirst(camel_case($item));
        })->toArray();

        $data = [
            "group"         => $this->group,
            "module"        => $module,
            "model"         => $model,
            "paramStrings"  => $paramStrings,
            "tableColumns"  => $paramColumns
        ];

        $view =  View::file($templatePath, $data);

        $filePath = $this->customFile ?: ucfirst($this->group)."/".ucfirst($module)."Controller";
        $filePath = "Http/Controllers/".$filePath.".php";

        if(!is_dir(app_path("Http/Controllers/".ucfirst($this->group))))
        {
            mkdir(app_path("Http/Controllers/".ucfirst($this->group)));
        }

        if(!file_exists(app_path($filePath)))
        {
            file_put_contents(app_path($filePath), "<?php \n\n" . $view->render());
        }else{
            if($this->mode == "overwrite")
            {
                file_put_contents(app_path($filePath), "<?php \n\n" . $view->render());
            }

            if($this->mode == "append")
            {
                $this->append($filePath, $data);
            }
        }

        if(!file_exists(app_path("Http/Controllers/BaseController.php")))
        {
            $view = View::file(__DIR__."/template/base_controller.blade.php", []);
            file_put_contents(app_path("Http/Controllers/BaseController.php"), "<?php \n\n" . $view->render());
        }
    }

    /**
     * 追加内容
     * @author nash.tang <112614251@qq.com>
     *
     * @param $filePath
     * @param $data
     */
    protected function append($filePath, $data)
    {
        $fileHandle = fopen(app_path($filePath), "r");

        $i = 0;
        $n = 0;

        while(!feof($fileHandle))
        {
            ++$i;
            $line = fgets($fileHandle);
            if(strpos(trim($line), "}") === 0)
            {
                $n = $i;
            }
        }
        fclose($fileHandle);

        $view = View::file(__DIR__."/template/append_controller.blade.php", $data);

        $fp = new \SplFileObject(app_path($filePath), 'r+');
        $fp->seek($n - 1);
        $fp->fwrite("    ".$view->render());
    }
}