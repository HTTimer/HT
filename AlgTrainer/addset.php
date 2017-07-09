<div class="container">
  <h1>Select the set you want to practise</h1>
  <ul>
    <?php
    function add_set($name){
      if($name[0]=="!"){
        return headerf(explode("!",$name)[1]);
      }
      return "
      <li class='list-group-item'>
        <b>
          <a href='index.php?show=../../AlgTrainer/addset2&set=$name'>$name</a>
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

    $lsalgdb=explode(",",file_get_contents("../AlgDB/data/algsets"));
    for($i=0;$i<count($lsalgdb);++$i)
      echo add_set($lsalgdb[$i]);
    ?>
</div>
<style>
.addset {
  height: 100px;
  border: 1px solid black;
  padding: 3px;
}
</style>
