<?php
    require "connection.php";

    //updation of the Listed sites 
    if(isset($_POST['Yes']) || isset($_POST['No'])) {
        $id = $_POST['Artid'];
        
        // Check which button was pressed
        if(isset($_POST['Yes'])) {
            $listed = 'Yes';
        } elseif(isset($_POST['No'])) {
            $listed = 'No';
        }
    
        // Update the 'Listed' field based on the selected button
        $sqlUpd = "UPDATE artistview_tb
                   SET Listed = ? WHERE ArtId = ?";
    
        // Prepare the statement
        $stm = $conn->prepare($sqlUpd);
    
        // Bind the parameters
        $stm->bind_param('si', $listed, $id);
    
        // Execute the query
        if($stm->execute() === true) {
            // echo "Updation successful";
            header("Location:./AfterEffects/GoBackDashboard.html");
        } else {
            echo "Updation is not successful";
        }
    } else {
        echo "The Action button is not pressed";
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="text-center">
    <h1 class="text-slate-800 font-semibold text-[1rem] mb-2">Art Selection</h1>
    <div class="overflow-x-auto max-h-[400px] overflow-y-scroll border border-slate-300 rounded-lg">
        <table class="w-full max-w-full mx-auto border-collapse border rounded-lg shadow-lg">
            <thead>
                <tr class="bg-slate-700">
                    <th class="p-1 text-sm border border-slate-600 text-white">Art ID</th>
                    <th class="p-1 text-sm border border-slate-600 text-white">Artist ID</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Art Title</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Description</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Art Form</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Image</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Listed</th>
                    <th class="p-2 text-sm border border-slate-600 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "connection.php";
                $sqlget = "SELECT ArtId, ArtistId, ArtTitle, Description, ArtForm, ImgPath, Listed FROM artistview_tb WHERE status=?";
                $stats = 'Approved';

                // Prepare the statement
                $stm = $conn->prepare($sqlget);

                // Bind the statement
                $stm->bind_param('s', $stats);

                // Execute the statement
                if ($stm->execute()) {
                    $result = $stm->get_result();

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<form action='ArtSelect.php' method='POST'>";
                        echo "<tr class='border-b hover:bg-gray-100'>";

                        // ArtId
                        echo "<td class='text-center border border-slate-600'>
                                <input type='number' name='Artid' value='{$row['ArtId']}' readonly class='bg-transparent text-center w-full'>
                              </td>";

                        // ArtistId
                        echo "<td class='text-center border border-slate-600'>
                                <input type='number' name='id' value='{$row['ArtistId']}' readonly class='bg-transparent text-center w-full'>
                              </td>";

                        // Art Title, Description, Art Form
                        echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtTitle']) . "</td>";
                        echo "<td class='p-1 text-sm border border-slate-600 break-words max-w-xs overflow-hidden h-16'>" . htmlspecialchars($row['Description']) . "</td>";
                        echo "<td class='p-2 text-sm border border-slate-600 break-words max-w-xs overflow-hidden'>" . htmlspecialchars($row['ArtForm']) . "</td>";

                        // Image
                        echo "<td class='p-2 flex justify-center border border-slate-600'>
                                <div class='w-24 h-auto md:w-32 lg:w-40'>
                                    <img src='" . htmlspecialchars($row['ImgPath']) . "' alt='Artwork Image' class='rounded-lg object-cover'>
                                </div>
                              </td>";

                        // Listed
                        echo "<td class='p-2 text-center border border-slate-600'>" . htmlspecialchars($row['Listed']) . "</td>";

                        // Action buttons
                        echo "<td class='text-center space-x-2 border border-slate-600'>
                                <button type='submit' name='No' value='No' class='px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition mb-2'>No</button>
                                <button type='submit' name='Yes' value='Yes' class='px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition'>Yes</button>
                              </td>";

                        echo "</tr>";
                        echo "</form>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center p-4'>Data is not fetched</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


</body>
</html>