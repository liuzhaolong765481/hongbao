@include('admin._include.header')
<body class="auth-user">
<div class="layui-fluid">
    <div class="layui-row larryms-panel auth-user-add">
        <form class="layui-form" method="post">

            <div class="layui-form-item">
                <label class="layui-form-label">生成数量</label>
                <div class="layui-input-block">
                    <input type="number" name="count" lay-verify="required" placeholder="请填写生成数量"  value="" autocomplete="off" class="layui-input larry-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">最小金额</label>
                <div class="layui-input-block">
                    <input type="number" name="min" lay-verify="required" placeholder="请填写最小金额"  value="" autocomplete="off" class="layui-input larry-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">最大金额</label>
                <div class="layui-input-block">
                    <input type="number" name="max" lay-verify="required" placeholder="请填写最大金额"  value="" autocomplete="off" class="layui-input larry-input">
                </div>
            </div>

            <div class="layui-form-item" style="text-align: center">
                <button class="layui-btn" lay-submit lay-filter="account_add">确定</button>
            </div>

        </form>
    </div>
</div>


<script>
    layui.config({
        base: "/plugin/layuiadmin/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'upload', 'form'], function(){
        var $ = layui.jquery,
            form = layui.form;

        form.on('submit(account_add)', function(data) {
            var index = layer.load(1);
            $.ajax({
                url:"{{url('admin/paper/add-paper')}}",
                dateType:'json',
                data:data.field,
                type:'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (res) {
                    layer.close(index);
                    layer.msg("操作成功");
                }
            });

            return false;
        });


    });


</script>

</body>
@include('admin._include.footer')