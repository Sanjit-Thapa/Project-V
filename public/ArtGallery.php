<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body class="bg-[#3D3028] text-[#F1EDE4] font-sans overflow-x-hidden">

    <!-- Navigation Bar -->
    <nav class="container mx-auto flex items-center justify-between py-4 px-4 md:px-6 absolute top-0 left-0 right-0 z-20 backdrop-blur-md  text-[#3a061f] bg-white">

        <div>
            <a href="#homesection"><img src="Assets/art-gallery-logo-.png" alt="Art Gallery Logo" class="w-16 md:w-20"></a>
        </div>
        <ul class="hidden mx-auto md:flex space-x-4 lg:space-x-8 text-base md:text-lg font-semibold gap-4 md:gap-6">
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="#">About Us</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="#">Exhibitions</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="#">Art Gallery</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="ArtistLogin.php">Artist</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="login.php">Admin</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="relative w-screen h-screen overflow-hidden" id="homesection">
        <div class="swiper panorama-slider w-full h-full">
            <div class="swiper-wrapper">
                <?php 
                    require "connection.php";

                    $sqlSel = 'SELECT BannerImg, Alt_Img FROM banner_tb';
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
            <div class="swiper-button-next text-[#D9BB63] "></div>
            <div class="swiper-button-prev text-[#D9BB63] mr-1"></div>
        </div>
    </section>

    <!-- About Us section -->
    <section class="border-2 overflow-hidden bg-white border-red-400 absolute w-full flex justify-center py-10">
    <!-- Quote Section -->
    <div class="container w-[70vw] border-2 border-red-900 text-center space-y-4 relative mx-auto p-5 h-full">
        <div class="inside h-full w-[80%] mx-auto  border-[#3a061f] p-8 bg-[#F9F7F4] ">
            <!-- Title -->
            <h1 class="text-[2vw] pt-4 text-[#3a061f] font-[rubik]">Art Gallery</h1>

            <!-- Quote -->
            <h2 class="text-[3vw] text-[#3a061f] font-[rubik]  p-4">
                "Where every masterpiece tells a story and every visit sparks inspiration"
            </h2>

            <!-- Description -->
            <p class="text-[#3a061f] text-[1rem] leading-7">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum obcaecati dolorem, in doloremque consequuntur autem mollitia aliquid perferendis illo corporis sit et molestiae, adipisci voluptate eaque assumenda at deleniti architecto.
                Facilis tempora perferendis voluptates vero.
                Iste eveniet aut deleniti unde laboriosam inventore, laudantium consequatur voluptatem odit culpa, expedita sed reprehenderit, ipsum corporis.
                Lis tempora perferendis voluptates vero.
                Iste eveniet aut deleniti unde laboriosam inventore, laudantium consequatur voluptatem odit culpa, expedita sed reprehenderit, ipsum corporis.
            </p>
        </div>
    </div>
</section>


    

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      const swiper = new Swiper('.panorama-slider', {
        loop: true,
        slidesPerView: 1,
        effect: 'fade', // Apply the fade effect
        fadeEffect: {
            crossFade: true // Enables cross-fading between slides
        },
        speed: 1500, // Fade transition speed in milliseconds
        autoplay: {
            delay: 4000, // Time between slides
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
