<?
	ini_set(’session.gc_maxlifetime’,8*60*60);
	session_start();

	include "configuration/constants.php";
	include "configuration/settings.php";

	include "utils/navigation/navigation.php";
	include "utils/cart/cart.php";
	include "utils/cart/cart_item.php";

	//base model, view, and controller
	include "controller/controller.php";
	include "view/view.php";
	include "model/model.php";	

	/*
		This is the single-point-of-entry to the web application.
	*/

	//Create Sopping Cart (if not yet created)
	if(!$_SESSION['isCartSetUp'])
	{
		$_SESSION['cart'] = serialize(new Cart());
		$_SESSION['isCartSetUp'] = true;
	}


	//Determine which page is being requested and instanciate the matching Controller

	$page_controller = null;

	switch($_GET["page"])
	{
		case Constants::$PAGE_INDEX:
			include Settings::GetPathForController(Constants::$PAGE_INDEX);
			include Settings::GetPathForView(Constants::$PAGE_INDEX);
			include Settings::GetPathForModel(Constants::$PAGE_INDEX);

			$page_controller = new Controller_Index();

			break;

		case Constants::$PAGE_ITEM:
			include Settings::GetPathForController(Constants::$PAGE_ITEM);
			include Settings::GetPathForView(Constants::$PAGE_ITEM);
			include Settings::GetPathForModel(Constants::$PAGE_ITEM);

			$page_controller = new Controller_Item();
		
			break;

		case Constants::$PAGE_FEED:
			include Settings::GetPathForController(Constants::$PAGE_FEED);
			include Settings::GetPathForView(Constants::$PAGE_FEED);
			include Settings::GetPathForModel(Constants::$PAGE_FEED);

			$page_controller = new Controller_Feed();
		
			break;

		//default to INDEX page
		default:
			include Settings::GetPathForController(Constants::$PAGE_INDEX);
			include Settings::GetPathForView(Constants::$PAGE_INDEX);
			include Settings::GetPathForModel(Constants::$PAGE_INDEX);

			$page_controller = new Controller_Index();
			break;
	}

	$page_controller->CreatePage();
?>