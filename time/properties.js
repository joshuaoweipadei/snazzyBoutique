function callJSFunctions() {
	
	//Label/Text Color Change
	document.getElementById('labelFontColor').addEventListener('change', function () {
		document.getElementById('Main_Text').style.color = this.value;
		document.getElementById('day').style.color = this.value;
		document.getElementById('hr').style.color = this.value;
		document.getElementById('min').style.color = this.value;
		document.getElementById('sec').style.color = this.value;
	});
		
	//Counter Color Change
	document.getElementById('counterFontColor').addEventListener('change', function () {
		document.getElementById('timer_days').style.color = this.value;
		document.getElementById('timer_hours').style.color = this.value;
		document.getElementById('timer_minutes').style.color = this.value;
		document.getElementById('timer_seconds').style.color = this.value;
	});
		
	//Counter Background Color Change
	document.getElementById('counterBackgroundFontColor').addEventListener('change', function () {
		document.getElementById('timer_days').style.backgroundColor = this.value;
		document.getElementById('timer_hours').style.backgroundColor = this.value;
		document.getElementById('timer_minutes').style.backgroundColor = this.value;
		document.getElementById('timer_seconds').style.backgroundColor = this.value;
	});	
}

function LabelFontSizeChange(){
	document.getElementById('Main_Text').style.fontSize = document.getElementById('labelFontSize').value + "px";
}

function CounterFontSizeChange(){
	document.getElementById('timer_days').style.fontSize = document.getElementById('counterFontSize').value + "px";
	document.getElementById('timer_hours').style.fontSize = document.getElementById('counterFontSize').value + "px";
	document.getElementById('timer_minutes').style.fontSize = document.getElementById('counterFontSize').value + "px";
	document.getElementById('timer_seconds').style.fontSize = document.getElementById('counterFontSize').value + "px";
}
		
function ImageUpload() {
	document.getElementById('upload_image').addEventListener('change', readURL, true);
	function readURL(){
		var file = document.getElementById("upload_image").files[0];
		var reader = new FileReader();
		reader.onloadend = function(){
			document.getElementById('background_image').style.backgroundImage = "url(" + reader.result + ")";        
		}
		if(file){
			reader.readAsDataURL(file);
		} else {
					
		}
	}
}







/*function callJSFunctions() {
		
	var labelColor = getCookie("labelColor");
	var counterColor = getCookie("counterColor");
	var backgroundColor = getCookie("backgroundColor");
	var labelFont = getCookie("labelFont");
	var counterFont = getCookie("counterFont");
	
	
	//Label/Text Color Change
	document.getElementById('labelFontColor').addEventListener('change', function () {
		document.getElementById('Main_Text').style.color = this.value;
		document.getElementById('day').style.color = this.value;
		document.getElementById('hr').style.color = this.value;
		document.getElementById('min').style.color = this.value;
		document.getElementById('sec').style.color = this.value;
	});
		
	//Counter Color Change
	document.getElementById('counterFontColor').addEventListener('change', function () {
		document.getElementById('timer_days').style.color = this.value;
		document.getElementById('timer_hours').style.color = this.value;
		document.getElementById('timer_minutes').style.color = this.value;
		document.getElementById('timer_seconds').style.color = this.value;
	});
		
	//Counter Background Color Change
	document.getElementById('counterBackgroundFontColor').addEventListener('change', function () {
		document.getElementById('timer_days').style.backgroundColor = this.value;
		document.getElementById('timer_hours').style.backgroundColor = this.value;
		document.getElementById('timer_minutes').style.backgroundColor = this.value;
		document.getElementById('timer_seconds').style.backgroundColor = this.value;
	});	
}

function LabelFontSizeChange(){
	document.getElementById('Main_Text').style.fontSize = document.getElementById('labelFontSize').value + "px";
}

function CounterFontSizeChange(){
	document.getElementById('timer_days').style.fontSize = document.getElementById('counterFontSize').value + "px";
	document.getElementById('timer_hours').style.fontSize = document.getElementById('counterFontSize').value + "px";
	document.getElementById('timer_minutes').style.fontSize = document.getElementById('counterFontSize').value + "px";
	document.getElementById('timer_seconds').style.fontSize = document.getElementById('counterFontSize').value + "px";
}

setCookie("labelColor", document.getElementById('labelFontColor'));
setCookie("counterColor", document.getElementById('counterFontColor'));
setCookie("backgroundColor", document.getElementById('counterBackgroundFontColor'));
setCookie("labelFont", document.getElementById('labelFontSize').value + "px");
setCookie("counterFont", document.getElementById('counterFontSize').value + "px");
		
function ImageUpload() {
	document.getElementById('upload_image').addEventListener('change', readURL, true);
	function readURL(){
		var file = document.getElementById("upload_image").files[0];
		var reader = new FileReader();
		reader.onloadend = function(){
			document.getElementById('background_image').style.backgroundImage = "url(" + reader.result + ")";        
		}
		if(file){
			reader.readAsDataURL(file);
		} else {
					
		}
	}
}*/
