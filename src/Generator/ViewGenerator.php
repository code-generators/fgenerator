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
        $this->makeLayouts($data);
        $this->makeCommon($data);
        $this->makeHome($data);
        $this->makeLogin($data);

        //列表视图
        $listsFilePath      = "views/".$this->group."/".$this->module."/".$this->model."_lists.blade.php";
        $listsTemplatePath  = $this->customTemplate ?: __DIR__."/template/view/lists.blade.php";

        $this->make($listsFilePath, $listsTemplatePath, $data);

        //创建视图
        $addFilePath        = "views/".$this->group."/".$this->module."/add_".$this->model.".blade.php";
        $addTemplatePath    = $this->customTemplate ?: __DIR__."/template/view/add.blade.php";

        $this->make($addFilePath, $addTemplatePath, $data);

        //编辑视图
        $editFilePath       = "views/".$this->group."/".$this->module."/edit_".$this->model.".blade.php";
        $editTemplatePath   = $this->customTemplate ?: __DIR__."/template/view/edit.blade.php";

        $this->make($editFilePath, $editTemplatePath, $data);

        //查看视图
        $viewFilePath       = "views/".$this->group."/".$this->module."/view_".$this->model.".blade.php";
        $viewTemplatePath   = $this->customTemplate ?: __DIR__."/template/view/view.blade.php";

        $this->make($viewFilePath, $viewTemplatePath, $data);
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

        if(!is_dir(resource_path("views/".$this->group."/layouts")))
        {
            mkdir(resource_path("views/".$this->group."/layouts"));
        }

        if(!is_dir(resource_path("views/".$this->group."/common")))
        {
            mkdir(resource_path("views/".$this->group."/common"));
        }

        if(!is_dir(resource_path("views/".$this->group."/home")))
        {
            mkdir(resource_path("views/".$this->group."/home"));
        }
    }

    /**
     * 生成布局文件
     * @author nash.tang <112614251@qq.com>
     * @param $data
     */
    public function makeLayouts($data)
    {
        $layoutsFilePath     = "views/".$this->group."/layouts/".$this->group.".blade.php";
        $layoutsTemplatePath = $this->customTemplate ?: __DIR__."/template/view/layouts.blade.php";

        $this->make($layoutsFilePath, $layoutsTemplatePath, $data);
    }

    /**
     * 生成公共模板文件
     * @author nash.tang <112614251@qq.com>
     * @param $data
     */
    public function makeCommon($data)
    {
        //头部
        $headerFilePath     = "views/".$this->group."/common/header.blade.php";
        $headerTemplatePath = $this->customTemplate ?: __DIR__."/template/view/header.blade.php";

        $this->make($headerFilePath, $headerTemplatePath, $data);

        //底部
        $footerFilePath     = "views/".$this->group."/common/footer.blade.php";
        $footerTemplatePath = $this->customTemplate ?: __DIR__."/template/view/footer.blade.php";

        $this->make($footerFilePath, $footerTemplatePath, $data);

        //导航
        $navFilePath     = "views/".$this->group."/common/nav.blade.php";
        $navTemplatePath = $this->customTemplate ?: __DIR__."/template/view/nav.blade.php";

        $this->make($navFilePath, $navTemplatePath, $data);

        //菜单
        $menuFilePath     = "views/".$this->group."/common/menu.blade.php";
        $menuTemplatePath = $this->customTemplate ?: __DIR__."/template/view/menu.blade.php";

        $this->make($menuFilePath, $menuTemplatePath, $data);
    }

    /**
     * 生成首页
     * @author nash.tang <112614251@qq.com>
     * @param $data
     */
    public function makeHome($data)
    {
        $homeFilePath     = "views/".$this->group."/home/index.blade.php";
        $homeTemplatePath = $this->customTemplate ?: __DIR__."/template/view/index.blade.php";

        $this->make($homeFilePath, $homeTemplatePath, $data);
    }

    /**
     * 生成登录页
     * @author nash.tang <112614251@qq.com>
     * @param $data
     */
    public function makeLogin($data)
    {
        $loginFilePath     = "views/".$this->group."/home/login.blade.php";
        $loginTemplatePath = $this->customTemplate ?: __DIR__."/template/view/login.blade.php";

        $this->make($loginFilePath, $loginTemplatePath, $data);
    }
}