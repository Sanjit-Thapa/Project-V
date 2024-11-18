<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body class=" text-[#F1EDE4] font-sans overflow-x-hidden">

    <!-- Navigation Bar -->
    <nav class="container mx-auto flex items-center justify-between py-4 px-4 md:px-6 absolute top-0 left-0 right-0 z-20 backdrop-blur-md  text-[#3a061f] bg-white">

        <div>
            <a href="#homesection"><img src="Assets/art-gallery-logo-.png" alt="Art Gallery Logo" class="w-16 md:w-20"></a>
        </div>
        <ul class="hidden mx-auto md:flex space-x-4 lg:space-x-8 text-base md:text-lg font-semibold gap-4 md:gap-6">
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="#About">About Us</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="#">Exhibitions</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="#">Art Gallery</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="ArtistLogin.php"target="_blank">Artist</a></li>
            <li class="hover:text-[#312f2a] transition ease-in-out delay-150 hover:scale-110"><a href="login.php" target="_blank">Admin</a></li>
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
    <section class=" relative overflow-hidden bg-[#e8c67d5b] border-red-400 w-screen" id="About">
    <!-- Quote Section -->
     <div class="bg-[url('./Assets/Floral.png')] absolute top-0 inset-0 w-full h-12 md:h-24 bg-contain bg-repeat-x opacity-30 -z-20 mix-blend-darken ">
       
     </div>
   
    <div class="container border-red-900 text-center space-y-4 relative mx-auto  h-full w-screen px-[2vw]">
       <div class="inside px-9 py-8 w-[90vw] h-full  mx-auto">
       <?php
            require "connection.php";

            //selection of the statement

            $sqlSel = "select Heading,Quote,Paragraph from aboutus_tb";

            //preparing the statement
            $stmt = $conn->prepare($sqlSel);

            //execution of the query

            if($stmt->execute())
            {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc())
                {

            echo "<h1 class='text-[2vw] pt-4 text-[#35282e] font-[rubik]'>{$row['Heading']}</h1>";

            echo "<h2 class='text-[3vw] text-[#3a061f] font-[rubik] p-4'>
                {$row['Quote']}
                 </h2>";

            echo "<p class='text-[#3a061f] text-[1.1rem] text-center leading-8'>
                {$row['Paragraph']}
                 </p>";
                }
            }
        ?>

    </div>
    </div>

       <!-- make the bouncy view Gallery ball bouncing -->
       <div class="flex justify-center  items-center mx-auto ">
            <div class="bouncyArt border-2 border-[#767618] w-32 h-20 text-center flex items-center justify-center rounded-lg cursor-pointer hover:scale-100 transition ease-in-out"  >
                <h5 class="font-[rubik] text-xl text-black font-light">View Gallery</h5>
            </div>
        </div>

    <div class="bg-[url('./Assets/Floral.png')] inset-0 w-full h-12 md:h-24 bg-contain bg-repeat-x opacity-30 -z-20 mix-blend-darken ">
               
    </div>


</section>

<!-- Now Product section -->

<section class="border-2">
    <div class="pl-8 pt-10">
        <h2 class="text-[56px] leading-[1.0714285714] font-semibold tracking-[-0.005em] font-[rubik] text-[#3a061f]">
            Explore The Best
        </h2>
    </div>

    <!-- Products Section -->
   
        <?php 
            require "connection.php";
        
            //selection of the product that was approved to be listed on the site

            $sql = "select * from artistview_tb where Listed = 'Yes' ";

            //execution of the querry

           $result =  $conn->query($sql);
           if ($result) {
            echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 border-2 border-green-200 p-4">';
            
            while ($row = mysqli_fetch_assoc($result)) {
                // Product Card
                echo '<div class="flex flex-col items-center border-2 p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">';
        
                echo '<img src="' . $row['ImgPath'] . '" alt="Product Image" 
                      class="w-full h-auto max-h-[200px] object-contain mb-6 rounded-md shadow-md transition-all duration-300 ease-in-out">';
        
                echo '<div class="see w-full text-center p-4 rounded-md shadow-sm cursor-pointer">
                        <h4 class="text-[1rem] font-semibold text-[#3a061f] mb-2 truncate seeMore">' . $row['ArtTitle'] . '</h4>
                        <h4 class="text-[1rem] font-semibold text-[#3a061f] mb-2 truncate seeMore">' . $row['ArtForm'] . '</h4>
                        <h2 class="text-black text-sm text-left mt-2 font-light truncate seeMore">' . $row['Description'] . '</h2>
                      </div>';
        
                echo '<div>
                        <button class="mt-4 px-6 py-2 text-white bg-[#3a061f] rounded-full text-[0.95rem] font-semibold hover:bg-[#5f2a4e] transition duration-300">Enquire</button>
                        <button class="mt-4 px-6 py-2 text-white bg-[#082c1e] rounded-full text-[0.95rem] font-semibold hover:bg-[#202460] transition duration-300">Reserve</button>
                      </div>';
                echo '</div>';
            }
        
            echo '</div>'; // Close the grid container
        }
        


    
        ?>
       
    
      
    </div>
</section>    
</section>



    <!-- Swiper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
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

    //see more option for the longer text

    let seeMore = document.getElementsByClassName("seeMore");
    let container = document.querySelector(".see");
    container.addEventListener("click",(e)=>{
        for(let i=0 ;i<seeMore.length;i++)
    {
        if(seeMore[i].classList.contains("truncate"))
    {
        seeMore[i].classList.remove("truncate");
        seeMore[i].classList.add("break-words");
    }
   else{
        seeMore[i].classList.remove("break-words");
        seeMore[i].classList.add("truncate");
    }
    }
    
    })
  

  
    </script>
</body>
</html>
