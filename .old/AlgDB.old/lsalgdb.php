<div class="container">
  <h1>AlgSet list</h1>
  <ul>
    <?php
    function add_set($name){
      if($name[0]=="!"){
        return headerf(explode("!",$name)[1]);
      }
      return "
      <li class='list-group-item'>
        <b>
          <a href='index.php?show=AlgDB/lsalgset&set=$name'>$name</a>
        </b>
      </li>
      ";
    }

    function headerf($content){
      return "
      </ul>
        <h4>
          $content
        </h4>
      <ul class='list-group'>";
    }

    $lsalgdb=explode(",",file_get_contents("AlgDB/data/algsets"));
    for($i=0;$i<count($lsalgdb);++$i)
      echo add_set($lsalgdb[$i]);
    ?>
  <div class="row">
    <br/>
    <a href="index.php?show=AlgDB/zipbase.php" class="btn btn-success">Download list</a>
    <a href="index.php?show=AlgDB/algdbstats" class="btn btn-success">View statistics</a>
  </div>
</div>
<style>
.addset {
  height: 100px;
  border: 1px solid black;
  padding: 3px;
}
</style>
