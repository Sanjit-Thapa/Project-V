<!-- <?php 
    require "connection.php";

    //uploading the image in the banner

    if(isset($_POST['submit']))
    {
        $Order = $_POST['order'];
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


                    $sqlBan = "Insert into banner_tb (BannerImg,BannerOrder,Alt_Img) values (?, ?, ?)";//insertion into the db

                    //preparing the statment

                    $stm = $conn->prepare($sqlBan);

                    // binding the statements

                    $stm->bind_param('sis',$filedest,$Order,$Alt);

                    if($stm->execute()===true)
                    {
                        echo "The image and description is uploaded successfully";
                    }
                    else{
                        echo "The statement is executed";
                    }
                }
                else{
                    echo "The file couldnt be moved from the temporary desination to the permanent";
                }
            }
            else{
                echo "The image is not uploaded";
            }

        }
    }else{
        echo "You have not submitted the page";

    }


?> -->


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
    

<div class="bg-white p-8 rounded-lg shadow-xl w-96 max-w-full">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Upload Banner Images</h2>
    <form action="Display.php" method="POST" enctype="multipart/form-data">
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
            <div>
                <label for="order" class="text-gray-700 text-sm font-medium">Display Order</label>
                <input type="number" name="order" min="1" placeholder="Order" class="mt-2 w-full px-4 py-2 text-sm border rounded-lg border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 placeholder:text-gray-500" required />
            </div>

            <!-- Alt Text Input -->
            <div>
                <label for="altText" class="text-gray-700 text-sm font-medium">Alt Text</label>
                <input type="text" name="altText" placeholder="Alt text for image" class="mt-2 w-full px-4 py-2 text-sm border rounded-lg border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 placeholder:text-gray-500" required />
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-indigo-600 text-white py-2 rounded-lg text-sm font-semibold shadow-md hover:from-indigo-600 hover:to-indigo-700 transition duration-200" name="submit" >Submit</button>
            </div>
        </div>
    </form>
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

            // Set the required dimensions
            // const requiredWidth = /[1000-1600]/;
            // const requiredHeight = /[600-900]/;

            // if (width !== requiredWidth || height !== requiredHeight) {
            //     alert(`Image must be ${requiredWidth}x${requiredHeight} pixels.`);
            //     fileInput.value = ""; // Clear the input
            // }
        };
    }

</script>
</body>
</html>