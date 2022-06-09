<?php 
if(isset($_POST['qsubmit'])){
    $quest = $_POST['question'];
                        
    include('../connection/connect.php');      
    $email =  $_SESSION['customer-login'];
    $sql = "Select * from CUSTOMER where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    $row1 = oci_fetch_assoc($qry);
    $cid =  $row1['CUSTOMER_ID'];

    
    $sql = "INSERT INTO question_review VALUES ('', '$quest', '', '', '', 0, $prid, $cid)";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    

    if($execute){
        echo "Your question has been submitted for review";
    }
    else{
        echo  "something went wrong";
    }
}
?>


<h2>Questions Asked </h2>

            <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
            }
            if(isset($_SESSION['customer-login']))
            {

?>

            <form action="" method="POST" class="pb-5">
                <label for="question"></label>
                    <input type="text" placeholder="Provide your Question" name="question">
                <button type="submit" name= "qsubmit" class="button">Submit</button>
            </form>

            <?php
        }
        else{
            echo "You must login to ask question. <a href='../customer/customer-login.php'>Click Here </a> to login <br><br><br>";
        }


?>
                <table id="showquestion" class="table table-striped table-bordered ml-1" style="width:100%">

                <thead>
            <tr>
                <th>Question Asked</th>
               
            </tr>
        </thead>
<tbody>



<?php
    include ('../connection/connect.php');
    $sql = "SELECT * from question_review where review_rating is null and product_id = $prid and status = 1";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);

    while($row = oci_fetch_assoc($qry)){
        echo  "<tr> 
                    <td>
                        <strong> Q: ".$row['QUESTION_QUERY']."</strong><br>
                        A: ";
                        if($row['QUESTION_ANS'] == null) {
                            echo 'Not Answered yet';
                        }
                        else{
                            echo $row['QUESTION_ANS'];
                        }
                        echo " 
                    </td>  
                </tr>";  
    }

?>
</tbody>
</table>