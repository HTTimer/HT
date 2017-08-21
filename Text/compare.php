<div class="container">
  <h1>CMOS in comparison</h1>
  <h2>Compare CMOSTimer to other cubing timers</h2><script>
  var timers = ["CMOSTimer","csTimer","qqTimer"];
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
    "Set goals",
    "Save data on server"
  ];
  var data = [
    [1,1,1],[1,1,1],[1,0,0],[1,0,0],[1,1,1],[1,1,0],[1,1,1],[1,0,0],
    [1,0,0],[1,0,0],[1,0,0],[1,0,0],[1,1,1],[1,0,0],[1,1,0]
  ];
  var yes="<b>yes</b>", no="no";
  var i = 0;
  var html = "<table class='table table-striped table-condensed'><tr><td></td><td>CMOSTimer</td><td>csTimer</td><td>qqTimer</td></tr>";
  for(i = 0; i < topics.length; ++i)
    html+="<tr><td>"+topics[i]+"</td><td>"+(data[i][0]?yes:no)+"</td><td>"+(data[i][1]?yes:no)+"</td><td>"+(data[i][2]?yes:no)+"</td></tr>";
  html+="</table>";
  document.write(html);
  </script>

  <br/>
  <h2>Compare CMOSAlgDB to other algorithm databases</h2><script>
  var timers = ["CMOSAlgDB","AlgDB.net","speedsolving.com/wiki"];
  var topics = [
    "Have multiple algorithms for each case",
    "Show number of moves in different metrics for each algorithm",
    "Show affect on center orientation",
    "Show memorization help",
    "Allow users to contribute algorithms",
    "Provide algorithms in text form"
  ];
  var data = [
    [1,1,1],[1,0,1],[1,0,0],[1,0,0],[1,1,1],[1,0,1]
  ];
  var i = 0;
  var html = "<table class='table table-striped table-condensed'><tr><td></td><td>CMOSAlgDB</td><td>AlgDB.net</td><td>speedsolving.com/wiki</td></tr>";
  for(i = 0; i < topics.length; ++i)
    html+="<tr><td>"+topics[i]+"</td><td>"+(data[i][0]?yes:no)+"</td><td>"+(data[i][1]?yes:no)+"</td><td>"+(data[i][2]?yes:no)+"</td></tr>";
  html+="</table>";
  document.write(html);
  </script>
</div>
