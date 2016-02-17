/**
 * Created by imake on 15/02/2016.
 */
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#checkAll').click(function (event) {
        if(this.checked){
            $('.ck').each(function(){
                this.checked = true;
            });
        }else{
            $('.ck').each(function(){
                this.checked = false;
            });
        }
    });
    var sortBy_hidden=$("#sortBy_hidden").val();
    var orderBy_hidden=$("#orderBy_hidden").val();
    var design_trend_B_hidden=$("#design_trend_B_hidden").val();
    $('select[name="sortBy"]').val(sortBy_hidden)
    $('select[name="orderBy"]').val(orderBy_hidden)
    $('select[name="design_trend_B"]').val(design_trend_B_hidden)
});
function showmmtrend(zz){
    $("#mmtrend_zz").val(zz)
    $("#trend_element").show();
    var obj={
        zz:zz
    }
    $.ajax({
        url: "/ajax/mmtrends/list",
        method: "GET",
        data: obj
    }).done(function(data, status, xhr) {
        console.log(data, status, xhr);
        // alert(data.data.length)
        var trendDesignsM = jQuery.parseJSON(data.trendDesignsM);
        var mmnameM = jQuery.parseJSON(data.mmnameM);
        // alert(mmnameM)
        if(mmnameM!=null){
            $("#trend_element_header").html("แสดง Point ของ "+mmnameM.A);
        }


        var str=""+
            " <table id=\"editable\" "+
            " class=\"table table-striped table-bordered table-hover  dataTable\" "+
            "  role=\"grid\" aria-describedby=\"editable_info\"> "+
            "  <thead> "+
            "    <tr role=\"row\"> "+
                /*
            "    <th class=\"\" tabindex=\"0\" aria-controls=\"\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 0%;\" "+
            " aria-sort=\"\" aria-label=\"\">  <input type='checkbox' id=\"checkAll_inner\"> "+
            "     </th> "+
            */
            "     <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 10%;\" "+
            " aria-label=\"Browser: activate to sort column ascending\"> "+
            "     Point "+
            "     </th>"+
            "     <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 5%;\" "+
            " aria-label=\"Platform(s): activate to sort column ascending\"> "+
            "     MM "+
            "    </th> "+
            "    <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 35%;\" "+
            " aria-label=\"Platform(s): activate to sort column ascending\"> "+
            "     Point Name "+
            " </th> "+
            " <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 15%;\" "+
            " aria-label=\"Platform(s): activate to sort column ascending\"> "+
            "     Tag Name "+
            "  </th> "+
            " <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 10%;\" "+
            " aria-label=\"Platform(s): activate to sort column ascending\"> "+
            "     Unit "+
            "     </th> "+
            "     <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 5%;\" "+
            " aria-label=\"Platform(s): activate to sort column ascending\"> "+
            "     Max "+
            "     </th> "+
            "     <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" "+
            " rowspan=\"1\" colspan=\"1\" style=\"width: 5%;\" "+
            " aria-label=\"Platform(s): activate to sort column ascending\"> "+
            "     Min "+
            "     </th> "+
                /*
            "     <th class=\"\" tabindex=\"0\" aria-controls=\"editable\" rowspan=\"1\" colspan=\"1\"  "+
            "  style=\"width: 10%;\" aria-label=\"Platform(s): activate to sort column ascending\">  "+
            "    Action  "+
            "      </th>  "+
            */
            "    </tr> "+
            "    </thead> "+
            "    <tbody> ";
        if(trendDesignsM.data!=null && trendDesignsM.data.length>0){
            for(var i=0;i<trendDesignsM.data.length;i++){
                str=str+
                    "    <tr class=\"gradeA odd\" role=\"row\"> "+
                        /*
                    "    <td class=\"sorting_1\"> "+
                    "    <input type='checkbox' name=\"checkbox_inner[]\" "+
                    " class=\"ck_inner\" data-id=\"checkbox\"  value=\""+trendDesignsM.data[i].ZZ+"\"> "+
                    "    </td> "+
                    */
                    "   <td>"+trendDesignsM.data[i].A+"</td> "+
                    "   <td>"+trendDesignsM.data[i].B+"</td> "+
                    "   <td>"+trendDesignsM.data[i].C+"</td> "+
                    " <td>"+trendDesignsM.data[i].D+"</td> "+
                    " <td>"+trendDesignsM.data[i].E+"</td> "+
                    " <td>"+trendDesignsM.data[i].F0+"</td> "+
                    " <td>"+trendDesignsM.data[i].F1+"</td> "+
                    /*
                    " <td> "+
                    "  <a id=\"btnEdit\" onclick=\"displayMmtrend('edit','"+trendDesignsM.data[i].ZZ+"','"+trendDesignsM.data[i].H+"')\" class=\"btn btn-dropbox btn-xs\"><i style=\"color: #47a447;\" class=\"glyphicon glyphicon-edit\"></i></a>| "+
                    " <a onclick=\"displayMmtrendDelete('delete','"+trendDesignsM.data[i].ZZ+"')\" class=\"btn btn-dropbox btn-xs\"><i class=\"glyphicon glyphicon-trash text-danger\"></i></a> "+
                    " </td>" +
                    */
                    " </tr> ";
            }
        }

        str=str+" </tbody> "+
            " </table> ";

        $("#trend_element_table").html(str);
        $('#checkAll_inner').click(function (event) {
            if(this.checked){
                $('.ck_inner').each(function(){
                    this.checked = true;
                });
            }else{
                $('.ck_inner').each(function(){
                    this.checked = false;
                });
            }
        });
        //alert(data.trendDesignsM)
        //alert(obj.data[0].C)
        //alert(data.paging)
        //$("#trend_paging").html(data.paging)
    });

}

