<?php 
require "connection.php";
    session_start();

//  global $_SESSION;
 if($_SESSION['loggedin']===true){
    $id = $_SESSION['artist_id'];
    echo $id;

    $sqlSel = "select Username,Artistmail from artistsignup_tb where Artist_Id = ?";

     $stm = mysqli_prepare($conn,$sqlSel);

      mysqli_stmt_bind_param($stm,'i',$id);

    // Execute the statement
    mysqli_stmt_execute($stm);

    // Get the result set
    $result = mysqli_stmt_get_result($stm);

    if($row = mysqli_fetch_assoc($result)){

        $username = $row['Username'];
        $ArtistEmail = $row['Artistmail'];
    }

    //now uploading the datas related with the Artists respectively...

    if (isset($_POST['submit'])) {
        global $id;
        $artTitle = trim($_POST['Title']);
        $artDescription = trim($_POST['description']);
        $artForm = trim($_POST['artform']);
    
        echo $artTitle;
    
        if (isset($_FILES['img'])) { // Check if the file was uploaded
            $fileTempName = $_FILES['img']['tmp_name']; // Temp file path
            $filename = uniqid() . '_' . $_FILES['img']['name']; // Unique file name
            $fileError = $_FILES['img']['error'];
    
            if ($fileError === 0) { // No file error
                $filedest = './Assets/ArtistProfile/' . $filename; // Set the destination path
    
                if (move_uploaded_file($fileTempName, $filedest)) {
                    echo "File uploaded successfully!";
    
                    // Prepare SQL insert query
                    $sqlIns = "INSERT INTO artistview_tb (ArtistId, ArtTitle, Description, ArtForm, ImgPath) VALUES (?, ?, ?, ?, ?)";
    
                    // Prepare the statement
                    $stm = mysqli_prepare($conn, $sqlIns);
    
                    // Bind the parameters
                    mysqli_stmt_bind_param($stm, 'issss', $id, $artTitle, $artDescription, $artForm, $filedest);
    
                    // Execute the statement
                    if (mysqli_stmt_execute($stm)) {
                        echo "Data insertion successful!";
                    } else {
                        echo "Data insertion failed: " . mysqli_error($conn);
                    }
                } else {
                    echo "File upload failed: Could not move the file.";
                }
            } else {
                echo "Error in the file upload. Error code: " . $fileError;
            }
        } else {
            echo "No file uploaded.";
        }
    }

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Sidebar -->
    <div class="flex flex-col md:flex-row h-full">
        <nav class="bg-indigo-700 text-white w-full md:w-1/4 lg:w-1/5 p-5">
            <h2 class="text-3xl font-bold mb-8">Artist Dashboard</h2>
            <ul class="space-y-4">
                <li><a href="#upload" class="block hover:bg-indigo-500 p-3 rounded-lg">Upload Artwork</a></li>
                <li><a href="#status" class="block hover:bg-indigo-500 p-3 rounded-lg">Artwork Status</a></li>
                <li><a href="#inquiries" class="block hover:bg-indigo-500 p-3 rounded-lg">Inquiries</a></li>
                <li><a href="#profile" class="block hover:bg-indigo-500 p-3 rounded-lg">Profile</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-10">
            <!-- Upload Artwork Section -->
            <section id="upload" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Upload Artwork</h3>
                <form action="ArtistView.php" method="post" class="space-y-4" enctype="multipart/form-data">
                    <input type="text" placeholder="Title of the Artwork" class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300" name="Title">
                    
                    <textarea placeholder="Description" class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300" name="description"></textarea>

                    <select class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300" name="artform">
                        <option>Select Art Form</option>
                        <option>Painting</option>
                        <option>Sculpture</option>
                        <option>Digital Art</option>
                        <!-- Add other art forms as needed -->
                    </select>
                    <input type="file" name="img" id="img" accept="image/*" class="w-full border rounded p-3 mb-4 cursor-pointer focus:outline-none">
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-800 transition" name="submit">Submit Artwork</button>
                </form>
            </section>

            <!-- Artwork Status Section -->
            <section id="status" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Artwork Status</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 border-b">Title</th>
                            <th class="p-3 border-b">Art Form</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                         <?php
                            $sqlSel = "select ArtTitle,ArtForm,Status,Remarks from artistview_tb where Artistid = ?";

                            $stm = $conn->prepare($sqlSel);

                             $stm->bind_param('i',$id);
                            echo $id;

                            $result = $stm->execute();

                            if($result)
                            {
                                $result = $stm->get_result();
                                while($row =mysqli_fetch_assoc($result))
                                {
                                    // $title = $row['ArtTitle'];
                                    // $artform = $row['ArtForm'];
                                    // $status = $row['Status'];
                                    // $remarks = $row['Remarks'];
    
                                    
                                    echo "<tr class='border-b hover:bg-gray-100'>";
            
            
                                    // Art Title, Description, Art Form
                                    echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtTitle']) . "</td>";
                                    echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtForm']) . "</td>";
                                    echo "<td class='p-1 text-sm border border-slate-600 break-words max-w-xs overflow-hidden h-16'>" . htmlspecialchars($row['Status']) . "</td>"; // Smaller height
                                    echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['Remarks']) . "</td>";
            
    
                                }
                            }
                            else{
                                echo "The query is not executed";
                            }
                    
                            

                         ?>
                        <!-- <tr>
                            <td class="p-3 border-b">Sunset Painting</td>
                            <td class="p-3 border-b">Painting</td>
                            <td class="p-3 border-b text-yellow-500">Pending</td>
                            <td class="p-3 border-b">N/A</td>
                        </tr> -->
                        <!-- More rows dynamically added as necessary -->
                    </tbody>
                </table>
            </section>

            <!-- Inquiries Section -->
            <section id="inquiries" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Inquiries</h3>
                <ul class="space-y-4">
                    <!-- Example Inquiry -->
                    <li class="p-4 bg-gray-50 rounded-lg shadow">
                        <h4 class="font-bold text-lg">Client Inquiry</h4>
                        <p>Interested in "Sunset Painting".</p>
                        <p class="text-sm text-gray-500">Status: Under Review</p>
                    </li>
                    <!-- More inquiries as needed -->
                </ul>
            </section>

            <!-- Profile Section -->
            <section id="profile" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Profile</h3>
                <p class="text-lg">Welcome back, <strong><?php echo $username ?></strong>!</p>
                <p class="text-gray-600">This is your personal dashboard. You can view, manage, and submit your artworks here.</p>
            </section>
        </main>
    </div>

</body>
</html>