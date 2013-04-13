this.Page = function () {
	this.categoryId = 0;
}

function load_into_main (url, callback)
{
	if(callback == null)
		$('#main').load(url);
	else
		$('#main').load(url, null, callback);

	return false;
}

function load_into_shopping_cart_panel (url, callback)
{
	if(callback == null)
		$('#shopping_cart_panel').load(url);
	else
		$('#shopping_cart_panel').load(url, null, callback);

	return false;
}

function load_category_items (category_id)
{
	Page.categoryId = category_id;	//store category id of new category loaded

	var callback = function () { 
		enable_item_preview_highlight();
		enable_item_preview_draggable();
		enable_item_preview_tooltip();
		//enable_tooltipIMG();
	};

	load_into_main('?page=feed&feed_type=itemsByCategoryId&category_id=' + category_id, callback);

	return false;
}

function load_item_details (item_id)
{
	return load_into_main('?page=feed&feed_type=itemById&item_id=' + item_id);
}

function load_cart_details ()
{
	var callback = function () { 
		enable_item_preview_highlight() 
	};
	return load_into_main('?page=feed&feed_type=shoppingCartDetails', callback);
}

function enable_item_preview_tooltip ()
{
	$(".demo").tooltip({
		position: "center right", 
		effect: 'slide',
		direction: 'right',
		slideInSpeed: 300,
		offset: [0, 10],	//y = 0, x = 10 
		tip: '#demotip'
	});
}

function enable_item_preview_highlight ()
{
	$('.item_preview_img').corner();

	$('.item_preview_panel').mouseover(
		function () {
			$(this).find('.item_preview_img').css({'border':'2px solid #88ACE0'});
		}
	);

	$('.item_preview_panel').mouseout(
		function () {
			$(this).find('.item_preview_img').css({'border':'2px solid #dddddd'});
		}
	);
}

function enable_item_preview_draggable ()
{
	$('.item_preview_img').draggable({ 
		helper: 'clone', 
		cursor: 'hand',
		opacity: 0.35,
		drag: function(event, ui){
			$(this).css({'border':'2px solid #dddddd'});
		}
	});

	//start: function(event, ui) { ... }

}

function enable_item_preview_droppable ()
{
	$('#shopping_cart_panel').droppable({
		drop: function(event, ui) {
			add_to_cart(ui.draggable.attr('item_id'));
		}
	});
}

function add_to_cart (item_id)
{
	var callback = function () { load_category_items(Page.categoryId) };
	return load_into_shopping_cart_panel('?page=feed&feed_type=addToShoppingCart&item_id=' + item_id, callback);
}

function remove_from_cart (item_id)
{
	var callback = function () { load_cart_details() };
	return load_into_shopping_cart_panel('?page=feed&feed_type=removeFromShoppingCart&item_id=' + item_id, callback);
}

function get_item_id_from_preview_img_id (preview_img_id)
{
	return preview_img_id.replace('item_preview_id_','');
}

this.enable_tooltipIMG = function(){	
	/* CONFIG */		
		xOffset = 10;
		yOffset = 20;		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("img.tooltip").hover(function(e){											  
		this.t = this.alt;
		this.alt = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
		},
		function(){
			this.alt = this.t;		
			$("#tooltip").remove();
		});	
		$("img.tooltip").mousemove(function(e){
			$("#tooltip")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(e.pageX + yOffset) + "px");
		}
	);			
};