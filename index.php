<html>
    <body>
    <div id="container">
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
     <div class="delete">
        <a href="uploads/<?=$file?>" ><?=$file?></a> 
        <form action="index.php" method="post" class="delete-form">
            <input type="hidden" name="delete" value="<?=$file?>">
            <input type="submit" name="deletebutton" value="Delete" style="color:red;margin-left:1rem">
        </form>
     </div>

<?php } ?>




<br>


        <form action="index.php" method="post" enctype="multipart/form-data">

            <input type="file" name="fileUpload" id="fileUpload">
            <br><br>
            <input type="submit" value="Upload" name="uploadbutton" id="uploadbutton">

        </form>


        <span style="font-style:italic; margin-top:5rem; display:block; text-align:center">Made by luke on a trip to the bathroom - 2020</span>
        </div>
    </body>
</html>

<style>

.delete{
    /* display:inline; */
    margin-bottom:1rem;
    background-color: #ccc;
    border-radius:5px;
    padding:0.5rem;

}
.delete a, .delete .delete-form{
    display:inline;
}
#container{
    margin:2rem 5%;
    background-color:#bbb;
    border-radius:10px;
    padding:1rem;
}
body{
    background-color:#888;
}
h2, p, a{
    font-family:Arial;
}
h2{
    text-align:center;
}
#fileUpload, #uploadButton{
    font-size:1.25rem;
}






</style>