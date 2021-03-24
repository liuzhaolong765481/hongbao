/** layuiAdmin.std-v1.0.0 LPPL License By http://www.layui.com/admin/ */
;layui.define(function (e) {
    layui.use(["admin", "carousel"], function () {
        var e = layui.$, t = (layui.admin, layui.carousel), a = layui.element, i = layui.device();
        e(".layadmin-carousel").each(function () {
            var a = e(this);
            t.render({
                elem: this,
                width: "100%",
                arrow: "none",
                interval: a.data("interval"),
                autoplay: a.data("autoplay") === !0,
                trigger: i.ios || i.android ? "click" : "hover",
                anim: a.data("anim")
            })
        }), a.render("progress")
    }),
     layui.use(["carousel", "echarts"], function () {
            var amount = [], hours = [], count = [] ;

         $.ajax({
             url: "console",
             type: "post",
             dataType: "json",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             beforeSend: function(){},
             data:{},
             success:function (e) {
                 if(e.status == SUCCESS){
                     amount = e.data.amount;
                     hours = e.data.hours;
                     count = e.data.count;

                     var e = layui.$, t = layui.carousel, a = layui.echarts, i = [], l = [{
                         title: {text: "充值订单统计", x: "center", textStyle: {fontSize: 14}},
                         tooltip: {trigger: "axis"},
                         legend: {data: ["", ""]},
                         xAxis: [{
                             type: "category",
                             boundaryGap: !1,
                             data: hours
                         }],
                         yAxis: [{type: "value"}],
                         series: [{
                             name: "充值金额",
                             type: "line",
                             smooth: !0,
                             itemStyle: {normal: {areaStyle: {type: "default"}}},
                             data:amount
                         },{
                             name: "订单数量",
                             type: "line",
                             smooth: !0,
                             itemStyle: {normal: {areaStyle: {type: "default"}}},
                             data:count
                         },]
                     }], n = e("#LAY-index-dataview").children("div"), r = function (e) {
                         i[e] = a.init(n[e], layui.echartsTheme), i[e].setOption(l[e]), window.onresize = i[e].resize
                     };
                     if (n[0]) {
                         r(0);
                         var o = 0;
                         t.on("change(LAY-index-dataview)", function (e) {
                             r(o = e.index)
                         }), layui.admin.on("side", function () {
                             setTimeout(function () {
                                 r(o)
                             }, 300)
                         }), layui.admin.on("hash(tab)", function () {
                             layui.router().path.join("") || r(o)
                         })
                     }

                 }else{

                 }

             }
         });


    }), e("console", {})
});