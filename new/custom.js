//UDMv3.5
//**DO NOT EDIT THIS *****
if (!exclude) { //********
//************************



///////////////////////////////////////////////////////////////////////////
//
//  ULTIMATE DROPDOWN MENU VERSION 3.5 by Brothercake
//  This is a special version for Dynamic Drive (http://www.dynamicdrive.com)
//
//  Link-wrapping routine by Brendan Armstrong
//  Original KDE modifications by David Joham
//  Opera reload/resize based on a routine by Michael Wallner
//  Select-element hiding routine by Huy Do
//
///////////////////////////////////////////////////////////////////////////



// *** POSITIONING AND STYLES *********************************************



var menuALIGN = "center";		// alignment
var absLEFT = 	0;		// absolute left or right position (if menu is left or right aligned)
var absTOP = 	150; 		// absolute top position

var staticMENU = false;		// static positioning mode (ie5,ie6 and ns4 only)

var stretchMENU = false;		// show empty cells
var showBORDERS = false;		// show empty cell borders

var baseHREF = "";	// base path to .js files for the script (ie: resources/)
var zORDER = 	1000;		// base z-order of nav structure (not ns4)

var mCOLOR = 	"black";	// main nav cell color
var rCOLOR = 	"#cccccc";	// main nav cell rollover color
var bSIZE = 	1;		// main nav border size
var bCOLOR = 	"black"	// main nav border color
var aLINK = 	"brown";	// main nav link color
var aHOVER = 	"";		// main nav link hover-color (dual purpose)
var aDEC = 	"none";		// main nav link decoration
var fFONT = 	"tahoma";	// main nav font face
var fSIZE = 	13;		// main nav font size (pixels)
var fWEIGHT = 	"bold"		// main nav font weight
var tINDENT = 	7;		// main nav text indent (if text is left or right aligned)
var vPADDING = 	7;		// main nav vertical cell padding
var vtOFFSET = 	0;		// main nav vertical text offset (+/- pixels from middle)

var keepLIT =	true;		// keep rollover color when browsing menu
var vOFFSET = 	5;		// shift the submenus vertically
var hOFFSET = 	4;		// shift the submenus horizontally

var smCOLOR = 	"#666666";	// submenu cell color

var srCOLOR = 	"#006699";	// submenu cell rollover color
var sbSIZE = 	1;		// submenu border size
var sbCOLOR = 	"black"	// submenu border color
var saLINK = 	"black";	// submenu link color
var saHOVER = 	"";		// submenu link hover-color (dual purpose)
var saDEC = 	"none";		// submenu link decoration
var sfFONT = 	"tahoma";// submenu font face
var sfSIZE = 	13;		// submenu font size (pixels)
var sfWEIGHT = 	"normal"	// submenu font weight
var stINDENT = 	5;		// submenu text indent (if text is left or right aligned)
var svPADDING = 1;		// submenu vertical cell padding
var svtOFFSET = 0;		// submenu vertical text offset (+/- pixels from middle)

var shSIZE =	2;		// submenu drop shadow size
var shCOLOR =	"#cccccc";	// submenu drop shadow color
var shOPACITY = 75;		// submenu drop shadow opacity (not ie4,ns4 or opera)

var keepSubLIT = true;		// keep submenu rollover color when browsing child menu
var chvOFFSET = -12;		// shift the child menus vertically
var chhOFFSET = 7;		// shift the child menus horizontally

var openTIMER = 10;		// [** new **] menu opening delay time (not ns4/op5/op6)
var openChildTIMER = 20;	// [** new **] child-menu opening delay time (not ns4/op5/op6)
var closeTIMER = 330;		// menu closing delay time

var cellCLICK = true;		// links activate on TD click
var aCURSOR = "hand";		// cursor for active links (not ns4 or opera)

var altDISPLAY = "";		// where to display alt text
var allowRESIZE = mu;		// allow resize/reload

var redGRID = false;		// show a red grid
var gridWIDTH = 760;		// override grid width
var gridHEIGHT = 500;		// override grid height
var documentWIDTH = 0;		// override document width

var hideSELECT = false;		// auto-hide select boxes when menus open (ie only)
var allowForSCALING = false;	// allow for text scaling in gecko browsers
var allowPRINTING = false;	// allow the navbar and menus to print (not ns4)

var arrWIDTH = 13;		// [** new **] arrow width (not ns4/op5/op6)
var arrHEIGHT = 13;		// [** new **] arrow height (not ns4/op5/op6)

var arrHOFFSET = -1;		// [** new **] arrow horizontal offset (not ns4/op5/op6)
var arrVOFFSET = -3;		// [** new **] arrow vertical offset (not ns4/op5/op6)
var arrVALIGN = "middle";	// [** new **] arrow vertical align (not ns4/op5/op6)

var arrLEFT = "<";		// [** new **] left arrow (not ns4/op5/op6)
var arrRIGHT = ">";		// [** new **] right arrow (not ns4/op5/op6)



//** LINKS ***********************************************************


// add main link item ("url","Link name",width,"text-alignment","_target","alt text",top position,left position,"key trigger","mCOLOR","rCOLOR","aLINK","aHOVER") [** last four are new **]
//addMainItem("http://www.dynamicdrive.com/","Home",80,"center","","",0,0,"","#ffeeee","#ffeecc","#000066","#660066");
addMainItem("","Home",81,"center","","",0,0,"","","","","");
	// define submenu properties (width,"align to edge","text-alignment",v offset,h offset,"filter","smCOLOR","srCOLOR","sbCOLOR","shCOLOR","saLINK","saHOVER") [** last six are new **]
	//defineSubmenuProperties(120,"left","left",-4,0,"","#ffddaa","#eeeeee","#660000","#eebbbb","#660000","#770033");
defineSubmenuProperties(137,"left","left",-4,0,"","","","","","","");
	// add submenu link items ("url","Link name","_target","alt text")
	addSubmenuItem("template.html","Upcoming Event","","");
	addSubmenuItem("#","Join Our Mailing List","","");

addMainItem("","Events",100,"center","","",0,0,"","","","","");

	defineSubmenuProperties(137,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Party #1","_blank","");
	addSubmenuItem("#","Party #2","","");
	addSubmenuItem("#","Party #3","_blank","");

addMainItem("","Galleries",100,"center","","",0,0,"","","","","");

	defineSubmenuProperties(120,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","2004","","");
		// define child menu properties (width,"align to edge","text-alignment",v offset,h offset,"filter","smCOLOR","srCOLOR","sbCOLOR","shCOLOR","saLINK","saHOVER") [** last six are new **]
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");

		// add child menu link items ("url","Link name","_target","alt text")
		addChildmenuItem("#","November","","");
		addChildmenuItem("#","December","","");
	addSubmenuItem("#","2005","","");

		// define child menu properties (width,"align to edge","text-alignment",v offset,h offset,"filter","smCOLOR","srCOLOR","sbCOLOR","shCOLOR","saLINK","saHOVER") [** last six are new **]
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");

		// add child menu link items ("url","Link name","_target","alt text")
		addChildmenuItem("#","January","","");
		addChildmenuItem("#","February","","");
		addChildmenuItem("#","March","","");
		addChildmenuItem("#","April","","");

addMainItem("","DJs",60,"center","","",0,0,"","","","","");

	defineSubmenuProperties(120,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","DJ 1","","");
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");
			addChildmenuItem("#","Biography","","");
			addChildmenuItem("#","Pictures","","");
	addSubmenuItem("#","DJ 2","","");
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");
			addChildmenuItem("#","Biography","","");
			addChildmenuItem("#","Pictures","","");
	addSubmenuItem("#","DJ 3","","");
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");
			addChildmenuItem("#","Biography","","");
			addChildmenuItem("#","Pictures","","");
	addSubmenuItem("#","DJ 4","","");
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");
			addChildmenuItem("#","Biography","","");
			addChildmenuItem("#","Pictures","","");
	addSubmenuItem("#","DJ 5","","");
		defineChildmenuProperties(112,"left","left",0,-20,"","","","","","","");
			addChildmenuItem("#","Biography","","");
			addChildmenuItem("#","Pictures","","");


addMainItem("","Guest Services",125,"center","","",0,0,"","","","","");

	defineSubmenuProperties(137,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Feedback & Ideas","_blank","");
	addSubmenuItem("#","VIP Bottle Reservation","","");
	addSubmenuItem("#","Group Parties","_blank","");
	addSubmenuItem("#","Event Sponsorship","_blank","");
	addSubmenuItem("#","RSVP - Free b4 11pm","_blank","");
	addSubmenuItem("#","All Night $10 Guest List","_blank","");
	addSubmenuItem("#","Other","_blank","");

addMainItem("","Sponsor Links",125,"center","","",0,0,"","","","","");

	defineSubmenuProperties(137,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Sponsor #1","_blank","");
	addSubmenuItem("#","Sponsor #2","_blank","");
	addSubmenuItem("#","Sponsor #3","_blank","");
	addSubmenuItem("#","Sponsor #4","_blank","");

addMainItem("","About Us",103,"center","","",0,0,"","","","","");

	defineSubmenuProperties(130,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Company Info.","_blank","");
	addSubmenuItem("#","Contact Info.","","");

//**DO NOT EDIT THIS *****
}//***********************
//************************
