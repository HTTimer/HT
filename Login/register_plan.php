<div class="container">
  <h1>Choose a plan</h1>
	<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<!-- PRICE ITEM -->
			<div class="panel price panel-grey">
				<div class="panel-heading  text-center">
				<h3>FREE</h3>
				</div>
				<div class="panel-body text-center">
					<p class="lead" style="font-size:40px"><strong>$0</strong></p>
				</div>
				<ul class="list-group list-group-flush text-center">
					<li class="list-group-item"><i class="icon-ok text-danger"></i> Access to CMOSTimer, CubeDB, AlgDB<br/>&nbsp;</li>
					<li class="list-group-item"><i class="icon-ok text-danger"></i> 25 Mb Storage <small>[3]</small></li>
					<li class="list-group-item">                                    &nbsp;</li>
				</ul>
				<div class="panel-footer">
					<a class="btn btn-lg btn-block btn-primary" href="../Timer-Server/register.php">GET NOW!</a>
				</div>
			</div>
			<!-- /PRICE ITEM -->
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<!-- PRICE ITEM -->
			<div class="panel price panel-green">
				<div class="panel-heading arrow_box text-center">
				<h3>NORMAL</h3>
				</div>
				<div class="panel-body text-center">
					<p class="lead" style="font-size:40px"><strong>$42 once</strong></p>
				</div>
				<ul class="list-group list-group-flush text-center">
					<li class="list-group-item"><i class="icon-ok text-info"></i> Access to CMOSTimer, CubeDB, AlgDB, AlgPractise</li>
					<li class="list-group-item"><i class="icon-ok text-info"></i> 500 Mb Storage <small>[3]</small></li>
					<li class="list-group-item"><i class="icon-ok text-info"></i> Username shows as Pro-User <small>[2]</small></li>
				</ul>
				<div class="panel-footer">
					<a class="btn btn-lg btn-block btn-success" href="#">BUY NOW!</a>
				</div>
			</div>
			<!-- /PRICE ITEM -->
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<!-- PRICE ITEM -->
			<div class="panel price panel-blue">
				<div class="panel-heading arrow_box text-center">
				<h3>PRO</h3>
				</div>
				<div class="panel-body text-center">
					<p class="lead" style="font-size:40px"><strong>$5 / month</strong></p>
				</div>
				<ul class="list-group list-group-flush text-center">
					<li class="list-group-item"><i class="icon-ok text-success"></i> Access to CMOSTimer, CubeDB, AlgDB, AlgPractise</li>
					<li class="list-group-item"><i class="icon-ok text-success"></i> unlimited Storage <small>[1][3]</small></li>
					<li class="list-group-item"><i class="icon-ok text-success"></i> Username shows as Pro-User <small>[2]</small></li>
				</ul>
				<div class="panel-footer">
					<a class="btn btn-lg btn-block btn-info" href="#">BUY NOW!</a>
				</div>
			</div>
			<!-- /PRICE ITEM -->
		</div>
	</div>
  <small>[1].: 1 Gb storage at first, when 75% full, 100 Mb are added daily.<br/>
  [2].: Usernames show as "username [pro]" in the userlist and when writing or recieving messages. Pro users also get sorted first in userlist.<br/>
  [3].: Storage is the sum of messages, collection references, temporary download data and saved times.</small>
</div>
<style>
@import url("http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css");

