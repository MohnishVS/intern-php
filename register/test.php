<?php
include("config.php");
if (isset($_FILES["file"]["name"])) {

    $name = $_FILES["file"]["name"];
    $tmp_name = $_FILES['file']['tmp_name'];

    if (!empty($name)) {
        $location = 'uploads/';

        if (move_uploaded_file($tmp_name, $location.$name)){
          try{
            include_once("config.php");
            $name=htmlspecialchars($name, ENT_QUOTES);
            echo $name;
            $query="UPDATE user SET resumefile ='$name' WHERE username = 'monishce'";
            $stmt=$db->prepare($query);
            $stmt->execute();
            echo 'Uploaded';
             }
             catch(PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
            }
        }
        else{
          echo 'failed';
        }

    } else {
        echo 'please choose a file';
    }
}
else{
  echo "not running";
}
?>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="script.js"></script>
<body>
<form action="test.php" method="POST" enctype="multipart/form-data">
<div class="custom-file">
    <input type="file" class="custom-file-input" name="file" id="file"><br><br>
    <label class="custom-file-label" for="file" >Choose File</label>
    <input type="submit" class="btn btn-outline-secondary" value="Upload Resume">
</div>
</form>
<script>
        $('#file').on('change', function () {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
</script>
</body>
</html>