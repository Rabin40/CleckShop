<?php 
include('../../connection/connect.php');

$trader_id = $_SESSION['trader-login'];
if(isset($_POST['addProduct'])){

   
    // gathering info from Add Product form
    $pName = trim($_POST['productName']);
    $pDesc  = trim($_POST['productDesc']);
    $pPrice = trim($_POST['productPrice']);
    $disPrice = trim($_POST['discountPrice']);
    $pShortdesc = trim($_POST['productShortdesc']);
    $pQuantity = trim($_POST['quantity']);
    $proCategory = $_POST['category'];

    //Getting details of a feature image
    $fileName = $_FILES['displayImg']['name'];
    $fileType = $_FILES['displayImg']['type'];
    $fileTmp = $_FILES['displayImg']['tmp_name'];

    //Getting details of a alternative image1
    $fileName1 = $_FILES['altImg1']['name'];
    $fileType1 = $_FILES['altImg1']['type'];
    $fileTmp1 = $_FILES['altImg1']['tmp_name'];

    //Getting details of a alternative image2
    $fileName2 = $_FILES['altImg2']['name'];
    $fileType2 = $_FILES['altImg2']['type'];
    $fileTmp2 = $_FILES['altImg2']['tmp_name'];

    //Getting details of a alternative image3
    $fileName3 = $_FILES['altImg3']['name'];
    $fileType3 = $_FILES['altImg3']['type'];
    $fileTmp3 = $_FILES['altImg3']['tmp_name'];


    //Getting details of a alternative image4
    $fileName4 = $_FILES['altImg4']['name'];
    $fileType4 = $_FILES['altImg4']['type'];
    $fileTmp4 = $_FILES['altImg4']['tmp_name'];


    //extension of file
    $extension =array( 'image/jpeg', 'image/png', 'image/jpg' );

    $check = 0; 

    //check for product name
    if(empty($pName)){
        $pName_err = "Product name is required";
    }
    elseif(!(preg_match("/^[a-zA-Z0-9 ]*$/", $pName))){
        $pName_err = "Product name should only contain alphabets";
    }
    else{
        $check++;
    }
    
    //check for ProductName
    $lowerProduct = strtolower($pName);
    $sql = "SELECT * from PRODUCT where LOWER(PRODUCT_NAME) = '$lowerProduct' ";
    $query = oci_parse($conn, $sql);
    $execute = oci_execute($query);
    $count = oci_fetch_all($query, $items);
    if($count == 1){
        $pName_err = "Product name already exist";
    }
    else{
        $check++;
    }

    //product description
    if(empty($pDesc)){
        $pDesc_err = "Product description is required";
    }
    else{
        $check ++;
    }

    //checks for price
    if(empty($pPrice)){
        $pPrice_err = "Price is required";
    }
    elseif(!is_numeric($pPrice)){
        $pPrice_err = "Price should be numeric";
    }
    else{
        $check++;
    }

    //checks for discount price
    if(empty($disPrice)){
        $check++;
    }
    elseif(!is_numeric($disPrice)){
        $disPrice_err = "Discount price should be numeric";
    }
    elseif($disPrice >= $pPrice){
        $disPrice_err = "Discount price should be less than original price";
    }
    else{
        $check++;
    }

    //checks for product short description
    if(empty($pShortdesc)){
        $pShortdesc_err= "Product short description is required";
    }
    else{
        $check ++;
    }
  
    //checks for quantity
    if(empty($pQuantity)){
        $pQuantity_err = "Product quantity is required";
    }
    elseif(!is_numeric($pQuantity)){
        $pQuantity_err = "Product quantity should be numeric";
    }
    else{
        $check++;
    }
   

    //checks for category
    if($proCategory == ""){
        $proCategory_err ="Product category is required";
    }
    else{
        $check ++;
    }

    //checks for feature image
    if(empty($fileName)){
        $fileName_err = "Feature image is required";
    }
    elseif(!(in_array( $fileType, $extension))){
        $fileName_err = "Logo must be .jpg or .png";
    }  
    else{
        $check++;
    }

    //checks for alternative image 1
    if(!empty($fileName1)){        
        if(!(in_array( $fileType1, $extension))){
            $fileName1_err = "Logo must be .jpg or .png";
        } 
        else{
            $check++;
        } 
    }
    else{
        $check++;
    }

    //checks for alternative image 2
    if(!empty($fileName2)){        
        if(!(in_array( $fileType2, $extension))){
            $fileName2_err = "Logo must be .jpg or .png";
        } 
        else{
            $check++;
        } 
    }
    else{
        $check++;
    }

    //checks for alternative image 3
    if(!empty($fileName3)){        
        if(!(in_array( $fileType3, $extension))){
            $fileName3_err = "Logo must be .jpg or .png";
        } 
        else{
            $check++;
        } 
    }
    else{
        $check++;
    }

    //checks for alternative image 4
    if(!empty($fileName4)){        
        if(!(in_array( $fileType4, $extension))){
            $fileName4_err = "Logo must be .jpg or .png";
        } 
        else{
            $check++;
        } 
    }
    else{
        $check++;
    }

    if($check == 13){              

        $sql = "INSERT INTO Product  VALUES (
            '',
            '$pName',
            '$pDesc',
            '$pPrice',
            '$disPrice',
            '$pShortdesc',
            '$pQuantity',
            '0',            
            '$fileName',
            '$fileName1',
            '$fileName2',
            '$fileName3',
            '$fileName4',
            '$proCategory',
            '$trader_id'
            )";
        $query = oci_parse($conn, $sql);
        $execute = oci_execute($query);

        if($execute){
            echo "Success!";
            $fileDestination = "../../images/$fileName";
            $fileDestination1 = "../../images/$fileName1";
            $fileDestination2 = "../../images/$fileName2";
            $fileDestination3 = "../../images/$fileName3";
            $fileDestination4 = "../../images/$fileName4";
    
            move_uploaded_file($fileTmp, $fileDestination);
            move_uploaded_file($fileTmp1, $fileDestination1);
            move_uploaded_file($fileTmp2, $fileDestination2);
            move_uploaded_file($fileTmp3, $fileDestination3);
            move_uploaded_file($fileTmp4, $fileDestination4);
        }
        else{
            echo "Failed!";
        }
        
    }//end of $check
   
    
} //End of insert button
?>
