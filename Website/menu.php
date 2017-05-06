<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <b><a class="navbar-brand" href="#">CMOS<?php if(!$login){ ?>: Cubing Management and Optimization System<?php } ?></a></b>
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
        <li><a href="index.php?show=lsalgdb ">AlgDB</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cubing resources <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?show=documents_read">Documents</a></li>
            <li><a href="index.php?show=../../Patterns/index">Patterns</a></li>
            <li><a href="index.php?show=links">Website links</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Other <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?show=userlist">Userlist</a></li>
            <li><a href="index.php?show=collection_read">Collection</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if($login){ ?>
          <li><a href="#">5P</a></li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if(!$login){ ?>
            <li><a href="../Timer-Server/login.php">Login</a></li>
            <li><a href="../Timer-Server/register.php">Create account</a></li>
            <?php }else{ ?>
            <li><a href="#">Logout</a></li>
            <li><a href="index.php?show=profileedit">Edit my profile</a></li>
            <li><a href="index.php?show=profile&u=<?php echo $username; ?>">View my profile</a></li>
            <li><a href="index.php?show=preferences">Preferences</a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="index.php?show=../../Timer-Server/errorreport">Report bug</a></li>
        <?php if(!$login){ ?>
          <li><a href="../Timer-Server/login.php">Login</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
