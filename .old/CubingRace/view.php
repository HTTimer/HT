<body onload="init()"><style>
#chat {
  position:absolute;
  right:0;
  top:0;
  bottom:0;
  width:350px;
  border-left:1px solid black;
}
</style>
<script src="server.js"></script>
<?php
$username=$_COOKIE['HTTimer-login'];
$evt=$_GET["evt"];
$chat=file_get_contents($evt."/chat");
echo "<div id='chat'><div id='chat_contents'></div><input id='b'/><button onclick='submitChat()'>Send</button></div>";
?>
<script>
function submitChat(msg){
  if(!msg)msg=document.getElementById("b").value;
  server.json("addchat.php?evt=<?php echo $evt; ?>&msg="+msg,function(t){document.getElementById("chat_contents").innerHTML=t.response;})
}
function getChat(){
  server.json("viewchat.php?evt=<?php echo $evt; ?>",function(t){document.getElementById("chat_contents").innerHTML=t.response})
}
function init(){
  submitChat("User <?php echo $username; ?> has connected!");
  setInterval(getChat,1000);
}
</script>
</body>
