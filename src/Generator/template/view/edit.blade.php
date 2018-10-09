#extends("admin.layouts.admin")

#section("content")
    <div class="layui-fluid">
        <div class="layui-row">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <!--tab标签-->
                    <div class="layui-tab layui-tab-brief">
                        <ul class="layui-tab-title">
                            <li class=""><a href="<%route("{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.lists")%>">列表</a></li>
                            <li class="layui-this">编辑</li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <form class="layui-form form-container" action="">
                                    <input type="hidden" value="<%*{{lcfirst($model)}}->id%>" name="id">

                                    @foreach($tableColumns as $tableColumn)
<div class="layui-form-item">
                                        <label class="layui-form-label">{{$tableColumn}}</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="{{$tableColumn}}" value="<%*{{lcfirst($model)}}->{{$tableColumn}}%>" required lay-verify="required" placeholder="请输入{{$tableColumn}}" class="layui-input">
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="layui-form-item">
                                        <div class="layui-input-block">
                                            <button class="layui-btn" lay-submit lay-filter="add">保存</button>
                                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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

            //监听提交
            form.on('submit(add)', function(data){
                data.field._token = "<%csrf_token()%>";
                *.post('<%route('{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.edit')%>', data.field , function(response){

                    if(response.code == 1)
                    {
                        layer.msg(response.message);
                        window.location.href = "<%route('{{lcfirst($group)}}.{{lcfirst($module)}}.{{lcfirst($model)}}.lists')%>";
                    }else{
                        layer.msg(response.message);
                    }
                });
                return false;
            });
        });
    </script>
#endsection