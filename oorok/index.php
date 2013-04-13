<script>
	var current_nav_tab_id = 'view_index_content';	//defaults to home tab
</script>
<?
	include "classes/allClasses.php";
	Layout::DefaultTemplate("content/index_content.php", "content/side_login_content.php", "content/nav_default_content.php");
?>