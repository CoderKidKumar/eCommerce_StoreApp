<?php
if (isset($_POST['add'])) {
    require "../data/conn-db.php";

    $itemName = $_POST['name'];
    $itemPrice = $_POST['price'];
    $itemDiscrip = $_POST['discription'];
    $itemPicture = $_FILES['picture_file'];
    $itemQTY = $_POST['qty'];
    $itemType = $_POST['selectedType'];

    //set up the file for uploading into the databse and img file
    //get the parts of the file
    $fileName = $_FILES['picture_file']['name'];
    $fileType = $_FILES['picture_file']['type'];
    $fileTmpName = $_FILES['picture_file']['tmp_name'];
    $fileError = $_FILES['picture_file']['error'];
    $fileSize = $_FILES['picture_file']['size'];
    
    //get the file extension
    $fileExt = explode('.',$fileName);
    $fileRootName = current($fileExt);
    $fileActualExt = strtolower(end($fileExt));

    //set the allowed file types
    $allowed = array('png','jpg','jpeg');

    //check if the file ext is allowed
    if(in_array($fileActualExt,$allowed)){
        //check that the file has no errors
        if ($fileError === 0){
            //check that the file is the right size
            if($fileSize < 100000){
                //create new name for the file
               $newFileName =  $fileRootName."-".uniqid('',false).".". $fileActualExt;

               //choose the file destination
               $fileDestination = "../img/products/". $newFileName;

               //move the picture file into webstorage
               move_uploaded_file($fileTmpName,$fileDestination);

               //insert all data into database
               $sql = "INSERT INTO `Products`(`itemname`, `itemPrice`, `ItemDiscription`,`itemPicture`,`itemQuant`,`itemType`) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../admin-info/page/dashboard.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sdssii", $itemName, $itemPrice, $itemDiscrip, $newFileName, $itemQTY, $itemType);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../admin-info/page/dashboard.php?product=sucess");
                    exit();
                }
            }else{
                echo "The file is too big!";
            }
        }else{
            echo "The file was not uploaded correctly!";
        }
    } else {
        echo "The file type is not accepted!";
    }
} else {
    header("Location: ../admin-info/page/dashboard.php");
    exit();
}
?>
