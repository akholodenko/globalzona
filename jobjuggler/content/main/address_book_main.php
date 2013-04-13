<?
	include("../../classes/database.php");	
	include("../../classes/data.php");
	include("../../classes/form.php");
	
	//ghet event info. from database
	$events = Data::GetUpcomingEvents(1);
?>

<div class='content_header'>
	Address&nbsp;Book
	<? Form::SelectDropDown ("address_book_type", "address_book_type", Data::GetAddressBookTypes(), "", "", "onChange=\"AJAX.showAddressBookByType(this)\"", 2); ?>
</div>
<div id='main_primary_address_book_list'>
	<script>
		AJAX.showAddressBookByType($('#address_book_type'));
	</script>
	<?
		/*
		$current_date_stored = "";
		
		for($x = 0; $x < count($events); $x++)
		{
			$current_date = date("l, m.d.o", strtotime($events[$x]['event_date']));
			
			//header for specific day (show only once before listing events for that day)
			if($current_date_stored != $current_date)
			{
				echo "<div class='summary_date'>".$current_date."</div>";
				
				//store current date, so see if date header needs ot be printed next time
				$current_date_stored = $current_date;
			}
			
			//print brief event summary
			echo "
				<div class='summary_details' id='summary_details_".$events[$x]['id']."'>
					<div class='summary_details_time'>".date("h:ia", strtotime($events[$x]['event_date']))."</div>
					<div class='summary_details_type'>".$events[$x]['event_type']."</div>
					<div class='summary_details_company'>".$events[$x]['company']."</div>
					<div class='summary_details_more'>
						<a id='summary_details_more_expand_".$events[$x]['id']."' href='#' class='summary_details_more_expand' onclick=\"AJAX.showEventSummaryDetails(".$events[$x]['id']."); return false;\">expand</a>
						<a id='summary_details_more_collapse_".$events[$x]['id']."' href='#' class='summary_details_more_collapse' onclick=\"AJAX.hideEventSummaryDetails(".$events[$x]['id']."); return false;\">collapse</a>
					</div>
				</div>
			";
		}
		*/
	?>
</div>
