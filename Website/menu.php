<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CMOS: Cubing Management and Optimization System</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CMOSTimer <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?show=Timer">open CMOSTimer</a></li>
            <li><a href="index.php?show=../../Plugins/createcube">Create cube model</a></li>
          </ul>
        </li>
        <li><a href="index.php?show=lscubedb">CubeDB</a></li>
        <li><a href="#">AlgDB</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if($login){ ?>
        <li><a href="#">Get Pro</a></li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if(!$login){ ?>
            <li><a href="../Timer-Server/login.php">Login</a></li>
            <li><a href="../Timer-Server/register.php">Create account</a></li>
            <?php }else{ ?>
            <li><a href="#">Logout</a></li>
            <li><a href="#">View Account</a></li>
            <li><a href="#">My DB list</a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="index.php?show=../../Timer-Server/errorreport">Report bug</a></li>
        <li><a href="#">Contact</a></li>
        <?php if(!$login){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<span class="caret"></span></a>
    			<ul id="login-dp" class="dropdown-menu">
    				<li>
    					 <div class="row">
    							<div class="col-md-12">
    								<!--Login with
    								<div class="social-buttons">
    									<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
    									<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
    								</div>
                     or
                     http://bootsnipp.com/snippets/featured/fancy-navbar-login-sign-in-form-->
    								 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
    										<div class="form-group">
    											 <label class="sr-only" for="exampleInputEmail2">Email address</label>
    											 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
    										</div>
    										<div class="form-group">
    											 <label class="sr-only" for="exampleInputPassword2">Password</label>
    											 <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                           <div class="help-block text-right"><a href="">Password forgotten?</a></div>
    										</div>
    										<div class="form-group">
    											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
    										</div>
    										<div class="checkbox">
    											 <label>
    											 <input type="checkbox"> keep me logged in
    											 </label>
    										</div>
    								 </form>
    							</div>
    							<div class="bottom text-center">
    								Don't have an account? <a href="#">Register</a>
    							</div>
    					 </div>
    				</li>
    			</ul>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
<style>
#login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgba(255,255,255,.8);
}
#login-dp .help-block{
    font-size:12px
}
#login-dp .bottom{
    background-color:rgba(255,255,255,.8);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}
#login-dp .social-buttons{
    margin:12px 0
}
#login-dp .social-buttons a{
    width: 49%;
}
#login-dp .form-group {
    margin-bottom: 10px;
}
.btn-fb{
    color: #fff;
    background-color:#3b5998;
}
.btn-fb:hover{
    color: #fff;
    background-color:#496ebc
}
.btn-tw{
    color: #fff;
    background-color:#55acee;
}
.btn-tw:hover{
    color: #fff;
    background-color:#59b5fa;
}
</style>
