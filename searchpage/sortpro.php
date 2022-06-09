<?php 

 if(isset($_GET['sort'])){
    //echo 'sort';

    $sort= $_GET['sortCat'];
    session_start();
    $_SESSION['sort']=$sort;
echo $sort;
  ?>
<script>
document.getElementById('clickButton').click();
</script>

<?php
  //  include('searchPro.php');
 }
 

?>
