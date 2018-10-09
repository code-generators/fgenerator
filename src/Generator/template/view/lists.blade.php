#extends("admin.layouts.admin")

#section("content")
    <div class="layui-fluid">
        <div class="layui-row">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <!--tab标签-->
                    <div class="layui-tab layui-tab-brief">
                        <ul class="layui-tab-title">
                            <li class="layui-this">列表</li>
                            <li class=""><a href="<%route("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.add")%>">添加</a></li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <table class="layui-table">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px;">ID</th>

                                        @foreach($tableColumns as $tableColumn)
<th>{{$tableColumn}}</th>
                                        @endforeach

                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    #foreach(${{lcfirst($model)}}Lists as ${{lcfirst($model)}})
                                        <tr>
                                            <td><%*{{lcfirst($model)}}->id%></td>

                                            @foreach($tableColumns as $tableColumn)
<td><%*{{lcfirst($model)}}->{{$tableColumn}}%></td>
                                            @endforeach

                                            <td><%*{{lcfirst($model)}}->created_at%></td>
                                            <td>
                                                <a href="<%route("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.view", ['id' => *{{lcfirst($model)}}->id])%>"
                                                   class="layui-btn layui-btn-warm layui-btn-xs"
                                                ><i class="layui-icon layui-icon-search"></i> 查看</a>
                                                <a href="<%route("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.edit", ['id' => *{{lcfirst($model)}}->id])%>"
                                                   class="layui-btn layui-btn-normal layui-btn-xs"
                                                ><i class="layui-icon layui-icon-edit"></i> 编辑</a>
                                                <a href="javascript:void(0)"
                                                   class="layui-btn layui-btn-danger layui-btn-xs ajax-delete"
                                                   data="<%*{{lcfirst($model)}}->id%>"
                                                ><i class="layui-icon layui-icon-delete"></i> 删除</a>
                                            </td>
                                        </tr>
                                    #endforeach
                                    </tbody>
                                </table>
                            </div>
                            #if(count(*{{lcfirst($model)}}Lists) > 0)
                                <div class="layui-col-md-offset4"><% *{{lcfirst($model)}}Lists->links() %></div>
                            #endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
#endsection

#section("footer")
    #parent

    <script>
        layui.config({
            base: '/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'form'], function(){
            var * = layui.*
                ,admin = layui.admin
                ,element = layui.element
                ,form = layui.form;

            *(".ajax-delete").click(function(){
                var id = *(this).attr("data");
                layer.confirm("确认删除?",function(){
                    *.ajax({
                        url: "<%route('{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.delete')%>" ,
                        data: {'id':id, '_token': "{{csrf_token()}}"} ,
                        type: "post" ,
                        dataType:'json',
                        success:function(data){
                            if(data.code==1){
                                layer.msg("删除成功");
                                location.reload();
                            }else{
                                layer.msg("删除失败");
                            }
                        }
                    })
                })
            })
        });
    </script>
#endsection