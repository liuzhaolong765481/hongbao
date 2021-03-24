@include('admin/_include/header')


<div class="layui-fluid">
  <div class="layui-row layui-col-space15">


  </div>
</div>
  <script>
    layui.config({
      base: "/plugin/layuiadmin/" //静态资源所在路径
    }).extend({
      index: 'lib/index' //主入口模块
    }).use(['index']);
  </script>
@include('admin/_include/footer')
