function load(sent_lat, sent_long) //displays the google map
{
	if (GBrowserIsCompatible())
	{
		var map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(sent_lat, sent_long), 16);	//center of the map; last attribute is the zoom
		map.addControl(new GSmallMapControl());	//zoom controls
		map.addControl(new GMapTypeControl());	//allows switch to hybrid, satellite
		map.addOverlay(new GMarker(new GLatLng(sent_lat, sent_long)));	//print marker at location
	}
}

var store = new Array();

store[0] = new Array(
	'Select a Category','blank'
);

store[1] = new Array(
	'Chinese','01_01',
	'Italian','01_02'
);

store[2] = new Array(
	'Baseball','02_01',
	'Basketball','02_02',
	'Football','02_03',
	'Golf','02_04',
	'Soccer','02_05'
);

function init()
{
	optionTest = true;
	lgth = document.forms['create_event_details'].second.options.length - 1;
	document.forms['create_event_details'].second.options[lgth] = null;
	if (document.forms['create_event_details'].second.options[lgth]) optionTest = false;
}

function populate()
{
	if (!optionTest) return;
	var box = document.forms['create_event_details'].first;
	var number = box.options[box.selectedIndex].value;
	if (!number) return;
	var list = store[number];
	var box2 = document.forms['create_event_details'].second;
	box2.options.length = 0;
	for(i=0;i<list.length;i+=2)
	{
		box2.options[i/2] = new Option(list[i],list[i+1]);
	}
}

var rest = new Array();

rest[0] = new Array(
	'Select a City','blank'
);

rest[1] = new Array(
	'A Place in NY1','01_01',
	'A Place in NY2','01_02'
);

rest[2] = new Array(
	'Specialties','02_01',
	'Toaster Oven','02_02',
	'Van Damme Ville','02_03',
	'Sushi Spot','02_04'
);

function init_rest()
{
	optionTest = true;
	lgth = document.forms['create_event_details'].rest_list.options.length - 1;
	document.forms['create_event_details'].rest_list.options[lgth] = null;
	if (document.forms['create_event_details'].rest_list.options[lgth]) optionTest = false;
}

function populate_rest()
{
	if (!optionTest) return;
	var box = document.forms['create_event_details'].city_list;
	var number = box.options[box.selectedIndex].value;
	if (!number) return;
	var list = rest[number];
	var box2 = document.forms['create_event_details'].rest_list;
	box2.options.length = 0;
	for(i=0;i<list.length;i+=2)
	{
		box2.options[i/2] = new Option(list[i],list[i+1]);
	}
}

function show_hide_topic (value)
{
	if (document.getElementById(value).style.display == "none")
	{
		document.getElementById(value).style.display = "block";
		document['plus_' + value].src = "http://www.off2lunch.com/images/minus.jpg";
	}
	else if (document.getElementById(value).style.display == "block")
	{
		document.getElementById(value).style.display = "none";
		document['plus_' + value].src = "http://www.off2lunch.com/images/plus.jpg";
	}
}

