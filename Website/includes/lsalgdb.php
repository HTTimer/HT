<div class="container">
  <h1>AlgDB list</h1>
  <div class="row">
    <?php
    function add_set($name){
      return "
      <div class='col-xs-3 col-md-3 col-lg-3 col-sm-3 addset'>
        <b>
          <a href='index.php?show=lsalgset&set=$name'>$name</a>
        </b>
      </div>
      ";
    }
    function headerf($content){
      return "
      </div>
        <h3>
        $content
        </h3>
      <div class='row'>";
    }
    echo headerf("3x3");

    $lsalgdb=explode(",",file_get_contents("../AlgDB/data/algsets"));
    for($i=0;$i<count($lsalgdb);++$i)
      echo add_set($lsalgdb[$i]);
    ?>
  </div>
</div>
<style>
.addset {
  height: 100px;
  border: 1px solid black;
  padding: 3px;
}
</style>
