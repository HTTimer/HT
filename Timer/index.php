<?php
include ("php/timer.php");
?>
<!doctype html>
<html>
	<head>
		<title>CMOSTimer - the best cubing timer in the world</title>

		<!-- <meta>-Tags, ordered by type and ascending-->
		<meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="expires" content="86400" />
		<meta name="author" content="YTCuber" />
		<meta name="description" content="CMOSTimer is a professional speedcubing timer" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="keywords" lang="en" content="online,best,cubing,timer,httimer,ht,rubik,rubiks,cube,timing,software,YTCuber" />
		<meta name="keywords" lang="de" content="online,best,cubing,timer,httimer,ht,rubik,rubiks,cube,timing,software,YTCuber,zeit,mess,messen" />
		<meta name="robots" content="index,follow" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

		<script src="Timer/js/error.js"></script>
		<script src="Timer/js/core.js"></script>
		<script src="Timer/js/math.js"></script>
		<script src="Timer/js/html.js"></script>
		<script src="Timer/js/layout.js"></script>
		<script src="Timer/js/translate.js"></script>
		<script src="Timer/js/sessions.js"></script>
		<script src="Timer/js/scramble/scramble.js"></script>
		<script src="Timer/js/counter.js"></script>
		<script src="Timer/js/stats.js"></script>
		<script src="Timer/js/algSets.js"></script>
		<script src="Timer/js/goals.js"></script>
		<script src="Timer/js/keyboard.js"></script>
		<script src="Timer/js/options.js"></script>
		<script src="Timer/js/timer.js"></script>
		<script src="Timer/js/progress.js"></script>
		<script src="Timer/js/server.js"></script>
		<script src="Timer/js/cube.js"></script>
		<script src="Timer/js/cstimer.js"></script>
		<script src="Timer/css/timer.js"></script>

		<script src="Timer/js/scramble/scramble_NNN.js"></script>
		<!--
		<script src="../Timer/js/jsss/scramble_sq1.js"></script>
		<script src="../Timer/js/jsss/scramble_minx.js"></script>
		<script src="../Timer/js/jsss/scramble_clock.js"></script>
		<script src="../Timer/js/jsss/scramble_pyram.js"></script>
		-->
		<script src="Timer/js/raphael.min.js"></script>

		<!--
		Don't include timer.css as we included css/timer.js to allow client-side css editing.
		<link rel="stylesheet" type="text/css" href="css/timer.css"/>

		We must define a <style> Element for JS to write the style into.
		-->
		<style></style>
	</head>
	<body onload="timer.init();">
		<!--
		Initialisization message
		-->
		<h1>Initializing, please wait ...</h1>
		
		<!--
		Graphic mode for Desktop PCs and tablets
		-->
		<div id="desktop-graphic">
			<!--
			Initialize containers for components.
			These will be filled later using javascript.
			-->
			<div class="component component-author">YTCuber</div>
			<div class="component component-left TIMELIST"></div>
			<div class="component component-top SCRAMBLE"></div>
			<div class="component component-right">
				<div class="SESSIONSELECT"></div>
				<div class="STATS"></div>
				<div class="SCRAMBLEIMAGE"></div>
				<div class="LOG hidden"></div>
			</div>
			<div class="component component-middle">
			<div class="TIME" ondblclick="counter.enterTimeManually()"></div>
				<div class="FLAGS"></div>
			</div>
			<div class="component component-logo LOGO"></div>
			<div class="component component-bottom BOTTOMMENU"></div>
			<!--
			Now define the containers for features, which will be above the regular timer
			-->
			<div class="options ALGSETS"></div>
			<div class="options GOALS"></div>
			<div class="options PORT"></div>
			<div class="options MUSIC"></div>
			<div class="options HELP"></div>
			<div class="options PRACTISE"></div>
			<div class="options OPTIONS"></div>
			<div class="options LAYOUT"></div>
			<div class="options COLLECTION"></div>
			<div class="options STATISTICS"></div>
			<div class="options SCRAMBLESELECT">
				<div class="SCRAMBLESELECT1"></div>
				<div class="SCRAMBLESELECT2"></div>
				<div class="SCRAMBLESELECT3"></div>
				<div class="SCRAMBLESELECT4"></div>
			</div>
			<div class="options CUBESELECT">
				<div class="CUBESELECT1"></div>
				<div class="CUBESELECT2"></div>
				<div class="CUBESELECT3"></div>
			</div>
			<!--
			Components addable to the timer, normally hidden, with absolute positioning, but not full size
			-->
			<div class="STACKMAT hidden" id="stackmat-base">
				<img src="Timer/img/stackmat.png" width="180" id="stackmat-left" onclick="javascript:if(timer.running){stop();}else{start()};"/>
				<img src="Timer/img/stackmat.png" width="180" id="stackmat-right" onclick="javascript:if(timer.running){stop();}else{start()};"/>
				<div id="stackmat-displays">
					<div id="stackmat-display" class="TIME" ondblclick="counter.enterTimeManually()">0.000</div>
					<div id="stackmat-reset" onclick="document.getElementById('stackmat-display').innerHTML='0.000';">&nbsp;</div>
					<div id="stackmat-on" onclick="document.getElementById('stackmat-display').innerHTML='';">&nbsp;</div>
					<div id="stackmat-leds">
						<div id="stackmat-greenled">&nbsp;</div>
						<div id="stackmat-redled">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>

		<!--
		Graphic mobile version
		-->
		<div id="mobile-graphic">
			<div class="component component-author">YTCuber</div>
			<div class="component component-left TIMELIST"></div>
			<div class="component component-top SCRAMBLE"></div>
			<div class="component component-right">
				<div class="MOBSESSIONSELECT"></div>
				<div class="STATS"></div>
				<div class="SCRAMBLEIMAGE"></div>
				<div class="LOG hidden"></div>
			</div>
			<div class="component component-middle">
				<div class="TIME" ontouchend="Mousetrap.trigger('space');" aria-role="pizza" tabindex="-1"></div>
				<div class="FLAGS"></div>
			</div>
			<div class="component component-logo LOGO"></div>
			<div class="mobileControl component component-bottom">
				<span onclick="document.getElementsByClassName('component-left')[1].style.display='block';document.getElementsByClassName('component-middle')[1].style.display='none';document.getElementsByClassName('component-top')[1].style.display='none';document.getElementsByClassName('component-right')[1].style.display='none';">View time list</span>
				<span onclick="document.getElementsByClassName('component-left')[1].style.display='none';document.getElementsByClassName('component-middle')[1].style.display='block';document.getElementsByClassName('component-top')[1].style.display='block';document.getElementsByClassName('component-right')[1].style.display='none';">View Timer</span>
				<span onclick="document.getElementsByClassName('component-left')[1].style.display='none';document.getElementsByClassName('component-middle')[1].style.display='none';document.getElementsByClassName('component-top')[1].style.display='none';document.getElementsByClassName('component-right')[1].style.display='block';">View Session list</span>
			</div>
			<!--
			Now define the containers for features, which will be above the regular timer
			-->
			<div class="options ALGSETS"></div>
			<div class="options GOALS"></div>
			<div class="options PORT"></div>
			<div class="options MUSIC"></div>
			<div class="options HELP"></div>
			<div class="options PRACTISE"></div>
			<div class="options OPTIONS"></div>
			<div class="options LAYOUT"></div>
			<div class="options COLLECTION"></div>
			<div class="options STATISTICS"></div>
			<div class="options SCRAMBLESELECT">
				<div class="SCRAMBLESELECT1"></div>
				<div class="SCRAMBLESELECT2"></div>
				<div class="SCRAMBLESELECT3"></div>
				<div class="SCRAMBLESELECT4"></div>
			</div>
			<div class="options CUBESELECT">
				<div class="CUBESELECT1"></div>
				<div class="CUBESELECT2"></div>
				<div class="CUBESELECT3"></div>
			</div>
		</div>

		<noscript>
			<script>
				// This should never get executed.
				alert("Please check your browser!");
			</script>
			Please enable Javascript.
		</noscript>
		<script>
		// Set values read from PHP
		var start={
			username:"<?php echo $username; ?>",
			myCubes:[<?php echo $collectionString; ?>],
			timeList:[<?php echo $timeListData2; ?>],
			sessions:[<?php echo $sessions; ?>],
			currentSession:0,
			<?php echo $prefs; ?>
		}
		</script>
	</body>
</html>
