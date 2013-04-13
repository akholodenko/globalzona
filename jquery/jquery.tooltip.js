this.tooltip = function(){	
	/* CONFIG */		
		xOffset = 10;
		yOffset = 20;		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("a.tooltip").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("a.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};

this.bubbletip = function(){	

	xOffsetBubble = -12;
	yOffsetBubble = -43;		

	$("a.bubbleTip").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='bubbleTip'></p>");
		$("#bubbleTip").html("<div class='bubbleTipBody'>"+ this.t +"</div>");

		$("#bubbleTip")
			.css("top",(e.pageY - xOffsetBubble) + "px")
			.css("left",(e.pageX + yOffsetBubble) + "px")
			.css("opacity","0.93")
			.css("filter","alpha(opacity=93)")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		$("#bubbleTip").remove();
    });	

	$("a.bubbleTip").mousemove(function(e){
		$("#bubbleTip")
			.css("top",(e.pageY - xOffsetBubble) + "px")
			.css("left",(e.pageX + yOffsetBubble) + "px");
	});			
};



// starting the script on page load
$(document).ready(function(){
	tooltip();
	bubbletip();
});