function invert(inverted) {
    if (inverted) {
        $(".wrap").addClass("inverted");
        $("#callInvert").hide();
		$("#callClassic").show();
		
		var date = new Date();
		
		date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
		
		document.cookie = "inverted=true;expires=" + date.toGMTString() + ";path=/";
		
    } else {
        $(".wrap").removeClass("inverted");
        $("#callInvert").show();
		$("#callClassic").hide();
		
		var date = new Date();
		
        document.cookie = "inverted=false;expires=" + date.toGMTString() + ";path=/";
    }
}
