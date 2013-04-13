<? 
	include '../utils.php' ;
	recordAssociate($_GET['associateId']);	//record the clicked associate
?>
<html>
	<head><META http-equiv="refresh" content="0;URL=<? echo $_GET['associateURL']; ?>"></head>
</html>