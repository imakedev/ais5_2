function show(obj){

  //  alert(obj.title)
    //obj.tooltip();
    $("#soot_info").html(obj.title)
    $("#myModal").modal();
}
$(document).ready(function(){
	$("#gridSootList").kendoGrid({
        height: 400,
		//scrollable: false,
        // groupable: true,
        //sortable: true,
       /*
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        */
    });

	
	
	$("#gridSootList2").kendoGrid({
        height: 400,
    });

	
	$("#gridSootList3").kendoGrid({
        height: 400,
    });
	
	$(".k-grid .k-grid-header").hide();

    $('#sootData .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    var sootViewHidden=$("#sootViewHidden").val();
    var sootUnitHidden=$("#sootUnitHidden").val();
    $('select[name="sootUnit"]').val(sootUnitHidden)
    $('select[name="sootView"]').val(sootViewHidden)
    //alert(sootViewHidden+","+sootUnitHidden)
    // $('[data-toggle="tooltip"]').tooltip();
    /*
    var tooltip = $('[data-toggle="tooltip"]').kendoTooltip({
        filter: "a",
        width: 120,
        position: "top"
    }).data("kendoTooltip");
*/
    //tooltip.show($("#canton"));

  //  $('[data-toggle="tooltip"]').find("a").click(false);


    // Tooltips demo
    /*
    $( ".tooltip" ).each(function( index ) {

        $(this).tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $(this).kendoTooltip({
            filter: "a",
            width: 120,
            position: "top"
        }).data("kendoTooltip");
        //$(this).find("a").click(false);

    });
     */
   // $('button[name="aoe"]').tooltip();
  });