 <?php 
    require "connection.php";

    //uploading the image in the banner

    if(isset($_POST['Upload']))
    {
        
        $Alt = $_POST['altText'];

        if($_FILES['bannerImg'])
        {
            $fileTempName = $_FILES['bannerImg']['tmp_name']; // Temp file path
            $filename = uniqid() . '_' . $_FILES['bannerImg']['name']; // Unique file name
            $fileError = $_FILES['bannerImg']['error'];

            if($fileError===0)
            {
                $filedest = './Assets/Banner/' . $filename; // Set the destination path
                if(move_uploaded_file($fileTempName,$filedest)){
                    //getting the input data from each of the field


                    $sqlBan = "Insert into banner_tb (BannerImg,Alt_Img) values (?, ?)";//insertion into the db

                    //preparing the statment

                    $stm = $conn->prepare($sqlBan);

                    // binding the statements

                    $stm->bind_param('ss',$filedest,$Alt);

                    if($stm->execute()===true)
                    {
                        // echo "The image and description is uploaded successfully";
                        header("Location:./AfterEffects/GoBackDashboard.html");
                    }
                    else{
                        // echo "The statement is executed";
                    }
                }
                else{
                    // echo "The file couldnt be moved from the temporary desination to the permanent";
                }
            }
            else{
                // echo "The image is not uploaded";
            }

        }
    }else{
        // echo "You have not submitted the page";

    }


  //for Deleting the bannerimage from the display as well as from the database
    if(isset($_POST['Delete']))
    {
          $sqlRem = "DELETE FROM banner_tb WHERE BannerID = ? ";
          $banId = $_POST['edId'];
          $stmt = $conn->prepare($sqlRem);

          //binding the statement 

          $stmt->bind_param('i',$banId);

          if($stmt->execute()===true)
          {
            header("Location:./AfterEffects/GoBackDashboard.html");
          }
          else{
              echo "something is wrong";
          }
          
      }
      else{
          echo "The button is not pressed";
      }




?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body >

<div class="container mx-auto p-4">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                    <!-- <th class="px-6 py-3 text-left text-sm font-semibold">Banner Order</th> -->
                    <th class="px-6 py-3 text-left text-sm font-semibold">Alt Img</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Image</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require "connection.php";


                    $sqlSel = "SELECT * FROM Banner_tb"; // selection of the data
                    $sqlStm = $conn->prepare($sqlSel);

                    if ($sqlStm->execute()) {  
                        $result = $sqlStm->get_result();

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $BId = $row['BannerId'];
                                // $BanOrder = $row['BannerOrder'];
                                $BAlt = $row['Alt_Img'];
                                $BImg = $row['BannerImg'];

                                //operation to perform if this two buttons are pressed
                                echo "<tr class='border-b hover:bg-gray-100'>";

                                echo "<td class='px-6 py-4'>
                                        <input type='text' name='edId' class='border-0 bg-transparent text-black cursor-default' 
                                        value='" . htmlspecialchars($BId) . "' readonly tabindex='-1' 
                                        style='width: 50px; pointer-events: none;' />
                                      </td>";
                                // echo "<td class='px-6 py-4'>" . htmlspecialchars($BanOrder) . "</td>";
                                echo "<td class='px-6 py-4'>" . htmlspecialchars($BAlt) . "</td>";
                                echo "<td class='px-6 py-4'>
                                        <img src='" . htmlspecialchars($BImg) . "' alt='" . htmlspecialchars($BAlt) . "' 
                                        class='w-24 h-auto rounded-md'>
                                      </td>";
                                
                                echo "<td class='px-6 py-4 space-x-2'>";
                                
                            //    // Edit button form
                            //    echo "<form action='Banner.php' method='post' style='display:inline;'>
                            //    <input type='hidden' name='edId' value='" . htmlspecialchars($BId) . "' />
                            //    <button type='submit' name='Edit' class='bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600'>
                            //        <i class='fa-solid fa-pen-to-square'></i> Edit
                            //    </button>
                            //  </form>";
                                    
                                    // Remove button form
                                    echo "<form action='Banner.php' method='post' style='display:inline;'>
                                            <input type='hidden' name='edId' value='" . htmlspecialchars($BId) . "' />
                                            <button type='submit' name='Delete' class='bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600'>
                                                <i class='fa-solid fa-trash'></i> Remove
                                            </button>
                                          </form>";
                                echo "</td>";
                                
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='px-6 py-4 text-center text-gray-500'>No data found.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='px-6 py-4 text-center text-red-500'>Error executing query.</td></tr>";
                    }



               
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- To present with the option to open up the image upload -->
<div class="border-2 h-[14vh] flex justify-center items-center">
    <div>
         <button class="border-2 border-blue-600 mx-auto p-3 font-semibold bg-blue-600 text-white rounded-md hover:border-[#1B03A3] focus:ring-2 ring-green-400  hover:scale-105 transition ease-in-out delay-400 " id="upload">Upload Banner Images</button>
    </div>

