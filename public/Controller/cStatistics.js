function mulipleDB(){
    $.ajax({
        url: "/ajax/multipledb/get",
        method: "GET"
    }).done(function(data, status, xhr) {
        console.log(data);
        alert(data)

    });
}
$(document).ready(function(){
    /*
	$("#gridStatistics").kendoGrid({
       // height: 400,
        sortable: true,
       // groupable: true,
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
    });
    */
    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    /*
    $('#fromData .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
    */
});