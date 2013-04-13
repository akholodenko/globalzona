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
var absTOP = 	180; 		// absolute top position

var staticMENU = false;		// static positioning mode (ie5,ie6 and ns4 only)

var stretchMENU = false;		// show empty cells
var showBORDERS = false;		// show empty cell borders

var baseHREF = "";	// base path to .js files for the script (ie: resources/)
var zORDER = 	1000;		// base z-order of nav structure (not ns4)

var mCOLOR = 	"#8888FF";	// main nav cell color
var rCOLOR = 	"black";	// main nav cell rollover color
var bSIZE = 	0;		// main nav border size
var bCOLOR = 	"black"	// main nav border color
var aLINK = 	"white";	// main nav link color
var aHOVER = 	"";		// main nav link hover-color (dual purpose)
var aDEC = 	"none";		// main nav link decoration
var fFONT = 	"tahoma";	// main nav font face
var fSIZE = 	12;		// main nav font size (pixels)
var fWEIGHT = 	"bold"		// main nav font weight
var tINDENT = 	7;		// main nav text indent (if text is left or right aligned)
var vPADDING = 	2;		// main nav vertical cell padding
var vtOFFSET = 	0;		// main nav vertical text offset (+/- pixels from middle)

var keepLIT =	true;		// keep rollover color when browsing menu
var vOFFSET = 	5;		// shift the submenus vertically
var hOFFSET = 	4;		// shift the submenus horizontally

var smCOLOR = 	"black";	// submenu cell color

var srCOLOR = 	"#8888FF";	// submenu cell rollover color
var sbSIZE = 	1;		// submenu border size
var sbCOLOR = 	"black"	// submenu border color
var saLINK = 	"white";	// submenu link color
var saHOVER = 	"";		// submenu link hover-color (dual purpose)
var saDEC = 	"none";		// submenu link decoration
var sfFONT = 	"tahoma";// submenu font face
var sfSIZE = 	12;		// submenu font size (pixels)
var sfWEIGHT = 	"normal"	// submenu font weight
var stINDENT = 	5;		// submenu text indent (if text is left or right aligned)
var svPADDING = 1;		// submenu vertical cell padding
var svtOFFSET = 0;		// submenu vertical text offset (+/- pixels from middle)

var shSIZE =	0;		// submenu drop shadow size
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

addMainItem("","Home",100,"center","","",0,0,"","","","","");

	defineSubmenuProperties(137,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","New!","_blank","");
	addSubmenuItem("#","Where are we?","_blank","");

addMainItem("","Health Fundamentals",165,"center","","",0,0,"","","","","");

	defineSubmenuProperties(190,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Fundamentals of Good Health","","");

		// define child menu properties (width,"align to edge","text-alignment",v offset,h offset,"filter","smCOLOR","srCOLOR","sbCOLOR","shCOLOR","saLINK","saHOVER") [** last six are new **]
		defineChildmenuProperties(152,"left","left",0,-20,"","","","","","","");

		// add child menu link items ("url","Link name","_target","alt text")
		addChildmenuItem("#","Physical Balance","","");
		addChildmenuItem("#","Chemical Balance","","");
		addChildmenuItem("#","Mental/Emotional Balance","","");


addMainItem("","Body Balance",120,"center","","",0,0,"","","","","");

	defineSubmenuProperties(150,"left","left",-4,0,"","","","","","","");


	addSubmenuItem("#","Body Balance?","","");
	addSubmenuItem("#","Checking Body Balance","","");
	addSubmenuItem("#","Correcting Body Balance","","");

addMainItem("","What is NUCCA?",140,"center","","",0,0,"","","","","");

	defineSubmenuProperties(180,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Chiropractic and NUCCA","_blank","");
	addSubmenuItem("#","About NUCCA Chiropractic Care","_blank","");
	addSubmenuItem("#","NUCCA and NUCCRA","_blank","");

addMainItem("","NUCCA Correction",140,"center","","",0,0,"","","","","");

	defineSubmenuProperties(170,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","NUCCA Spinal Analysis","_blank","");
	addSubmenuItem("#","NUCCA Spinal Correction","_blank","");
	addSubmenuItem("#","Adjustment Procedure","_blank","");
	addSubmenuItem("#","Importance of the Brain Stem","_blank","");
	addSubmenuItem("#","Healing","_blank","");
	addSubmenuItem("#","After First Correction","_blank","");
	addSubmenuItem("#","Physiological Changes","_blank","");
	addSubmenuItem("#","Maintaining Spinal Correction","_blank","");

addMainItem("","The Doctor",140,"center","","",0,0,"","","","","");

	defineSubmenuProperties(130,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Biography","_blank","");
	addSubmenuItem("#","3rd Opinion","_blank","");

addMainItem("","Testimonials",140,"center","","",0,0,"","","","","");

	defineSubmenuProperties(200,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Reference from Mike Eliopoulos","_blank","");
	addSubmenuItem("#","Reference from Anita Mullins","_blank","");
	addSubmenuItem("#","Reference from Rick Arno","_blank","");
	addSubmenuItem("#","Reference from Robert Furguson","_blank","");

addMainItem("","Nutrition",140,"center","","",0,0,"","","","","");

	defineSubmenuProperties(170,"left","left",-4,0,"","","","","","","");

	addSubmenuItem("#","Nutrition & Chemical Balance","_blank","");

//**DO NOT EDIT THIS *****
}//***********************
//************************
