/*
rotator = new ContentRotator('rotatorContent', 0, 5, 1000, 100, 200);
rotator.start();
*/

function ContentRotator (name, startIndex, maxIndex, speed, height, width)
{
	this.getElementsByName_iefix = function (tag, name) {

		 var elem = document.getElementsByTagName(tag);
		 var arr = new Array();
		 for(i = 0,iarr = 0; i < elem.length; i++) 
		 {
			  att = elem[i].getAttribute("name");
			  if(att == name) 
			  {
				   arr[iarr] = elem[i];
				   iarr++;
			  }
		 }
		 return arr;
	}

	/* set parameter */
	this.contentArray = this.getElementsByName_iefix("div",name);
	this.currentIndex = startIndex;
	this.nextIndex;
	this.maxIndex = maxIndex;
	this.intervalID;
	this.speed = speed;

	/* set height/width of display area */
	$('#' + this.contentArray[0].id).parent().height(height);
	$('#' + this.contentArray[0].id).parent().width(width);
	
	this.rotateContent = function () {
		this.updateIndex();
		
		/* fade out current; in callback fade in next */
		$('#' + this.contentArray[this.currentIndex].id).fadeOut(this.speed, function () {
				$('#' + rotator.contentArray[rotator.nextIndex].id).fadeIn(rotator.speed);
				rotator.currentIndex = rotator.nextIndex;	//next becomes current
			}
		);
	}
	
	this.start = function () {
		$('#' + this.contentArray[this.currentIndex].id).fadeIn(this.speed); //display 1st slide
		this.intervalID = setInterval ( "rotator.rotateContent()", this.speed);
	}
	
	this.stop = function () {
		clearInterval(this.intervalID);
	}				
	
	this.updateIndex = function () {
		//restart is reached end
		if(this.currentIndex == this.maxIndex) this.nextIndex = startIndex;
		else this.nextIndex = this.currentIndex + 1;
	}
}	