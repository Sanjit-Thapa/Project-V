<?php 

    require "connection.php";
    
    //updation of the AboutUS into the database
    if(isset($_POST['About']))
    {
        //getting the About Us
        $heading = $_POST['heading'];
        $quote = $_POST['quote'];
        $paragraph = $_POST['paragraph'];
        
        $id = 1 ;
        //sql statement for the updating the 

        $sql  = "UPDATE aboutus_tb SET Heading = ?, Quote=?,Paragraph=?  WHERE Id = ? ";

        
        //preparing the sql statement
        $stm = $conn->prepare($sql);

        //binding The statement

        $stm->bind_param('sssi',$heading,$quote,$paragraph,$id);

        //execution of the statement

        if($stm->execute()===true)
        {
            echo "The updation of the statement is completed";
        }
        else{
            echo "Sorry! the statement execution is not able to complete";
        }        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Main Container for Landscape Layout -->
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-6xl w-full flex flex-col lg:flex-row gap-8">
        
        <!-- Form Section -->
        <div class="w-full lg:w-1/2">
            <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Manage About Us Content</h1>
            
            <?php
                //displaying the datas which is displayed on the About Us section

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
                        echo "<form action='AboutUs.php' method='POST' enctype='multipart/form-data' class='space-y-4'>";
                        // Heading Section
                        echo "<div>
                                <label for='heading' class='block text-gray-700 font-semibold'>Heading</label>
                                <input type='text' id='heading' name='heading' value='{$row['Heading']}' required
                                    class='w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500'>
                              </div>";
                        
                        // Quote Section
                        echo "<div>
                                <label for='quote' class='block text-gray-700 font-semibold'>Quote</label>
                                <textarea id='quote' name='quote' required
                                    class='w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500'> {$row['Quote']}</textarea>
                              </div>";
                        
                        // Paragraph Section
                        echo "<div>
                                <label for='paragraph' class='block text-gray-700 font-semibold'>Paragraph</label>
                                <textarea id='paragraph' name='paragraph' rows='5' required
                                    class='w-full p-3 mt-1 border rounded-md focus:outline-none  text-left focus:ring-2 focus:ring-indigo-500'>
                                    {$row['Paragraph']} </textarea>
                              </div>";
                        
                        // Preview Button
                        echo "<button type='button' onclick='previewContent()'
                                class='w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50'>
                                Preview
                              </button>";
                        
                        // Submit Button
                        echo "<button type='submit' name='About'
                                class='w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50'>
                                Save Content
                              </button>";
                        
                        echo "</form>";
                    }
                }
                ?>
        </div>

        <!-- Preview Section -->
        <div class="preview w-full lg:w-1/2 bg-gray-50 p-6 rounded-md shadow-md hidden">
            <h2 class="text-xl font-semibold text-gray-800 text-center mb-4">Preview</h2>
            <div class="text-center">
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
    </div>

    <script>
        function previewContent(){
            let preview = document.querySelector(".preview");
      
            preview.classList.toggle("hidden");
      

        }
    </script>
</body>
</html>