$(document).ready(function(){
	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	 $("#btnReset").click(function(){
		 $("#action").val("add");
		 $("#btnSubmit").val("Add");
		 $("#name").val("");
		 $("#age").val("");
	 });
	$("#btnSubmit").click(function(){
		//alert("hello jquery");
		
		var name= $("#name").val();
		var age= $("#age").val();
		var id= $("#id").val();
		var action= $("#action").val();
		
		$.ajax({
			url:"/ajax/member/post",
			type:"POST",
			dataType:"json",
			data:{"action":action,"name":name,"age":age,"id":id},
			success:function(data){
				console.log(data);
				if(data=='addSuccess'){
					alert("insert success");
					
					showMemberAll();
					 $("#btnReset").click();
					
				}else{
					
					alert("edit success");
					showMemberAll();
					$("#btnReset").click();
					
				}
			}
			
		});
	});
	
	function showMemberAll(){
		
		$.ajax({
			url:"/ajax/member/allMember",
			type:"POST",
			dataType:"json",
			data:{"action":"showAll"},
			success:function(data){
				//console.log(data['memberModel']);
				dataObject=eval("("+data['memberModel']+")");
				console.log(dataObject);	
				var tableHtml="";
				$.each(dataObject,function(index,indexEntry){
					console.log(indexEntry);
					tableHtml+="<tr>";
						tableHtml+="<td>";
							tableHtml+=indexEntry['name'];
						tableHtml+="</td>";
						tableHtml+="<td>";
							tableHtml+=indexEntry['age'];
						tableHtml+="</td>";
						tableHtml+="<td>";
						tableHtml+="<a href=\"#\" class=\"memeberDel\" id=\"memeberDel-"+indexEntry['id']+"\">Del</a>";
						tableHtml+="|";
						tableHtml+="<a href=\"#\"  class=\"memeberEdit\" id=\"memeberEdit-"+indexEntry['id']+"\">Edit</a>";
					tableHtml+="</td>";
					tableHtml+="</tr>";
					
				});
				
				$("#bodyMember").html(tableHtml);
				
				$(".memeberDel").click(function(){
					//alert(this.id);
					var id=this.id.split("-");
					id=id[1];
					
					$.ajax({
						url:"/ajax/member/delete",
						dataType:"json",
						data:{"id":id},
						success:function(data){
							
							if(data=='success'){
								alert("dedelte success");
								showMemberAll();
								$("#name").val("");
								$("#age").val("");
							}
						}
						
					});
				});
				
				$(".memeberEdit").click(function(){
					var id=this.id.split("-");
					id=id[1];
					$.ajax({
						url:"/ajax/member/edit",
						dataType:"json",
						data:{"id":id},
						success:function(data){
							var dataObject=eval("("+data['memberModel']+")");
							console.log(dataObject['name']);
							console.log(dataObject['age']);
							
							$("#name").val(dataObject['name']);
							$("#age").val(dataObject['age']);
							$("#id").val(dataObject['id']);
							$("#action").val("edit");
							$("#btnSubmit").val("Edit");
							
							
						}
						
					});
					
					
					
				});
			}
			
		});
	}
	showMemberAll();
	
});