</div>

    

<div class="UploadOption fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-xl w-96 max-w-full">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Upload Banner Images</h2>
        <form action="Banner.php" method="POST" enctype="multipart/form-data">
            <div class="space-y-5">
                <!-- File Input -->
                <div class="flex items-center justify-center w-full">
                    <label class="w-full flex items-center justify-center px-4 py-3 text-black rounded-lg shadow-lg tracking-wide uppercase border border-indigo-300 cursor-pointer bg-indigo-100 hover:bg-indigo-200">
                        <i class="fa-solid fa-image mr-2"></i>
                        <span class="text-base font-medium">Upload Image</span>
                        <input type="file" name="bannerImg" accept="image/*" class="hidden" id="bannerImg" multiple onchange="check()" />
                    </label>
                </div>

                <!-- Order Input -->
                <!-- <div>
                    <label for="order" class="text-gray-700 text-sm font-medium">Display Order</label>
                    <input type="number" name="order" min="1" placeholder="Order" class="mt-2 w-full px-4 py-2 text-sm border rounded-lg border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 placeholder:text-gray-500" required />
                </div> -->

                <!-- Alt Text Input -->
                <div>
                    <label for="altText" class="text-gray-700 text-sm font-medium">Alt Text</label>
                    <input type="text" name="altText" placeholder="Alt text for image" class="mt-2 w-full px-4 py-2 text-sm border rounded-lg border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 placeholder:text-gray-500" required />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" name="Upload" class="w-full bg-gradient-to-r from-indigo-500 to-indigo-600 text-white py-2 rounded-lg text-sm font-semibold shadow-md hover:from-indigo-600 hover:to-indigo-700 transition duration-200" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>




<script>
    
    function check() {
        const fileInput = document.getElementById('bannerImg');
        const file = fileInput.files[0];
        const img = new Image();

        img.src = URL.createObjectURL(file);
        img.onload = function() {
            const width = img.width;
            const height = img.height;

            console.log(width);
            console.log(height);
            //checking the width and height of the image

             if((width >= 1200) && (height >= 600 ))
             {
                alert("congrats the file is of the required size")
             }
             else{
                alert("Choose the image with the width between [1200-4000] and height[600-900]");
                fileInput.value = "";
             }

       
        };
    }

    //to make the visible of the hidden 

    let uploadBanner = document.getElementById("upload");
    let uploadOption = document.querySelector(".UploadOption");

uploadBanner.addEventListener("click", () => {
    // Toggle visibility of uploadOption when uploadBanner is clicked
    if (uploadOption.classList.contains("hidden")) {
        uploadOption.classList.remove("hidden");
        uploadOption.classList.add("visible");
    } else {
        uploadOption.classList.remove("visible");
        uploadOption.classList.add("hidden");
    }
});

// Add click listener to the window only once
window.addEventListener('click', (e) => {
    
    if (e.target === uploadOption) {
        uploadOption.classList.add("hidden");
    }
});


</script>
</body>
</html>