$(document).ready(function(){
	

	$("#btnAddPoint").click(function(){
	
		$.ajax({
			url:"/Model/listPoint.php",
			type:"html",
			success:function(data){
				//alert(data);
				$("#pointListArea").html(data);
				
				
				$("#gridPointList").kendoGrid({
				       // height: 400,
						scrollable: false,
				      
				        sortable: true,
				        /*
				        pageable: {
				            refresh: true,
				            pageSizes: true,
				            buttonCount: 5
				        },
				        */
				 });
				 
			}
		});
	});
		
		
	//gridConstantList
	$("#btnConstant").click(function(){
		
		$.ajax({
			url:"Model/listConstant.php",
			type:"html",
			success:function(data){
				//alert(data);
				$("#constantListArea").html(data);
				
				
				$("#gridConstantList").kendoGrid({
				       // height: 400,
						scrollable: false,
				       // groupable: true,
				        sortable: true,
				      /*
				        pageable: {
				            refresh: true,
				            pageSizes: true,
				            buttonCount: 5
				        },
				        */
				 });
				 
			}
		});
		//listConstant.php
		
	});
});