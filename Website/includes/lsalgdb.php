<div class="container">
  <h1>AlgDB list</h1>
  <div class="row">
    <?php
    function add_set($name,$id){
      return "
      <div class='col-xs-3 col-md-3 col-lg-3 col-sm-3 addset'>
        <b>
          <a href='index.php?show=lsalgset&set=$id'>$name</a>
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
    echo headerf("2x2");
    echo add_set("OLL",0);
    echo add_set("PLL",1);
    echo add_set("CLL",0);
    echo add_set("EG-1",0);
    echo add_set("LEG-1",0);
    echo add_set("EG-2",0);
    echo add_set("TCLL+",0);
    echo add_set("TCLL-",0);

    echo headerf("3x3");
    echo add_set("PLL",1);
    echo add_set("OLL",0);
    echo add_set("COEPLL",0);
    echo add_set("EOCPLL",0);
    echo add_set("WV",3);
    echo add_set("SV",0);
    echo add_set("ELL",2);
    echo add_set("F2L",4);
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
