@include('admin._include.header')
<style>
    .layui-table-cell {
        height: auto;
        line-height: 30px;
    }
</style>
<body>
<div class="layui-fluid">
    <div class="layui-card">


        <div class="layui-card-body">

            <table lay-filter="user_table" class="layui-table" lay-data="{height:'full-155',cellMinWidth:95,url:'{{url('admin/auth/user-list')}}', page:true, id:'user_table'}">
                <thead>
                <tr>
                    <th lay-data="{field:'id', align:'center'}">ID</th>
                    <th lay-data="{field:'nick_name',align:'center'}">昵称</th>
                    <th lay-data="{toolbar:'#toolbarDemo',width:200,align:'center'}">头像</th>
                    <th lay-data="{field:'city',align:'center'}">城市</th>
                    <th lay-data="{field:'create_time',align:'center'}">注册时间</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<script type="text/html" id="toolbarDemo" class="layer-photos-demo">
    <img src="@{{ d.avatar }}" width="30px" height="30px" layer-src="@{{ d.avatar }}" alt="" lay-event="show">
</script>

<script>
    layui.config({
        base: "/plugin/layuiadmin/"  //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'table'], function(){
        var $ = layui.$,
            form = layui.form,
            table = layui.table;

        table.on('tool(user_table)', function(obj){
            var data = obj.data;
            var that = this;
            if (obj.event == "show") {
                // console.log(data);return false;
                var arr = [];
                var obj = {
                    'alt':data.avatar,
                    'pic':data.id+"_id",
                    'src':data.avatar,
                    'thumb':data.avatar
                };
                arr.push(obj);
                var json = {
                    'title':data.avatar,
                    'id':data.id,
                    'start':0,
                    'data':arr
                };
                layer.photos({
                    photos: json
                    ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
                });
            }

        });


    });



</script>
</body>

@include('admin._include.footer')