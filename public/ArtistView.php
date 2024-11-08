<?php 
require "connection.php";
    session_start();

//  global $_SESSION;
 if($_SESSION['loggedin']===true){
    $id = $_SESSION['artist_id'];
    echo $id;

    $sqlSel = "select ArtistProfile,Username,Artistmail from artistsignup_tb where Artist_Id = ?";

     $stm = mysqli_prepare($conn,$sqlSel);

      mysqli_stmt_bind_param($stm,'i',$id);

    // Execute the statement
    mysqli_stmt_execute($stm);

    // Get the result set
    $result = mysqli_stmt_get_result($stm);

    if($row = mysqli_fetch_assoc($result)){

        $username = $row['Username'];
        $ArtistEmail = $row['Artistmail'];
        $ProfilePic = $row['ArtistProfile'];
    }

    //changing or uploading the profile picture
    if(isset($_POST['profilePic'])){
        if(isset($_FILES['profile_picture']))
        {
            $fileTempName = $_FILES['profile_picture']['tmp_name']; // Temp file path
            $filename = uniqid() . '_' . $_FILES['profile_picture']['name']; // Unique file name
            $fileError = $_FILES['profile_picture']['error'];

            if($fileError===0)
            {
                $filedest = './Assets/ArtistProfile/' . $filename; // Set the destination path
                
                if(move_uploaded_file($fileTempName,$filedest))
                {
                    echo "Profile uploaded success";

                    //updation of the profile picture

                    $sqlProf = "UPDATE artistsignup_tb SET ArtistProfile = ? WHERE Artist_id = ?";

                    //preparing the statement

                    $stm = $conn->prepare($sqlProf);

                    //binding the statements

                    $stm->bind_param('si',$filedest,$id);

                    //execution of the statement

                    if($stm->execute()===true)
                    {
                        echo "Profile picture of the artist is successfully updated";
                    }
                    else{
                        echo "The profile picture of the artist is not updated";
                    }

                }
                else{
                    echo "The file couldnt be moved from the temp to the permanent destination";
                }
            }   
            else{
                echo "the file is not updated";
            }
         
        }
        else{
            echo "the button for the upload is not pressed";
        }
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

    <!-- <?php
    // Assume $username contains the artist's username, and $profilePicturePath contains the profile picture path
    //$username = "ArtistName";  // Replace with actual PHP variable for username
    //$profilePicturePath = "./Assets/ArtistProfile/placeholder.jpg";  // Replace with actual profile picture path
    ?> -->

    <!-- Sidebar with Profile -->
    <div class="flex flex-col md:flex-row h-full">
        <!-- Sidebar Navigation -->
        <nav class="bg-indigo-700 text-white w-full md:w-1/4 lg:w-1/5 p-5 flex flex-col items-center ">
            <div class="mb-6 text-center">
                <!-- Profile Picture -->
                <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden mb-2">
                    <img src="<?php echo $ProfilePic; ?>" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <!-- Username Display -->
                <p class="text-2xl font-semibold text-orange-200"><?php echo $username; ?></p>
            </div>
            <ul class="space-y-4 text-center">
                <li><a href="#upload" class="block hover:bg-indigo-500 p-3 rounded-lg">Upload Artwork</a></li>
                <li><a href="#status" class="block hover:bg-indigo-500 p-3 rounded-lg">Artwork Status</a></li>
                <li><a href="#inquiries" class="block hover:bg-indigo-500 p-3 rounded-lg">Inquiries</a></li>
                <li><a href="#profile" class="block hover:bg-indigo-500 p-3 rounded-lg">Profile</a></li>
            </ul>
        </nav>

        <!-- Main Content Area -->
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
                         <?php
                            $sqlSel = "select ArtTitle,ArtForm,Status,Remarks from artistview_tb where Artistid = ?";
                            $stm = $conn->prepare($sqlSel);
                            $stm->bind_param('i', $id);
                            $result = $stm->execute();

                            if ($result) {
                                $result = $stm->get_result();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr class='border-b hover:bg-gray-100'>";
                                    echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtTitle']) . "</td>";
                                    echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtForm']) . "</td>";
                                    echo "<td class='p-1 text-sm border border-slate-600 break-words max-w-xs overflow-hidden h-16'>" . htmlspecialchars($row['Status']) . "</td>";
                                    echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['Remarks']) . "</td>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='p-3 text-center'>The query did not execute.</td></tr>";
                            }
                         ?>
                    </tbody>
                </table>
            </section>

            <!-- Inquiries Section -->
            <section id="inquiries" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Inquiries</h3>
                <ul class="space-y-4">
                    <li class="p-4 bg-gray-50 rounded-lg shadow">
                        <h4 class="font-bold text-lg">Client Inquiry</h4>
                        <p>Interested in "Sunset Painting".</p>
                        <p class="text-sm text-gray-500">Status: Under Review</p>
                    </li>
                </ul>
            </section>

            <!-- Profile Section -->
            <section id="profile" class="bg-white shadow rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4 text-indigo-700">Profile</h3>
                <p class="text-lg">Welcome back, <strong><?php echo $username ?></strong>!</p>
                <p class="text-gray-600">This is your personal dashboard. You can view, manage, and submit your artworks here.</p>
                
                <!-- Change Profile Picture Form -->
                <form action="ArtistView.php" method="post" enctype="multipart/form-data" class="mt-4">
                    <label for="profilePictureInput" class="block text-indigo-700 font-semibold mb-2">Change Profile Picture</label>
                    <input type="file" id="profilePictureInput" name="profile_picture" class="w-full border rounded p-3 mb-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-300"  accept="image/*">
                    <button type="submit" name="profilePic" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-400 transition duration-300">Save Profile Picture</button>
                </form>

                <!-- Change Password Form -->
                <form action="change_password.php" method="post" class="mt-6">
                    <label for="newPassword" class="block text-indigo-700 font-semibold mb-2">Change Password</label>
                    <input type="password" id="newPassword" name="new_password" placeholder="New Password" class="w-full border rounded p-3 mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-400 transition duration-300">Update Password</button>
                </form>
            </section>
        </main>
    </div>

</body>
</html>
