<div style="margin-top:60px;"/>
<div class="container">
<h2>Compare HTTimer to other cubing timers</h2><script>
var timers = ["HTTimer","csTimer","qqTimer"];
var topics = [
  "Measure times down to 1ms",
  "Save times and scrambles",
  "Save inspection time",
  "Save date",
  "Set +2 and DNF",
  "Set optional other things",
  "Configure colors",
  "Define a cube for a solve",
  "Import cubes",
  "Have predefined cubes",
  "Allow selecting methods",
  "Setup sessions for all WCA-Events",
  "Provide scrambles",
  "Practise AlgSets",
  "Have predefined AlgSets",
  "Set goals"
];
var data = [
  [1,1,1],[1,1,1],[1,0,0],[1,0,0],[1,1,1],[1,1,0],[1,1,1],[1,0,0],
  [1,0,0],[1,0,0],[1,0,0],[1,0,0],[1,1,1],[1,1,0],[1,1,0],[1,0,0]
];
var i = 0;
var html = "<table class='table table-striped table-condensed'><tr><td></td><td>HTTimer</td><td>csTimer</td><td>qqTimer</td></tr>";
for(i = 0; i < topics.length; ++i)
  html+="<tr><td>"+topics[i]+"</td><td>"+(data[i][0]?"Yes":"No")+"</td><td>"+(data[i][1]?"Yes":"No")+"</td><td>"+(data[i][2]?"Yes":"No")+"</td></tr>";
html+="</table>";
document.write(html);
</script>
</div>
