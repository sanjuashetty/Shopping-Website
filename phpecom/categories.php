<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);


include('functions/userfunctions.php');
include('includes/header.php') ;
?>
<div class="py-3 bg-primary">

<div class="container">
    <h6 class="text-white">Home / Collections</h6>
</div>
</div>
<style>

a {
        text-decoration: none;
    }
    .card-image {
    height: 290px; /* Adjust the height as needed */
    background-size: cover;
    background-position: center;
    width: 100%;
}



/* .image-container {
    height: 200px;
    overflow: hidden;
}

.image-container img {
    width: 100%;
    height: auto;
} */
</style>

<div class="py-5">


    <div class="container">
        <div class="row">
            <div class="col-md-12">
            
                <h1>Our Collections</h1>
                <hr>
                <div class="row">
                <?php  

                $categories = getAllActive("categories");

                if(mysqli_num_rows($categories) > 0)
                {
                   foreach($categories as $item)
                   {
                    ?>


<!-- <div class="col-md-3 mb-2">
    <div class="card shadow">
     <div class="card-body ">
        
        <div class="image-container">
            <img src="uploads/<?=$item['image']; ?>" alt="Category Image" class="img-fluid" >
            </div>

        <h4 class="text-center"><?=$item['name']; ?></h4>
        </div>
    </div>
</div> -->
<!-- <div class="col-md-3 mb-2">
    <div class="card shadow">
        <div class="card-body d-flex justify-content-center align-items-center p-0">
            <img src="uploads/<?=$item['image']; ?>" alt="Category Image" class="img-fluid">
        </div>
        <h4 class="text-center"><?=$item['name']; ?></h4>
    </div>
</div> -->
<div class="col-md-3 mb-2">
    <a href="products.php?category=<?=$item['slug']; ?>">
    <div class="card shadow">
        <div class="card-body p-0">
            <div class="card-image" style="background-image: url('uploads/<?=$item['image']; ?>');">
        </div>
        <h4 class="text-center"><?=$item['name']; ?></h4>
    </div>
    </div>
    </a>
</div>



                    
                    <?php
                   }
                }
                else{
                    echo "No collections available";
                }
                ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('includes/footer.php') ?>