function  displayMmNameById(mode,id){
    $("#trend_name_element").removeClass("has-error");
    $("#trend_copy_name").attr("placeholder", "ชื่อ Trend");
    $("#error_message").html( "");
    $("#move_errormessage").hide();
    var obj={
        "ZZ":id

    }
    $("#move_copy_id").val(id);
    //alert(id)
    $.ajax({
        url: "/ajax/mmname/get",
        method: "GET",
        data: obj
    }).done(function(data, status, xhr) {
        console.log(data);
        var mmnameM = jQuery.parseJSON(data.mmnameM);

        var mmname_tilte=mmnameM[0].A; //_move_section
     //   alert(mmname_tilte)
        if(mode=='move'){
            /*mm_group_move_target_select
            mm_unit_move_target_select
            */
            $("#mmname_tilte_move_section").html("Move Trend "+mmname_tilte);
            $("#moveModal").modal()
        }else if(mode=='copy'){
            /*
            trend_copy_name
            mm_group_copy_target_select
            mm_unit_copy_target_select
            */
            $("#mmname_tilte_copy_section").html("copy Trend "+mmname_tilte);
            $("#copyModal").modal()
        }

    });
}
function doMoveTrend(){
    var ZZ=$("#move_copy_id").val();
    var mm_group_move_target_select=$("#mm_group_move_target_select").val();
    var mm_unit_move_target_select=$("#mm_unit_move_target_select").val();
    var obj={
        "ZZ":ZZ,
        "target_group":mm_group_move_target_select,
        "target_unit":mm_unit_move_target_select
    }

    $.ajax({
        url: "/ajax/mmtrend/move",
        method: "POST",
        data: obj
    }).done(function(data, status, xhr) {
        console.log(data, status, xhr);
        var count = jQuery.parseJSON(data.count);
        var isExcessTrend = jQuery.parseJSON(data.isExcessTrend);
        //alert((count))
        if(isExcessTrend){
            var maxTrend = jQuery.parseJSON(data.maxTrend);
            $("#error_message").html("คุณเพิ่ม Trend ได้มากที่สุด ["+maxTrend+"] Trends");
            $("#move_errormessage").show();
            return false;
        }else{
            var countInt=parseInt(count);
            if(countInt>0){

                $("#error_message").html( "ชื่อ Trend ซ้ำ กับ Target Trend.");
                $("#move_errormessage").show();
            }else {
                location.reload()
                $("#moveModal").modal('hide')
            }
        }
    });
}
function doCopyTrend(){
    $("#trend_name_element").removeClass("has-error");
    $("#trend_copy_name").attr("placeholder", "ชื่อ Trend");
    var ZZ=$("#move_copy_id").val();
    var mm_group_copy_target_select=$("#mm_group_copy_target_select").val();
    var mm_unit_copy_target_select=$("#mm_unit_copy_target_select").val();
    var trend_copy_name= $.trim($("#trend_copy_name").val());

    if(trend_copy_name.length==0){
        $("#trend_name_element").addClass("has-error");
        $("#trend_copy_name").attr("placeholder", "กรุณากรอก ชื่อ Trend ");
        return false;
    }
    var obj={
        "ZZ":ZZ,
        "target_group":mm_group_copy_target_select,
        "target_unit":mm_unit_copy_target_select,
        "trend_name":trend_copy_name
    }

    $.ajax({
        url: "/ajax/mmtrend/copy",
        method: "POST",
        data: obj
    }).done(function(data, status, xhr) {
        console.log(data, status, xhr);
        var count = jQuery.parseJSON(data.count);
        var isExcessTrend = jQuery.parseJSON(data.isExcessTrend);
         //alert((count))
        if(isExcessTrend){
            $("#trend_name_element").addClass("has-error");
            //alert("คุณไม่สามารถเพิ่ม Trend ได้");

            var maxTrend = jQuery.parseJSON(data.maxTrend);
            $("#trend_copy_name").val("");
            $("#trend_copy_name").attr("placeholder", "คุณเพิ่ม Trend ได้มากที่สุด ["+maxTrend+"] Trends");
            return false;
        }else{
            var countInt=parseInt(count);
            if(countInt>0){
                $("#trend_name_element").addClass("has-error");
                $("#trend_copy_name").val("");
                $("#trend_copy_name").attr("placeholder", "ชื่อ Trend ["+trend_copy_name+"] ซ้ำ.");
            }else {
                location.reload()
                $("#copyModal").modal('hide')
            }
        }

    });
}