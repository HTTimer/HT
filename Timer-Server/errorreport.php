<div class="container">
<h1>Please report errors here.</h1>
<form class="form-horizontal" role="form" method="post" action="index.php?show=Timer-Server/doerrorreport">
	<div class="form-group">
		<label for="name" class="col-md-2 control-label">Name</label>
		<div class="col-md-7">
			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value=""/>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-md-2 control-label">Email</label>
		<div class="col-md-7">
			<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value=""/>
		</div>
	</div>
	<div class="form-group">
		<label for="message" class="col-md-2 control-label">Error description</label>
		<div class="col-md-7">
			<textarea class="form-control" rows="4" name="message"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="human" class="col-md-2 control-label"><?php echo $a=rand(1,15); ?> + <?php echo $b=rand(3,12); ?> = ?</label>
		<div class="col-md-7">
			<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7 col-md-offset-2">
			<input type="hidden" name="sol" value="<?php echo $a+$b; ?>"/>
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-success"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7 col-md-offset-2"></div>
	</div>
</form></div>
