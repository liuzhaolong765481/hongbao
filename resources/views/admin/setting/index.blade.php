@include('admin._include.header')
<body>
<div class="layui-fluid">
    <div class="layui-row larryms-panel auth-user-add">
        <form class="layui-form" method="post">

            <div class="layui-form-item">
                <label class="layui-form-label">小程序banner</label>

                <div class="layui-card-body">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn test-upload-normal">上传图片</button>
                        <input type="hidden" name="banner" lay-verify="required" value="{{$setting->banner}}">
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" src="{{$setting->banner}}" style="width: 100px;margin-left: 95px" id="test-upload-normal-img">
                            <p id="test-upload-demoText"></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">客服二维码</label>

                <div class="layui-card-body">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn test-upload-normal">上传图片</button>
                        <input type="hidden" name="kefu_image" lay-verify="required" value="{{$setting->kefu_image}}">
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" src="{{$setting->kefu_image}}" style="width: 100px;margin-left: 95px" id="test-upload-normal-img">
                            <p id="test-upload-demoText"></p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="hidden" name="id" value="{{$setting->id}}">
                    <button class="layui-btn" lay-submit lay-filter="submit_setting">确定提交</button>
                </div>
            </div>

        </form>
    </div>
</div>

</body>
<script>
    layui.config({
        base: "/plugin/layuiadmin/" //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'console', 'form', 'upload'], function () {
        var $ = layui.jquery,
        form = layui.form;
        upload = layui.upload;

        var uploadInst = upload.render({
            elem: '.test-upload-normal',
            url: '{{url('public/upload')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            multiple: false,  //是否允许多图上传
            accept: 'images',  //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
            acceptMime: 'image/*',
            field: 'file',  //上传文件参数名
            before: function(obj){
            },
            done: function(res){
                //如果上传失败
                if(res.status != SUCCESS){
                    return layer.msg(res.message);
                }else{
                    $(this.item).next().next().val(res.data);
                    $(this.item).next().next().next().find('img').attr('src', res.data)
                }
                //上传成功
            },

        });

        form.on('submit(submit_setting)', function(data) {
            var index = layer.load(1);
            $.ajax({
                url:"{{url('admin/setting/index')}}",
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
@include('admin._include.footer')