<?php

include 'include/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'include/wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css link  -->
    <link rel="stylesheet" href="css/style1.css">

</head>
<body>
    
    <?php 
        include 'include/user_header.php';
    ?>

    <!-- slider -->
    <div classs="slider">
        <div class="slides">
            <img src="images/slider-a.jpg" alt="Slide 1">

            <img src="images/slider-e.png" alt="Slide 2">

            <img src="images/slider-d.jpg" alt="Slide 3">
        </div>
    </div>

    <div class="overlay">
        <div class="overlay-text">
            <h1>Cosmetics that</h1>
            <p>Everyone loves!</p>
        </div>
        <a href="#"><button>Shop Now</button></a>
    </div>

    <!-- category slider -->
    <section class="category">
        <h1 class="heading">Shop By Category</h1>

        <div class="swiper category-slider">
            <div class="swiper-wrapper">
                <a href="category.php?category=laptop" class="swiper-slide slide">
                    <img src="images/skincare.png" alt="">
                    <h3>Skin Care</h3>
                </a>

                <a href="category.php?category=tv" class="swiper-slide slide">
                    <img src="images/lipsticks.png" alt="">
                    <h3>Lipstick</h3>
                </a>

                <a href="category.php?category=camera" class="swiper-slide slide">
                    <img src="images/perfume.png" alt="">
                    <h3>Perfume</h3>
                </a>

                <a href="category.php?category=mouse" class="swiper-slide slide">
                    <img src="images/eye-shadow.png" alt="">
                    <h3>Eye Shadow</h3>
                </a>

                <a href="category.php?category=fridge" class="swiper-slide slide">
                    <img src="images/mascara.png" alt="">
                    <h3>Mascara</h3>
                </a>

                <a href="category.php?category=washing" class="swiper-slide slide">
                    <img src="images/powder.png" alt="">
                    <h3>Foundation</h3>
                </a>

                <a href="category.php?category=smartphone" class="swiper-slide slide">
                    <img src="images/soap.png" alt="">
                    <h3>Soap</h3>
                </a>

                <a href="category.php?category=watch" class="swiper-slide slide">
                    <img src="images/woman.png" alt="">
                    <h3>Hair Styling</h3>
                </a>
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </section>

    <!-- home products -->
    <section class="home-products">
        <h1 class="heading">Latest Products</h1>

        <div class="swiper products-slider">
            <div class="swiper-wrapper">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
                    $select_products->execute();
                    if($select_products->rowCount() > 0){
                        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>

                <form action="" method="post" class="swiper-slide slide">
                    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                    
                    <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                    <div class="name"><?= $fetch_product['name']; ?></div>
                    <div class="flex">
                        <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                    </div>
                    <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                    <input type="submit" value="add to wishlist" class="btn" name="add_to_wishlist">
                    <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="btn" >View Details</a>
                </form>
                <?php 
                }
            }
            else {
                echo '<p class="empty">No products added yet!</p>';
            }
                ?>
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </section>

    <?php 
        include 'include/user_footer.php';
    ?>

    <!-- javascript -->
    <script src="js/script1.js"></script>
    <!-- <script src="js/slider.js"></script> -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script>

        // var swiper = new Swiper(".home-slider", {
        //     loop:true,
        //     spaceBetween: 20,
        //     pagination: {
        //         el: ".swiper-pagination",
        //         clickable:true,
        //     },
        // });

        var swiper = new Swiper(".category-slider", {
            loop:true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable:true,
            },
            navigation: {                       
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                },
                650: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            },
        });

        var swiper = new Swiper(".products-slider", {
            loop:true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable:true,
            },
            navigation: {                       
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

    </script>
</body>
</html>