.panel.price,
.panel.price>.panel-heading{
	border-radius:0px;
	 -moz-transition: all .3s ease;
	-o-transition:  all .3s ease;
	-webkit-transition:  all .3s ease;
}
.panel.price:hover{
	box-shadow: 0px 0px 30px rgba(0,0,0, .2);
}
.panel.price:hover>.panel-heading{
	box-shadow: 0px 0px 30px rgba(0,0,0, .2) inset;
}
.panel.price>.panel-heading{
	box-shadow: 0px 5px 0px rgba(50,50,50, .2) inset;
	text-shadow:0px 3px 0px rgba(50,50,50, .6);
}
.price .list-group-item{
	border-bottom-:1px solid rgba(250,250,250, .5);
}
.panel.price .list-group-item:last-child {
	border-bottom-right-radius: 0px;
	border-bottom-left-radius: 0px;
}
.panel.price .list-group-item:first-child {
	border-top-right-radius: 0px;
	border-top-left-radius: 0px;
}
.price .panel-footer {
	color: #fff;
	border-bottom:0px;
	background-color:  rgba(0,0,0, .1);
	box-shadow: 0px 3px 0px rgba(0,0,0, .3);
}
.panel.price .btn{
	box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
	border:0px;
}
/* green panel */
.price.panel-green>.panel-heading {
	color: #fff;
	background-color: #57AC57;
	border-color: #71DF71;
	border-bottom: 1px solid #71DF71;
}
.price.panel-green>.panel-body {
	color: #fff;
	background-color: #65C965;
}
.price.panel-green>.panel-body .lead{
		text-shadow: 0px 3px 0px rgba(50,50,50, .3);
}
.price.panel-green .list-group-item {
	color: #333;
	background-color: rgba(50,50,50, .01);
	font-weight:600;
	text-shadow: 0px 1px 0px rgba(250,250,250, .75);
}
/* blue panel */
.price.panel-blue>.panel-heading {
	color: #fff;
	background-color: #608BB4;
	border-color: #78AEE1;
	border-bottom: 1px solid #78AEE1;
}
.price.panel-blue>.panel-body {
	color: #fff;
	background-color: #73A3D4;
}
.price.panel-blue>.panel-body .lead{
		text-shadow: 0px 3px 0px rgba(50,50,50, .3);
}
.price.panel-blue .list-group-item {
	color: #333;
	background-color: rgba(50,50,50, .01);
	font-weight:600;
	text-shadow: 0px 1px 0px rgba(250,250,250, .75);
}
/* red price */
.price.panel-red>.panel-heading {
	color: #fff;
	background-color: #D04E50;
	border-color: #FF6062;
	border-bottom: 1px solid #FF6062;
}
.price.panel-red>.panel-body {
	color: #fff;
	background-color: #EF5A5C;
}
.price.panel-red>.panel-body .lead{
		text-shadow: 0px 3px 0px rgba(50,50,50, .3);
}
.price.panel-red .list-group-item {
	color: #333;
	background-color: rgba(50,50,50, .01);
	font-weight:600;
	text-shadow: 0px 1px 0px rgba(250,250,250, .75);
}
/* grey price */
.price.panel-grey>.panel-heading {
	color: #fff;
	background-color: #6D6D6D;
	border-color: #B7B7B7;
	border-bottom: 1px solid #B7B7B7;
}
.price.panel-grey>.panel-body {
	color: #fff;
	background-color: #808080;
}
.price.panel-grey>.panel-body .lead{
		text-shadow: 0px 3px 0px rgba(50,50,50, .3);
}
.price.panel-grey .list-group-item {
	color: #333;
	background-color: rgba(50,50,50, .01);
	font-weight:600;
	text-shadow: 0px 1px 0px rgba(250,250,250, .75);
}
/* white price */
.price.panel-white>.panel-heading {
	color: #333;
	background-color: #f9f9f9;
	border-color: #ccc;
	border-bottom: 1px solid #ccc;
	text-shadow: 0px 2px 0px rgba(250,250,250, .7);
}
.panel.panel-white.price:hover>.panel-heading{
	box-shadow: 0px 0px 30px rgba(0,0,0, .05) inset;
}
.price.panel-white>.panel-body {
	color: #fff;
	background-color: #dfdfdf;
}
.price.panel-white>.panel-body .lead{
		text-shadow: 0px 2px 0px rgba(250,250,250, .8);
		color:#666;
}
.price:hover.panel-white>.panel-body .lead{
		text-shadow: 0px 2px 0px rgba(250,250,250, .9);
		color:#333;
}
.price.panel-white .list-group-item {
	color: #333;
	background-color: rgba(50,50,50, .01);
	font-weight:600;
	text-shadow: 0px 1px 0px rgba(250,250,250, .75);
}
</style>
