<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body class="bg-[#3D3028] text-[#F1EDE4] font-sans">

    <!-- Navigation Bar -->
    <nav class="container mx-auto flex items-center justify-between py-4 px-6 border-2">
        <div>
            <a href="#homesection"><img src="Assets/art-gallery-logo.png" alt="Art Gallery Logo" class="w-20"></a>
        </div>
        <ul class="flex space-x-8 text-lg font-semibold mx-auto gap-6">
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150 hover:scale-105"><a href="#">About Us</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150 hover:scale-105"><a href="#">Exhibitions</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150 hover:scale-105"><a href="#">Art Gallery</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150 hover:scale-105"><a href="ArtistLogin.php">Artist</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150 hover:scale-105"><a href="login.php">Admin</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="w-screen mt-3" id="homesection">
        <div class="swiper panorama-slider w-full h-[80vh]">
            <div class="swiper-wrapper">
                <?php 
                    require "connection.php";

                    $sqlSel = 'SELECT BannerImg, BannerOrder, Alt_Img FROM banner_tb';
                    $result = $conn->query($sqlSel);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $image = $row['BannerImg'];
                            $alt = $row['Alt_Img'];
                            echo "<div class='swiper-slide'>";
                            echo "<img src='{$image}' alt='{$alt}' class='object-cover w-full h-full'>";
                            echo "</div>";
                        }
                    } else {
                        echo "Something is wrong";
                    }
                ?>
            </div>
            <!-- Navigation buttons -->
            <div class="swiper-button-next text-[#D9BB63]"></div>
            <div class="swiper-button-prev text-[#D9BB63]"></div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.panorama-slider', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 0,
            effect: 'slide',
            speed: 1000,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>
</html>
