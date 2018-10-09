namespace App\Repositories;

use App\Models\{{ucfirst($model)}};

class {{ucfirst($model)}}Repository
{
    /**
     * 获取带分页的列表
     * @author
     *
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getListsByPaginate($page = 15)
    {
        return {{ucfirst($model)}}::orderBy("created_at", "desc")->paginate($page);
    }

    /**
    * 获取不带分页的列表
    * @author
    *
    */
    public static function getLists()
    {
        return {{ucfirst($model)}}::orderBy("created_at", "desc")->get();
    }

    /**
     * 根据ID查找一条记录
     * @author
     *
     * @param $id
     * @return mixed|static
     */
    public static function findOneById($id)
    {
        return {{ucfirst($model)}}::find($id);
    }

    /**
    * 根据field查找一条记录
    * @author
    *
    * @param $field
    * @return mixed|static
    */
    public static function findOneByField($field)
    {
        return {{ucfirst($model)}}::where(["field" => $field])->first();
    }

    /**
     * 保存一条记录
     * @author
     @foreach($paramStrings as $paramString)
* @param {{$paramString}}
     @endforeach
* @return {{ucfirst($model)}}|bool
    */
    public static function save({{implode(", ", $paramStrings)}})
    {
        ${{lcfirst($model)}} = new {{ucfirst($model)}}();

        @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
${{lcfirst($model)}}->{{$tableColumn}} = ${{lcfirst(camel_case($tableColumn))}};
        @endforeach @endif

        $res = ${{lcfirst($model)}}->save();

        if($res)
        {
            return ${{lcfirst($model)}};
        }else{
            return false;
        }
    }

    /**
     * 更新一条记录
     * @author
     *
     * @param $id
     @foreach($paramStrings as $paramString)
* @param {{$paramString}}
     @endforeach
* @return {{ucfirst($model)}}Repository|bool|mixed
     */
    public static function update($id, {{implode(", ", $paramStrings)}})
    {
        ${{lcfirst($model)}} = self::findOneById($id);

        if(${{lcfirst($model)}})
        {

            @if(count($tableColumns) > 0)@foreach($tableColumns as $tableColumn)
${{lcfirst($model)}}->{{$tableColumn}} = ${{lcfirst(camel_case($tableColumn))}};
            @endforeach @endif

            $res = ${{lcfirst($model)}}->save();

            if($res)
            {
                return ${{lcfirst($model)}};
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    /**
     * 删除一条记录
     * @author
     *
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        ${{lcfirst($model)}} = self::findOneById($id);

        if(${{lcfirst($model)}})
        {
            $res = ${{lcfirst($model)}}->delete();

            if($res)
            {
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }
}