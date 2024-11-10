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
        <div >
            <a href="#homesection"><img src="Assets/art-gallery-logo.png" alt="Art Gallery Logo" class="w-20"></a>
        </div>
        <ul class="flex space-x-8 text-lg font-semibold mx-auto gap-6" >
            <li  class="hover:text-[#D9BB63]  transition ease-in-out delay-150 hover:scale-105"><a href="#">About Us</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150  hover:scale-105"><a href="#" >Exhibitions</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150  hover:scale-105"><a href="#" >Art Gallery</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150  hover:scale-105"><a href="ArtistLogin.php" >Artist</a></li>
            <li class="hover:text-[#D9BB63] transition ease-in-out delay-150  hover:scale-105"><a href="login.php">Admin</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <!-- <section class="h-[80vh] bg-cover bg-center flex items-center justify-center text-center border" style="background-image: url('Assets/banner.jpg');">
        <div>
            <h1 class="text-5xl font-bold mb-4">Discover the Beauty of Art</h1>
            <p class="text-xl">Where Creativity Meets Passion</p>
        </div>
    </section> -->

   <section class="container mx-auto mt-4 px-6" id="homesection">
    <div class="swiper panorama-slider w-full h-[80vh]">
        <div class="swiper-wrapper">
            <?php 
                require "connection.php";

                //selection of the images from the database
                $sqlSel = 'select BannerImg,BannerOrder,Alt_Img from banner_tb';
                
                $result = $conn->query($sqlSel);

                if($result)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $image = $row['BannerImg'];
                        $order = $row['BannerOrder'];
                        $alt = $row['Alt_Img'];
                   
                   
                   echo  "<div class='swiper-slide flex justify-center items-center transform-gpu perspective-[1500px]'>";
                   echo   "<img src='{$image}' alt='{$alt}' class='object-cover w-full h-full rounded-lg shadow-lg transition-transform duration-1000 ease-in-out transform-gpu'>";
                    echo "</div>";
                }
            }
                else{
                        echo "something is wrong ";
                    }
            
            ?>
        
          
        
        
        
      
        </div>


        <!-- Navigation buttons -->
        <div class="swiper-button-next text-[#D9BB63]"></div>
        <div class="swiper-button-prev text-[#D9BB63]"></div>
    </div>
</section>

    <!-- Artist Spotlight -->
    <section class="container mx-auto mt-12 px-6">
        <h2 class="text-3xl font-semibold text-[#D9BB63] mb-8">Artist Spotlight</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-[#F1EDE4] text-[#3D3028] p-6 rounded-lg shadow-lg text-center">
                <img src="Assets/ArtistProfile/artist1.jpg" alt="Artist 1" class="w-full h-64 object-cover rounded-lg mb-4">
                <h3 class="text-xl font-semibold mb-2">Artist Name</h3>
                <p>Brief description about the artist’s work and style.</p>
            </div>
            <div class="bg-[#F1EDE4] text-[#3D3028] p-6 rounded-lg shadow-lg text-center">
                <img src="Assets/ArtistProfile/artist2.jpg" alt="Artist 2" class="w-full h-64 object-cover rounded-lg mb-4">
                <h3 class="text-xl font-semibold mb-2">Artist Name</h3>
                <p>Brief description about the artist’s work and style.</p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="container mx-auto mt-12 px-6 mb-16">
        <h2 class="text-3xl font-semibold text-[#D9BB63] mb-8">Upcoming Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-[#F1EDE4] text-[#3D3028] p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold mb-2">Exhibition Name</h3>
                <p class="mb-4">Event Date: November 20, 2024</p>
                <p>Details about the exhibition and what visitors can expect.</p>
            </div>
            <div class="bg-[#F1EDE4] text-[#3D3028] p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold mb-2">Workshop Name</h3>
                <p class="mb-4">Event Date: December 10, 2024</p>
                <p>Details about the workshop for aspiring artists.</p>
            </div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
     const swiper = new Swiper('.panorama-slider', {
    loop: true, // Enable infinite loop for panoramic effect
    slidesPerView: 'auto', // Adjust slides based on viewport width
    spaceBetween: 10, // Adjust spacing between slides (optional)
    // Remove centeredSlides for continuous scrolling
    effect: 'slide',
    speed: 800,
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
