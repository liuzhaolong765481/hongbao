@include('admin._include.header')
<body class="auth-user">
<div class="layui-fluid">
    <div class="layui-row larryms-panel auth-user-add">
        <form action="" class="layui-form" method="post" id="userAddForm">
            <div class="layui-form-item">
                <label class="layui-form-label">原始密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" lay-verify="required"  value=""  placeholder="请输入原密码" autocomplete="off" class="layui-input larry-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" name="new_password" value="" placeholder="请输入新密码" lay-verify="required" autocomplete="off" class="layui-input larry-input">
                </div>
            </div>
            <div class="larryms-layer-btn">
                <a class="layui-btn layui-btn layui-btn-sm left" lay-submit lay-filter="useradd" >确定</a>
            </div>
        </form>
    </div>
</div>

<script>
    layui.config({
        base: "/plugin/layuiadmin/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'upload', 'form', 'layedit'], function() {

        var $ = layui.jquery,
        form = layui.form;
        layedit = layui.layedit;

        form.on('submit(useradd)', function (data) {
            // console.log(data.field);
            var index = layer.load(1);
            $.post({
                url: "{{url('admin/auth/edit-password')}}",
                dateType: 'json',
                data: data.field,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    layer.close(index);
                    if(res.status == 10001){
                        top.location.href = "{{url('admin/auth/logout')}}"
                    }else{
                        layer.msg(res.message);
                    }
                }
            });

            return false;
        });

    })
</script>

</body>
@include('admin._include.footer')