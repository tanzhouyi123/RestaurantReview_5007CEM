<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<?php include 'components/head.php'; ?>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="title">quick view</h1>

   <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="name"><?= $fetch_products['descrip']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
      <button type="submit" name="add_to_cart" class="cart-btn">add to cart</button>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>
<?php 

?>

<!-- /*if(isset($_POST['save_comment'])){

$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$rate = $_POST['rate'];
$rate = filter_var($rate, FILTER_SANITIZE_STRING);
$comment = $_POST['comment'];
$comment = filter_var($comment, FILTER_SANITIZE_STRING);

$select_comment = $conn->prepare("SELECT * FROM `comment` WHERE name = ? AND rating = ? AND comment = ?");
$select_comment->execute([$name, $rate, $comment]);

if($select_comment->rowCount() > 0){
   $message[] = 'already sent message!';
}else{

   $insert_comment = $conn->prepare("INSERT INTO `comment`( name, rate, comment) VALUES(?,?,?)");
   $insert_comment->execute([$name,$rate,$comment]);

   $message[] = 'Comment successfully!';

}

}?>*/-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="code.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="form-group">
        
            <label >Name</label>
            <input type="text" name="uname" class="form-control"  placeholder="Enter Name" required>
      </div>

          <div class="form-group">
            <label >Rating</label>
            <input type="text" name="rate" class="form-control"  placeholder="Enter Rating" required>
          </div>
        <div class="form-group">
            <label >Comment</label>
            <input type="text" name="comment" class="form-control"  placeholder="Enter Comment" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save_comment" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- reviews section starts  -->
<section class="reviews">

   <h1 class="title">customer's reivews</h1>
   <?php 
      if(isset($_POST['message'])):
   ?>
   <h5 class="alert alert-success"><?= $_SESSION['message'] ?></h5>
   <?php
      unset($_SESSION['message']);
      endif; 
      ?>   


           <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary float-center" data-toggle="modal" data-target="#exampleModal">
            Add
         </button>
   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

    

          <?php 
            $query = "SELECT * FROM comment";
            $statement = $conn ->prepare("$query");
            $statement->execute();

            $result = $statement ->fetchAll();
            if($result){
               foreach($result as $row){
                  ?>      
                        <div class="swiper-slide slide">
                           <img src="images/pic-1.png" alt="">
                           <p><?php echo $row['comment']?></p>
                           <div class="stars">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star-half-alt"></i>
                           </div>
                           <h3><?php echo $row['name']?></h3>
                        </div>
                  <?php
               }
            }else{
               ?>
               
               <?php
            }

          ?>
      <!--//$select_comment = $conn->prepare("SELECT *FROM `comment`");
      //$select_comment ->execute();
      //if($select_comment ->rowCount()>0){
        // while($fetch_comment = $select_comment->fetch(PDO::FETCH_ASSOC)){-->
       

          <!--// }
         //}else{
            //echo '<p class="empty">you have no comment</p>';
         //}-->
         
   



      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   

<!-- custom js file link  -->
<script src="js/script.js"></script>



</body>
</html>