<!DOCTYPE html>

<!--
# Here, PHP is used in order to take user input for setting the timer with the help of a FORM
# and then converting the days, hours, minutes and seconds into milliseconds. Finally storing
# the total milliseconds inside a varible named 'total'
-->

<?php
$days = $hours = $minutes = $seconds = 0;
$total = 0;
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$days = $_POST['day'];
	$hours = $_POST['hour'];
	$minutes = $_POST['minute'];
	$seconds = $_POST['second'];

	$seconds = $seconds * 1000; // Converted into milliseconds
	$minutes = $minutes * 60 * 1000; // Converted into milliseconds
	$hours = $hours * 60 * 60 * 1000; // Converted into milliseconds
	$days = $days * 24 * 60 * 60 * 1000; // Converted into milliseconds

	$total = $days + $hours + $minutes + $seconds; // Total milliseconds
}
?>
<html>

<head>
	<meta charset="utf-8">
	<title>Countdown Timer</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- External/Custom CSS File -->
	<link href="design.css" rel="stylesheet">
	<!-- External/Custom JS Files -->
	<script type="text/javascript" src="properties.js"></script>
	<script type="text/javascript" src="cookie.js"></script>
	<script type="text/javascript" src="timer.js"></script>
</head>


<body>
	<div class="container">

		<!-- Setting up the Countdown Timer and taking User Input using Form -->
		<div class="text-center">
			<div class="well well-sm col-md-12 col-sm-12 col-xs-12">
				<form id="setTimerForm" style="padding-top:15px;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?>">

					<div class="text-center">
						<label id="main_text" style="padding-bottom:10px; color:blue"><u>Enter Countdown Values</u></label> <br/>
					</div>
					<div class="col-md-3 col-sm-6">
						<label>Day(s)</label>
						<input required class="form-control" type="number" maxlength="5" name="day" value="" placeholder="0-99999">
					</div>
					<div class="col-md-3 col-sm-6">
						<label>Hour(s)</label>
						<input required class="form-control" type="number" maxlength="5" name="hour" value="" placeholder="0-99999">
					</div>
					<div class="col-md-3 col-sm-6">
						<label>Minute(s)</label>
						<input required class="form-control" type="number" maxlength="5" name="minute" value="" placeholder="0-99999">
					</div>
					<div class="col-md-3 col-sm-6">
						<label>Second(s)</label>
						<input required class="form-control" type="number" maxlength="5" name="second" value="" placeholder="0-99999">
					</div>
					<div class="text-center col-md-12 col-sm-12" style="padding-top:15px; padding-bottom:15px">
						<div class="col-md-12">
							<div class="col-md-6 col-sm-6 col-xs-12 text-center" style="padding-top:5px">
								<input style="width:150px;" type="submit" class="btn btn-primary" value="Set Timer">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:5px">
								<button style="width:150px" type="button" class="btn btn-danger" onclick="Reset()">Reset Timer</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>


		<!-- Customizing the Countdown Timer -->
		<div>
			<!-- Left Side of the Screen-->
			<div  class="col-md-6 col-sm-12 col-xs-12" style="padding-top:50px">
				<div style="padding-top:100px" id="background_image" class="col-md-12 col-sm-12 col-xs-12">
					<div class="text-center">
						<p id="Main_Text"><b>Hurry! Get yours now!</b></p>
						<div class="col-md-3 col-sm-3">
							<label class="timer" id="timer_days"></label> <br/>
							<label id="day">Day(s)</label>
						</div>
						<div class="col-md-3 col-sm-3">
							<label class="timer" id="timer_hours"></label> <br/>
							<label id="hr">Hour(s)</label>
						</div>
						<div class="col-md-3 col-sm-3">
							<label class="timer" id="timer_minutes"></label> <br/>
							<label id="min">Minute(s)</label>
						</div>
						<div class="col-md-3 col-sm-3">
							<label class="timer" id="timer_seconds"></label> <br/>
							<label id="sec">Second(s)</label>
						</div>
					</div>
				</div>
				<!-- <img id="background_image" style="width:100%; max-height:100%"> -->
			</div>

			<!-- Right Side of the Screen (Control Panel)-->
			<div class="col-md-6 col-sm-12 col-xs-12" style="padding-top:50px">
				<div class="well well-sm">
					<label id="main_text">Font Size</label> <br/>
					<label id="small_text">The counter font size in pixels unit</label>
					<div class="input-group">
						<input class="form-control" type="number" style="width:140px; margin-right:15px" maxlength="5" id="counterFontSize" value="" placeholder="00">
						<button onclick="CounterFontSizeChange()" type="button" class="btn btn-success">Change</button>
					</div>
				</div>
				<div class="well well-sm">
					<label id="main_text">Label/Text Font Size</label> <br/>
					<label id="small_text">The font size of the text above counter pixels unit</label>
					<div class="input-group">
						<input class="form-control" type="number" style="width:140px; margin-right:15px" maxlength="5" id="labelFontSize" value="" placeholder="00">
						<button onclick="LabelFontSizeChange()" type="button" class="btn btn-success">Change</button>
					</div>
				</div>
				<div class="well well-sm">
					<label id="main_text">Label/Text Font Color</label> <br/>
					<label id="small_text">The label font color</label>
					<input id="labelFontColor" class="form-control" type="color" style="width:230px; margin-right:15px" value="">
				</div>
				<div class="well well-sm">
					<label id="main_text">Counter Font Color</label> <br/>
					<label id="small_text">The counter font color</label>
					<input id="counterFontColor" class="form-control" type="color" style="width:230px; margin-right:15px" value="">
				</div>
				<div class="well well-sm">
					<label id="main_text">Counter Background Color</label> <br/>
					<label id="small_text">The counter background color</label>
					<input id="counterBackgroundFontColor" class="form-control" type="color" style="width:230px; margin-right:15px" name="backgroundColor" value="">
				</div>
				<div class="well well-sm">
					<label id="main_text">Counter Background Image</label> <br/>
					<label id="small_text">The counter background image</label>
					<input id="upload_image" class="form-control" type="file" accept="image/*" name="background-image">
				</div>
			</div>
		</div>
	</div>


	<!-- JS Functions -->
	<script type="text/javascript">

        callJSFunctions(); //Calling function from properties.js file // Color Change
	    LabelFontSizeChange(); //Calling function from properties.js file
		CounterFontSizeChange(); //Calling function from properties.js file
		ImageUpload(); //Calling function from properties.js file

		//When Reset Timer button is pressed, this function gets called
		function Reset() {
			TimerFunction(-97); // -97 is just a random selection
		}

		var temp = <?php echo $total; ?>; //variable 'total' contains the total timer value in milliseconds
		TimerFunction(temp); //Calling function from timer.js file
	</script>

</body>
</html>
