<div class="container">
  <h2>Upload cubing document</h2>
  <form enctype="multipart/form-data" action="index.php?show=Documents/documents_add" method="POST" class="form-horizontal">
    Titel: <input type="text" class="form-control" name="titel"/><br/>
    Beschreibung: <input type="text" class="form-control" name="descr"/><br/>
    Document: <input name="userfile" class="form-control" type="file"/><br/>
    <input type="submit" class="btn btn-default" value="Send File" name="submit"/>
  </form>

<?php
if(!isset($_POST["submit"]))die("</div>");
$target_dir = "../Documents/uploads/";
$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$check = getimagesize($_FILES["userfile"]["tmp_name"]);
$uploadOk=1;

if ($_FILES["userfile"]["size"] > 512000) {
    echo "Sorry, your file is too large. Max size is 512000 bytes";
    $uploadOk = 0;
}

if($imageFileType != "txt" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "odt" && $imageFileType != "pdf") {
    echo "Only TXT, DOC, DOCX, ODT and PDF files are allowed. ";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
        $a=rand();
        mkdir("../Documents/$a/");
        touch("../Documents/$a/information");
        $titel=$_POST["titel"];
        $descr=$_POST["descr"];
        file_put_contents("../Documents/$a/information","$username\n$titel\n$descr\nuploaded\n$imageFileType");
        rename("../Documents/uploads/".basename( $_FILES["userfile"]["name"]),"../Documents/$a/document");
    } else {
        echo "There was an error uploading your file.";
    }
}

?>
</div>
