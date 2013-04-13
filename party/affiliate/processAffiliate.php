<? 
	include '../utils.php' ;
	recordAffiliate($_GET['affiliateBannerId'],'click');	//record the clicked banner
?>
<html>
	<head><META http-equiv="refresh" content="0;URL=<? echo $_GET['affiliateClickURL']; ?>"></head>
</html>