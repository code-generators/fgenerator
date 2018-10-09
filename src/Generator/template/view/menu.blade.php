<!-- 侧边菜单 -->
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="#">
            <span>管理系统</span>
        </div>
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;" lay-tips="" lay-direction="2">
                    <i class="layui-icon layui-icon-home"></i>
                    <cite>首页</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd class="layui-this">
                        <a lay-href="#"> 控制台</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>