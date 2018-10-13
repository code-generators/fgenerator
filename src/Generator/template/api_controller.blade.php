namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\{{ucfirst($model)}}Repository;
use Illuminate\Http\Request;

class {{ucfirst($module)}}Controller extends BaseController
{
    /**
     * 列表
     * @author
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function {{lcfirst($model)}}Lists()
    {
        ${{lcfirst($model)}}Lists = {{ucfirst($model)}}Repository::getListsByPaginate();
        return $this->apiSuccess([
            'lists' => ${{lcfirst($model)}}Lists
        ]);
    }

    /**
     * 查看
     * @author
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view{{ucfirst($model)}}($id)
    {
        ${{lcfirst($model)}} = {{ucfirst($model)}}Repository::findOneById($id);
        if(${{lcfirst($model)}})
        {
            return $this->apiSuccess([
                'info' => ${{lcfirst($model)}}
            ]);
        }else{
            return $this->apiFail("记录不存在");
        }
    }

    /**
     * 创建
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function add{{ucfirst($model)}}(Request $request)
    {
        if($request->isMethod('post'))
        {
            //验证提交的数据
            $validator = \Validator::make($request->all(), [
            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
    '{{$tableColumn}}' => 'required',
            @endforeach @else    'field' => 'required',@endif

            ], [
            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
    '{{$tableColumn}}.required' => '{{$tableColumn}}不能为空',
            @endforeach @else    'field.required' => 'field不能为空',@endif

            ]);
            if ($validator->fails()) {
                return $this->apiFail($validator->errors()->first());
            }

            $field = $request->input("field");
            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
${{lcfirst(camel_case($tableColumn))}} = $request->input("{{$tableColumn}}");
            @endforeach @endif

            if({{ucfirst($model)}}Repository::findOneByField($field))
            {
                return $this->apiFail("记录已存在");
            }

            @if(count($tableColumns) > 0)
${{lcfirst($model)}} = {{ucfirst($model)}}Repository::save({{implode(", ", $paramStrings)}});
            @else
${{lcfirst($model)}} = {{ucfirst($model)}}Repository::save($field);
            @endif
if(${{lcfirst($model)}})
            {
                return $this->apiSuccess(${{lcfirst($model)}}, '添加成功');
            }else{
                return $this->apiFail("添加失败");
            }
        }
    }

    /**
     * 编辑
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit{{ucfirst($model)}}(Request $request)
    {
        if($request->isMethod('post'))
        {
            //验证提交的数据
            $validator = \Validator::make($request->all(), [
                'id' => 'required',
            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
    '{{$tableColumn}}' => 'required',
            @endforeach @else    'field' => 'required',@endif

            ], [
                'id.required' => 'id不能为空',
            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
    '{{$tableColumn}}.required' => '{{$tableColumn}}不能为空',
            @endforeach @else    'field.required' => 'field不能为空',@endif

            ]);
            if ($validator->fails()) {
                return $this->apiFail($validator->errors()->first());
            }

            $id = $request->input("id");
            $field = $request->input("field");
            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
${{lcfirst(camel_case($tableColumn))}} = $request->input("{{$tableColumn}}");
            @endforeach @endif

            ${{lcfirst($model)}} = {{ucfirst($model)}}Repository::findOneByField($field);
            if(${{lcfirst($model)}} && ${{lcfirst($model)}}->id != $id)
            {
                return $this->apiFail("记录已存在");
            }

            @if(count($tableColumns) > 0)
${{lcfirst($model)}} = {{ucfirst($model)}}Repository::update($id, {{implode(", ", $paramStrings)}});
            @else
${{lcfirst($model)}} = {{ucfirst($model)}}Repository::update($id, $field);
            @endif

            if(${{lcfirst($model)}})
            {
                return $this->apiSuccess(${{lcfirst($model)}}, '更新成功');
            }else{
                return $this->apiFail("更新失败");
            }
        }
    }

    /**
     * 删除
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete{{ucfirst($model)}}(Request $request)
    {
        //验证提交的数据
        $validator = \Validator::make($request->all(), [
            'id'               => 'required',
        ], [
            'id.required'      => 'id不能为空',
        ]);

        if ($validator->fails()) {
            return $this->apiFail($validator->errors()->first());
        }

        $id = $request->input('id');

        if({{ucfirst($model)}}Repository::delete($id))
        {
            return $this->apiSuccess('', '删除成功');
        }else{
            return $this->apiFail("删除失败");
        }
    }

}
