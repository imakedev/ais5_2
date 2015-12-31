$(document).ready(function(){
	$(".customColors").spectrum({
	    /*color: "#f00"*/
		preferredFormat: "hex"
	});
	var type_pre=$("#color_type_pre").val();
	$('input[name="color_type"][value="'+type_pre+'"]').prop("checked", true);
});
function showColor(){
	var point_1=$("#color_point_1").val();
	alert(point_1)
}