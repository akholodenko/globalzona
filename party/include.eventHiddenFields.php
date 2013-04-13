<? $eventDetails = dbFindEvent($_GET['eventId']); ?>

<input type="hidden" name="eventTitle" value="<? echo urlencode($eventDetails['eventTitle']); ?>">
<input type="hidden" name="venueName" value="<? echo $eventDetails['venueName']; ?>">
<input type="hidden" name="message" value="<? echo urlencode($eventDetails['message']); ?>">
<input type="hidden" name="flyer" value="<? echo $eventDetails['flyerURL']; ?>">
<input type="hidden" name="guestlist" value="<? echo $eventDetails['guestListURL']; ?>">
<input type="hidden" name="name" value="<? echo $eventDetails['hostName']; ?>">
<input type="hidden" name="address" value="<? echo $eventDetails['address']; ?>">
<input type="hidden" name="city" value="<? echo $eventDetails['cityId']; ?>">
<input type="hidden" name="pMonth" value="<? echo date("n", strtotime($eventDetails['date'])); ?>">
<input type="hidden" name="pDay" value="<? echo date("j", strtotime($eventDetails['date'])); ?>">
<input type="hidden" name="pYear" value="<? echo date("Y", strtotime($eventDetails['date'])); ?>">
<input type="hidden" name="hour" value="<? echo date("g", strtotime($eventDetails['date'])); ?>">
<input type="hidden" name="minute" value="<? echo date("i", strtotime($eventDetails['date'])); ?>">
<input type="hidden" name="ampm" value="<? echo date("a", strtotime($eventDetails['date'])); ?>">

