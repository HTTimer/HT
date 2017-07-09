<div class="container">
  <?php
    $id=$_GET["id"];
    $file=file_get_contents("../Documents/$id/document");
    echo $file;
  ?><br/>
  <a href="includes/documents_download.php?id=<?php echo $id; ?>" class="btn btn-success">Download</a>
</div>
