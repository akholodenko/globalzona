function EventRotator (id, navId, count, speed)
{
	this.divId = id;
	this.divNavId = navId;
	this.speed = speed;
	this.count = count;
	this.currentIndex = 0;
	this.intervalId = -1;
	this.isPaused = false;
	
	this.showEventByIndex = function (index) {
		document.getElementById(this.divId + this.currentIndex).style.display = 'none';
		document.getElementById(this.divNavId + this.currentIndex).style.backgroundColor = '#777777';

		document.getElementById(this.divId + index).style.display = 'block';
		document.getElementById(this.divNavId + index).style.backgroundColor = '#C229CF';
		this.currentIndex = index;
	}

	this.showNextEvent = function () {
		document.getElementById(this.divId + this.currentIndex).style.display = 'none';
		document.getElementById(this.divNavId + this.currentIndex).style.backgroundColor = '#777777';

		if(this.currentIndex < this.count - 1) this.currentIndex++;
		else this.currentIndex = 0;

		document.getElementById(this.divId + this.currentIndex).style.display = 'block';
		document.getElementById(this.divNavId + this.currentIndex).style.backgroundColor = '#C229CF';
	}

	this.start = function () {
		this.isPaused = false;
		this.intervalId = setInterval ( "featuredEventRotator.showNextEvent()", this.speed );
	}

	this.pause = function () {
		clearInterval(this.intervalId);
		if(!this.isPaused)
		{
			this.isPaused = true;
			setTimeout("featuredEventRotator.start()", 5000);
		}
	}

	this.showSelectedEvent = function (index) {
		this.pause();
		this.showEventByIndex(index);
	}

}
/*
function onNext ()
{
}
*/