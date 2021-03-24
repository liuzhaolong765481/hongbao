<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="home/console.html">
            <span>{{env('APP_NAME')}}</span>
        </div>

        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item">
                <a href="javascript:;" lay-href="{{url('admin/index/console')}}" lay-tips="主页" lay-direction="2">
                    <i class="layui-icon layui-icon-home"></i>
                    <cite>控制台</cite>
                </a>
            </li>


            <li data-name="home" class="layui-nav-item">
                <a href="javascript:;"  lay-tips="主页" lay-direction="2">
                    <i class="layui-icon layui-icon-rmb"></i>
                    <cite>红包管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a lay-href="{{url('admin/paper/paper-list')}}">红包列表</a>
                    </dd>
                </dl>
            </li>


            <li data-name="user" class="layui-nav-item">
                <a href="javascript:;" lay-tips="用户" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>用户管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a lay-href="{{url('admin/auth/user-list')}}">网站用户</a>
                    </dd>
                    <dd>
                        <a lay-href="{{url('admin/auth/manager-list')}}?ky=12">后台管理员</a>
                    </dd>
                </dl>
            </li>

            <li data-name="home" class="layui-nav-item">
                <a href="javascript:;" lay-href="{{url('admin/setting/index')}}" lay-tips="主页" lay-direction="2">
                    <i class="layui-icon layui-icon-set"></i>
                    <cite>设置</cite>
                </a>
            </li>

        </ul>
    </div>
</div>