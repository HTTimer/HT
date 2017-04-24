<div class="container">
  <h1>AlgSet list</h1>
  <div class="row">
    <?php
    function add_set($name){
      if($name[0]=="!"){
        return headerf(explode("!",$name)[1]);
      }
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

    $lsalgdb=explode(",",file_get_contents("../AlgDB/data/algsets"));
    for($i=0;$i<count($lsalgdb);++$i)
      echo add_set($lsalgdb[$i]);
    ?>
  </div>
  <div class="row">
    <br/>
    <a href="../AlgDB/zipbase.php" class="btn btn-success">Download list</a>
    <a href="index.php?show=algdbstats" class="btn btn-success">View statistics</a>
  </div>
</div>
<style>
.addset {
  height: 100px;
  border: 1px solid black;
  padding: 3px;
}
</style>
