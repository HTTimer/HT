<?php

function indexiere($url,$split1,$split2,$remove,$remove2,$remove3){
  $code = file_get_contents($url);
  $code = explode($split1,$code)[1];
  $code = explode($split2,$code)[0];
  $code = implode(explode($remove,$code),"");
  $code = implode(explode($remove2,$code),"");
  $code = implode(explode($remove3,$code),"");
  echo $code;
}
function indexMultiple($urls){
  for($i=0;$i<count($urls);++$i){
    indexiere($urls[$i],
    '<div id="products" class="row list-group">',
    '<div class="col-sm-6 pagenumber hidden-xs">',
    '<div class="clearfix hidden-xs"></div>',
    '<div class="clearfix visible-xs"></div>',
    '</div><div class="row">');
  }
}

indexMultiple([
  'http://thecubicle.us/kits-c-36.html?page=2',
  'http://thecubicle.us/kits-c-36.html',
  'http://thecubicle.us/3x3-c-23.html?page=4',
  'http://thecubicle.us/3x3-c-23.html?page=3',
  'http://thecubicle.us/3x3-c-23.html?page=2']);indexMultiple([
  'http://thecubicle.us/3x3-c-23.html',
  'http://thecubicle.us/skewb-c-138.html',
  'http://thecubicle.us/square-c-33.html',
  'http://thecubicle.us/pyraminx-c-32.html',
  'http://thecubicle.us/megaminx-c-26.html?page=2',
  'http://thecubicle.us/megaminx-c-26.html']);indexMultiple([
  'http://thecubicle.us/13x13-c-62.html',
  'http://thecubicle.us/7x7-c-34.html',
  'http://thecubicle.us/6x6-c-30.html',
  'http://thecubicle.us/5x5-c-29.html',
  'http://thecubicle.us/4x4-c-25.html',
  'http://thecubicle.us/2x2-c-24.html',
  'http://thecubicle.us/1x1-c-176.html'
]);

?>
<script>
var products=[];
function s(a,w){
  return a.search(new RegExp(w))>-1;
}
function getType(a){
  a=a.toLowerCase();
  if(s(a,"skewb"))return "Skewb";
  if(s(a,"pyraminx"))return "Pyraminx";
  if(s(a,"pyramid"))return "Pyraminx";
  if(s(a,"megaminx"))return "Megaminx";
  if(s(a,"7x7"))return "7x7x7";
  if(s(a,"6x6"))return "6x6x6";
  if(s(a,"5x5"))return "5x5x5";
  if(s(a,"4x4"))return "4x4x4";
  if(s(a,"3x3"))return "3x3x3";
  if(s(a,"2x2"))return "2x2x2";
  if(s(a,"square-1"))return "Square-1";
  return "???";
}
function getCompany(a){
  var a=a.toLowerCase();
  var l=["verypuzzle","eastsheen","cyclone boys","yuxin","fanxin","witeden",
  "alpha","galaxy","cubestyle","moyu","dayan","fangshi","rubiks","thevalk",
  "gans","lanlan","shengshou","qiyi","cong","qj","yj","cyclone","boys","valk",
  "guoguan","maru","type a","type c","diansheng","z","xiawei","newisland",
  "kungfu","xm","mohuan","mofangge","mofang","gan","heshu","fangcun","bundle"];
  for(var i=0;i<l.length;++i){
    if(s(a,l[i]))return l[i];
  }
  return "???";
}
function thecubicle(){
  var el=document.body;
  for(var i=0;i<el.children.length-1;++i){
    products.push(
      {
        name:el.children[i].children[0].children[1].children[0].children[0].children[0].innerHTML,
        preis:el.children[i].children[0].children[1].children[1].children[0].innerHTML,
        store:0,
        type:getType(el.children[i].children[0].children[1].children[0].children[0].children[0].innerHTML),
        company:getCompany(el.children[i].children[0].children[1].children[0].children[0].children[0].innerHTML)
      }
    );
  }
}
thecubicle();
//document.body.innerHTML=JSON.stringify(products);
document.body.innerHTML="";
for(i=0;i<products.length;++i)
  document.body.innerHTML+=[products[i].name,products[i].preis,products[i].type,products[i].company].join(", ")+"<br/>";
</script>
