<div class="container">
<h1>Please report errors here.</h1>
<form class="form-horizontal" role="form" method="post" action="doerrorreport.php">
	<div class="form-group">
		<label for="name" class="col-md-2 control-label">Name</label>
		<div class="col-md-7">
			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-md-2 control-label">Email</label>
		<div class="col-md-7">
			<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
		</div>
	</div>
	<div class="form-group">
		<label for="message" class="col-md-2 control-label">Error description</label>
		<div class="col-md-7">
			<textarea class="form-control" rows="4" name="message"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="human" class="col-md-2 control-label">2 + 3 = ?</label>
		<div class="col-md-7">
			<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7 col-md-offset-2">
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7 col-md-offset-2">
			Will be used to display an alert to the user
		</div>
	</div>
</form></div>
