$(document).ready(function(){
	$("#gridCalList").kendoGrid({
       // height: 400,
		scrollable: false,
        sortable: true,
       // groupable: true,
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
    });
});