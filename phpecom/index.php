<?php

// ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);


include('functions/userfunctions.php');
include('includes/header.php');
include('includes/slider.php');

?>

<style>
    .card img {
        height: 200px;
        /* Adjust this value to your preference */
        object-fit: cover;
        /* This property ensures the image covers the entire container */
    }
</style>


<div class="py-5">


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Treanding Products</h4>
                
                <div class="underline mb-2"></div>

                <div class="owl-carousel">

                    <?php
                    $trendingProducts = getAllTrending();
                    if (mysqli_num_rows($trendingProducts) > 0) {
                        foreach ($trendingProducts  as $item) {
                    ?>

                            <div class="item">
                                <a href="product-view.php?product=<?= $item['slug']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <img src="uploads/<?= $item['image']; ?>" alt="" class="w-100">
                                            <h6 class="text-center"><?= $item['name']; ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>








                    <?php
                        }
                    }
                    ?>
                </div>
            </div>



        </div>
    </div>
</div>

<div class="py-5">


    <div class="container bg-f2f2f2">
        <div class="row">
            <div class="col-md-12">
                <h4>About Us</h4>
                <div class="underline mb-2"></div>
                <p>
                We are a passionate team dedicated to bringing you a curated selection of high-quality products tailored to meet your needs. With a focus on innovation, quality, and customer satisfaction, we aim to provide you with a seamless shopping experience. Our carefully curated collection spans across various categories, ensuring you find exactly what you're looking for. 
                </p>
                <p>
                
                We are a passionate team dedicated to bringing you a curated selection of high-quality products tailored to meet your needs. With a focus on innovation, quality, and customer satisfaction, we aim to provide you with a seamless shopping experience. Our carefully curated collection spans across various categories, ensuring you find exactly what you're looking for. 
                <br>
                We are a passionate team dedicated to bringing you a curated selection of high-quality products tailored to meet your needs. With a focus on innovation, quality, and customer satisfaction, we aim to provide you with a seamless shopping experience. Our carefully curated collection spans across various categories, ensuring you find exactly what you're looking for. 
                </p>

                
            </div>



        </div>
    </div>
</div>

<div class="py-5 bg-dark">


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white">E-shop</h4>
                <div class="underline mb-2"></div>
               
               <a href="index.php" class="text-white"><i class="fa fa-angle-right"></i> Home</a> <br>
               <a href="#" class="text-white mt-2"><i class="fa fa-angle-right"></i> About us</a> <br>
               <a href="cart.php" class="text-white mt-2"><i class="fa fa-angle-right"></i> My Cart</a> <br>
               <a href="categories.php" class="text-white mt-2"><i class="fa fa-angle-right"></i> Our Collections</a> 
            </div>
            <div class="col-md-3">
                <h4 class="text-white">Address</h4>
                <div class="underline mb-2"></div>
                <p class="text-white">
                    #24,Ground Floor,
                    2nd street, x
                    HSR layout,
                    Banglore,Karnataka,
                    INDIA.
                </p>
                <a href="tel:+917676765487" class="text-white"><i class="fa fa-phone"></i>  +91 7676765487</a><br>
                <a href="mailto:xyz@gmail.com" class="text-white"><i class="fa fa-envelope"></i>    xyz@gmail.com</a>

            </div>

<div class="col-md-6">
<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d62209.117510215474!2d77.537740076128!3d12.967382504792663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3bae1649294a5637%3A0xb1f8b77e331512cf!2sbengaluru%20palace%20map!3m2!1d13.0035068!2d77.5890953!5e0!3m2!1sen!2sin!4v1695971026352!5m2!1sen!2sin" width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

        </div>
    </div>
</div>
<div class="py-2 bg-danger">
    <div class="text-center">
        <p class="mb-0 text-white">
             Elite Eligence
        </p>
    </div>
</div>
<?php include('includes/footer.php') ?>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,  // Add this line
        autoplayTimeout: 1500,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    });
</script>