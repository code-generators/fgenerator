<?php
/**
 * Created by nash.tang.
 * User: nash.tang <112614251@qq.com>
 */

namespace LifeCode\Fgenerator\Generator;

use Illuminate\Support\Facades\Schema;

class ViewGenerator extends BaseGenerator
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

        $this->makeDir();

        //列表视图
        $listsFilePath      = "views/".$this->group."/".$this->module."/".$this->model."_lists.blade.php";
        $listsTemplatePath  = $this->customTemplate ?: __DIR__."/template/view/lists.blade.php";

        $this->makeView($listsFilePath, $listsTemplatePath, $data);

        //创建视图
        $addFilePath        = "views/".$this->group."/".$this->module."/add_".$this->model.".blade.php";
        $addTemplatePath    = $this->customTemplate ?: __DIR__."/template/view/add.blade.php";

        $this->makeView($addFilePath, $addTemplatePath, $data);

        //编辑视图
        $editFilePath       = "views/".$this->group."/".$this->module."/edit_".$this->model.".blade.php";
        $editTemplatePath   = $this->customTemplate ?: __DIR__."/template/view/edit.blade.php";

        $this->makeView($editFilePath, $editTemplatePath, $data);

        //查看视图
        $viewFilePath       = "views/".$this->group."/".$this->module."/view_".$this->model.".blade.php";
        $viewTemplatePath   = $this->customTemplate ?: __DIR__."/template/view/view.blade.php";

        $this->makeView($viewFilePath, $viewTemplatePath, $data);
    }

    /**
     * 生成所有视图目录
     * @author nash.tang <112614251@qq.com>
     *
     */
    public function makeDir()
    {
        if(!is_dir(resource_path("views/".$this->group)))
        {
            mkdir(resource_path("views/".$this->group));
        }

        if(!is_dir(resource_path("views/".$this->group."/".$this->module)))
        {
            mkdir(resource_path("views/".$this->group."/".$this->module));
        }
    }
}