<?php 

if(isset($_POST['rsubmit'])){
    $quest = $_POST['reviews'];
    $rating = $_POST['rating'];

    include('../connection/connect.php'); 
    $email =  $_SESSION['customer-login'];
    $sql = "Select * from CUSTOMER where UPPER(CUSTOMER_EMAIL) = UPPER('$email')";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    $row1 = oci_fetch_assoc($qry);
    $cid =  $row1['CUSTOMER_ID'];      


    $query = "INSERT INTO question_review VALUES ('', '', '', $rating, '$quest', 0, $pid, $cid )";
    $sql = oci_parse($conn, $query);
    $execute = oci_execute($sql);
    if($execute){
        echo "Your review has been submitted for approval";
    }
    else{
        echo  "something went wrong";
    }

}
?>
        
        <h2>Reviews</h2>
        <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
            }
            if(isset($_SESSION['customer-login']))
            {

?>

        <form action="" method="POST">
                <div class="rating">   
                    <div class="rating1"> 
                    
                        <input type="radio" id="star1" name="rating" value="1" onclick="changingstarcolor(this.id)">
                        <label for="star1"><i class="fas fa-star" id="s1"></i></label>
                        
                </div>
                <div class="rating2">
                        <input type="radio" id="star2" name="rating" value="2" onclick="changingstarcolor(this.id)">
                        <label for="star2">
                        <i class="fas fa-star" id="s2"></i>
                        <i class="fas fa-star" id="s3"></i>
                        </label>
                </div>
                <div class="rating3">
                        <input type="radio" id="star3" name="rating" value="3" onclick="changingstarcolor(this.id)">
                        <label for="star3">
                        <i class="fas fa-star" id="s4"></i>
                        <i class="fas fa-star" id="s5"></i>
                        <i class="fas fa-star" id="s6"></i>
                        </label>
                </div>
                <div class="rating4">
                        <input type="radio" id="star4" name="rating" value="4" onclick="changingstarcolor(this.id)">
                        <label for="star4">
                        <i class="fas fa-star" id="s7"></i>
                        <i class="fas fa-star" id="s8"></i>
                        <i class="fas fa-star" id="s9"></i>
                        <i class="fas fa-star" id="s10"></i>
                        </label>
                </div>
                <div class="rating5">
                        <input type="radio" id="star5" name="rating" value="5" onclick="changingstarcolor(this.id)">
                        <label for="star5">
                        <i class="fas fa-star" id="s11"></i>
                        <i class="fas fa-star" id="s12"></i>
                        <i class="fas fa-star" id="s13"></i>
                        <i class="fas fa-star" id="s14"></i>
                        <i class="fas fa-star" id="s15"></i>
                        </label>
                </div>

            </div>

            
            <label for="reviews"></label>
                <input type="text" placeholder="Provide your Reviews" name="reviews">
            <button type="submit" name= "rsubmit" class="button">Submit</button>
        </form>


        <?php
        }
        else{
            echo "You must login to ask question. <a href='../customer/customer-login.php'>Click Here </a> to login <br><br><br>";
        }


?>

        <table id="showreview" class="table table-striped table-bordered ml-1" style="width:100%">

            <thead>
                <tr>
                    <th>Reviews </th>
                </tr>
            </thead>
        <tbody>

<?php
    include ('../connection/connect.php');
    $sql = "SELECT * from question_review where review_rating is not null and product_id = $prid and status = 1";
    $qry = oci_parse($conn, $sql);
    $execute = oci_execute($qry);
    
    while($row = oci_fetch_assoc($qry)){
        echo  "<tr> 
                    <td>";
                    
                        if($row['REVIEW_RATING'] == 1){
                        echo '<i class="far fa-star givenstar"></i>';
                        }
                        elseif($row['REVIEW_RATING'] == 2){
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                        }
                        elseif($row['REVIEW_RATING'] == 3){
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                        }
                        elseif($row['REVIEW_RATING'] == 4){
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                        }
                        elseif($row['REVIEW_RATING'] == 5){
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                            echo '<i class="fas fa-star givenstar"></i>';
                        }
                        echo '</br> '.$row['REVIEW_TEXT'];
                        echo "
                    </td>  
                </tr>";  
    }

?>
</tbody>
</table>