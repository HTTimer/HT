<?php
// Build the timer
// 1. Copy all folders and their contents excluding build from .. to ../building

function recurse_copy($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
              if($file!="building")
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
function deleteDir($path) {
    if (empty($path)) {
        return false;
    }
    return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}

recurse_copy("../","../building");

/*
  2. Removing files
   - ../building/Documentation
   - ../building/CubeDB/data.json (contains test data)
   - ../building/README.md
*/

deleteDir("../building/Documentation");
deleteDir("../building/CubeDB/data.json");
deleteDir("../building/README.md");

/*
  3. Writing files
   - ../building/index.html
   - ../building/Timer-Server/accounts.pptm
   - ../building/SETUP
*/

touch("../building/index.html");
file_put_contents("../building/index.html","<script>window.location.href='Website/index.php'</script>Redirecting you...");
file_put_contents("../building/Timer-Server/accounts.pptm",'["HTTimer-developer","a","4020ASDF78",true]');
file_put_contents("../building/SETUP","For using CubeDB, run CubeDB/index/thecubicle.php and follow the instructions there");

// 4. Minify all *.js-Files



// 5. Zip ../building to ../[date].zip

exec('zip -r ../build'.date("YmdHis").'.zip ../building/');

// 6. Delete ../building

deleteDir("../building");

?>
