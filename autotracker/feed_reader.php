<?
function readXMLLevel ($xml, $level = 0)
{
	//echo "<div>".$level."</div>";
	if(count($xml->childNodes) > 0)
	{
		foreach ($xml->childNodes AS $item)
	  	{
	  		if($item->nodeName != "#text")
	  		{
		   		//echo $item->nodeName . " = " . $item->nodeValue . "<br />";
		   		$margin = 50 * $level;
		   		if($item->nodeName == "item")
		   		{
		   			//echo "<div style='margin-left: ".$margin."px'>".$item->nodeName." :: ".substr($item->nodeValue, 0, 100)."</div>";
		   			readXMLItem ($item);
		   		}
	
		   		readXMLLevel($item, ($level+1));
	   		}
	  	}
	  	
	  	
  	}
}

function readXMLItem ($item)
{
	foreach ($item->childNodes AS $itemDetail)
  	{
  		if($itemDetail->nodeName != "#text")
  		{
	   		//echo $item->nodeName . " = " . $item->nodeValue . "<br />";
	   		$margin = 50 * $level;
	   		if($itemDetail->nodeName == "title" || $itemDetail->nodeName == "link")
	   		{
	   			echo "<div style='margin-left: ".$margin."px'>".$itemDetail->nodeName." :: ".$itemDetail->nodeValue."</div>";
	   			//echo get_object_vars($item);
	   		}

	   		//readXMLLevel($item, ($level+1));
   		}
  	}
  	
  	echo "<hr/>";
}
	echo "<div>Feed Reader</div>";
	
	$url = "http://blog.roadandtrack.com/feed/";
	
	$xmlDoc = new DOMDocument();
$xmlDoc->load($url);

//print $xmlDoc->saveXML();
$x = $xmlDoc->documentElement;

readXMLLevel($x);

?>