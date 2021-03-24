@include('admin._include.header')
<style>
    .layui-form-label{
        text-align: left;
    }
</style>
<body>

<div class="layui-fluid">
    <div class="layui-card">

        <div class="layui-card-body">

            <form action="" class="layui-form">
                <div class="layui-form-item">

                    <div class="layui-inline">
                        <label class="layui-form-label">口令</label>
                        <div class="layui-input-inline">
                            <input  id="solt" placeholder="请输入口令" autocomplete="off" class="layui-input">
                        </div>
                        <button type="button" class="layui-btn" id="search">确定</button>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-inline">
                            <select name="status" lay-verify="required" lay-filter="status" lay-search="">
                                <option value="">请选择状态</option>
                                <option value="1">未发放</option>
                                <option value="2">已发放</option>
                                <option value="3">已领取</option>
                            </select>
                        </div>
                    </div>

                </div>
            </form>

            <form action="" class="layui-form">
                <div class="layui-form-item">
                <div class="layui-inline">
                    <button type="button" class="layui-btn" id="add_export">新增口令</button>
                    <button type="button" class="layui-btn layui-btn-warm" id="export">导出并发放</button>
                </div>
                </div>
            </form>

            <table lay-filter="order_table" class="layui-table" lay-data="{height:'full-155',cellMinWidth:95,url:'{{url('admin/paper/paper-list')}}', page:true, id:'order_table'}">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, align:'center'}">ID</th>
                    <th lay-data="{field:'solt',align:'center'}">口令</th>
                    <th lay-data="{field:'amount',align:'center'}">金额</th>
                    <th lay-data="{field:'status_string',align:'center'}">状态</th>
                    <th lay-data="{field:'nick_name',align:'center'}">领取用户</th>
                    <th lay-data="{field:'pay_time',align:'center'}">领取时间</th>
                    <th lay-data="{field:'create_time',align:'center'}">创建时间</th>
                    <th lay-data="{title:'操作',templet:'#listBar',align:'center'}">操作</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<script type="text/html" id="listBar">
    @{{# if (d.status == 1) { }}
    <a class="layui-btn layui-btn-xs"  data-url="{{url('admin/paper/update')}}?id=@{{ d.id }}" lay-event="info">确认发放</a>
    @{{# }}}
</script>

<script>
    layui.config({
        base: "/plugin/layuiadmin/"  //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'table', 'layer'], function(){
        var $ = layui.$,
            form = layui.form,
            table = layui.table,
            layer =  layui.layer;

        form.on('select(status)', function(data) {
            table.reload('order_table', {
                where:{
                    status:data.value
                }
            });
        });

        $("#search").on('click', function () {
            table.reload('order_table', {
                where:{
                    solt:$("#solt").val()
                }
            });
        });


        $('#export').on('click', function () {
            layer.confirm("确认导出并修改所有未发放数据状态",{
                btn: ['确认', '取消']
            }, function () {

                layer.closeAll();
                location.href = "{{url('admin/paper/export')}}";

            }, function(){
                layer.closeAll()
            });
        });

        $('#add_export').on('click', function () {
            layer.open({
                title: '新增口令',
                type: 2,
                area: ['550px', '600px'],
                content: "{{url('admin/paper/add-paper')}}",
                end: function() {
                    layui.cache.layerIndex = null;
                    table.reload('order_table')
                }
            });
        });

        table.on('tool(order_table)', function(obj){
           if (obj.event == 'info') {
                var url = $(this).data('url');
                $.ajax({
                    url:url,
                    type:"post",
                    data:{'status':2},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function (res) {
                        layer.msg("操作成功",{time:800,shade:0.3},function () {
                            table.reload('order_table')
                        });
                    }
                })
            }

        });
        

    });


</script>
</body>

@include('admin._include.footer')