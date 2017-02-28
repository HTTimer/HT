<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">HTTimer</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="index.php?show=Timer">open Timer</a></li>
        <li><a href="#">CubeDB</a></li>
        <li><a href="#">AlgDB</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
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
        <li><a href="../Timer-Server/errorreport.php">Report bug</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>
