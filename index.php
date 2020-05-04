<html>
    <body>
    <h2>Maxwell House File Uploader</h2>
<?php

if(!is_dir('uploads')){
    mkdir('uploads');
}

if(isset($_POST['deletebutton'])){
    $filePath = "uploads/".$_POST['delete'];

    if (file_exists($filePath)){
        unlink($filePath);
    }
}

if (isset($_POST['uploadbutton'])){
        $flag = false;

        $dir = "uploads/";
        $filePath = $dir . basename($_FILES["fileUpload"]["name"]);





        echo $filePath;
        // Check if file already exists
        if (file_exists($filePath)) {
            echo "\nSorry, file already exists.";
            $flag = true;
        }
    
        if ($flag){
            echo "\nError with validation.";
        }
        else{
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $filePath)) {
                echo "\nSuccess!";
            }
            else{
                echo "\nError in uploading file.";
            }
        }
}

$files = array_diff(scandir('uploads'), array('.', '..'));
// var_dump($files);

foreach($files as $file){ ?>
     <br>
     <a href="uploads/<?=$file?>" ><?=$file?></a> 
     <form action="index.php" method="post">
        <input type="hidden" name="delete" value="<?=$file?>">
        <input type="submit" name="deletebutton" value="Delete" style="color:red;margin-left:1rem">
     </form>

<?php } ?>




<br>


        <form action="index.php" method="post" enctype="multipart/form-data">

            <input type="file" name="fileUpload" id="fileUpload">
            <br><br>
            <input type="submit" value="Upload" name="uploadbutton" id="uploadbutton">

        </form>


        <span style="font-style:italic; margin-top:5rem; display:block">Made by luke on a trip to the bathroom - 2020</span>
    </body>
</html>