function show (value)
{
	var nav_cat = new Array();
	nav_cat[0] = 'create_event';
	nav_cat[1] = 'search_events';
	nav_cat[2] = 'search_rest';
	nav_cat[3] = 'tell_friend';
	nav_cat[4] = 'returning_visitor';
	nav_cat[5] = 'pro_account';	
	nav_cat[6] = 'create_post';
	nav_cat[7] = 'search_pro';	
	
	for(i=0; i < nav_cat.length; i++)
	{
		if (value == nav_cat[i])
		{
			document.getElementById(nav_cat[i]).style.display = "block";
			document.getElementById('cancel_' + nav_cat[i]).style.display = "block";
		}
		else
		{
			document.getElementById(nav_cat[i]).style.display = "none";
			document.getElementById('cancel_' + nav_cat[i]).style.display = "none";
		}
	}		
}
/*
function show (value)
{
	if (value == "create_event")
	{
		document.getElementById('create_event').style.display = "block";
		document.getElementById('cancel_create_event').style.display = "block";

		document.getElementById('search_events').style.display = "none";
		document.getElementById('cancel_search_events').style.display = "none";

		document.getElementById('search_rest').style.display = "none";
		document.getElementById('cancel_search_rest').style.display = "none";

		document.getElementById('tell_friend').style.display = "none";
		document.getElementById('cancel_tell_friend').style.display = "none";
		
		document.getElementById('returning_visitor').style.display = "none";
		document.getElementById('cancel_returning_visitor').style.display = "none";		
	}
	else if (value == "search_events")
	{
		document.getElementById('search_events').style.display = "block";
		document.getElementById('cancel_search_events').style.display = "block";

		document.getElementById('create_event').style.display = "none";
		document.getElementById('cancel_create_event').style.display = "none";

		document.getElementById('search_rest').style.display = "none";
		document.getElementById('cancel_search_rest').style.display = "none";

		document.getElementById('tell_friend').style.display = "none";
		document.getElementById('cancel_tell_friend').style.display = "none";
		
		document.getElementById('returning_visitor').style.display = "none";
		document.getElementById('cancel_returning_visitor').style.display = "none";
	}
	else if (value == "search_rest")
	{
		document.getElementById('search_rest').style.display = "block";
		document.getElementById('cancel_search_rest').style.display = "block";

		document.getElementById('create_event').style.display = "none";
		document.getElementById('cancel_create_event').style.display = "none";

		document.getElementById('search_events').style.display = "none";
		document.getElementById('cancel_search_events').style.display = "none";

		document.getElementById('tell_friend').style.display = "none";
		document.getElementById('cancel_tell_friend').style.display = "none";

		document.getElementById('returning_visitor').style.display = "none";
		document.getElementById('cancel_returning_visitor').style.display = "none";		
	}
	else if (value == "tell_friend")
	{
		document.getElementById('tell_friend').style.display = "block";
		document.getElementById('cancel_tell_friend').style.display = "block";

		document.getElementById('create_event').style.display = "none";
		document.getElementById('cancel_create_event').style.display = "none";

		document.getElementById('search_events').style.display = "none";
		document.getElementById('cancel_search_events').style.display = "none";

		document.getElementById('search_rest').style.display = "none";
		document.getElementById('cancel_search_rest').style.display = "none";

		document.getElementById('returning_visitor').style.display = "none";
		document.getElementById('cancel_returning_visitor').style.display = "none";		
	}
	
	else if (value == "returning_visitor")
	{
		document.getElementById('tell_friend').style.display = "none";
		document.getElementById('cancel_tell_friend').style.display = "none";

		document.getElementById('create_event').style.display = "none";
		document.getElementById('cancel_create_event').style.display = "none";

		document.getElementById('search_events').style.display = "none";
		document.getElementById('cancel_search_events').style.display = "none";

		document.getElementById('search_rest').style.display = "none";
		document.getElementById('cancel_search_rest').style.display = "none";

		document.getElementById('returning_visitor').style.display = "block";
		document.getElementById('cancel_returning_visitor').style.display = "block";		
	}	
}
*/
function cancel (value)
{
	document.getElementById(value).style.display = "none";
	document.getElementById('cancel_' + value).style.display = "none";	
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

function show_event_details (value)
{
	vista = (document.getElementById(value).style.display == 'none') ? 'block' : 'none';
	document.getElementById(value).style.display = vista;
}

function uncheck_box_manual_rest()	//changes the values of the check box for manual rest. input; this function is needed because the user doesn't actually click on the hidden checkbox, this controls the checking of it
{
	vista = (create_event_details.manual_rest.checked == true) ? false : true;
    create_event_details.manual_rest.checked = vista;
}

function uncheck_load()	//sets checkbox for manual restaurant input to UNCHECKED  onLOAD()
{
	create_event_details.manual_rest.checked = false;
	create_event_details.just_post.checked = false;
}