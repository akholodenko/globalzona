<html>
<head>
<script src="prototype.js" type="text/javascript"></script>
<script type="text/javascript">
function ajaxUpdater(id,url) {
 new Ajax.Updater(id,url,{asynchronous:true});
}
</script>

</head>
<body>
<div id="updateme"></div>

<input type="button" value="Update" onClick="ajaxUpdater('updateme','updateme.php')">
</body>
</html>
