<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserList</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">
    
    <div class="container mx-auto  p-4 bg-white shadow-lg rounded-lg text-center">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">User Details</h4>

        <?php 
require "connection.php";

$sql = "SELECT 
            u.UserId,
            u.Name,
            u.Email,
            u.CountryCode AS Code,
            u.Number,
            u.Enquire,
            a.ImgPath,
            ad.Username AS Artist
        FROM 
            userdetail_tb u
        JOIN 
            artistview_tb a ON u.ArtId = a.ArtId
        JOIN 
            artistsignup_tb ad ON a.ArtistId = ad.Artist_Id;";
        
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '
    <div class="max-h-[500px] overflow-y-auto border border-slate-700 rounded-lg shadow-lg">
        <table class="table-auto border-collapse border border-slate-700 w-full text-sm">
            <thead>
                <tr class="text-white text-left bg-blue-800">
                    <th class="border border-gray-300 px-2 py-1 w-16">ID</th>
                    <th class="border border-gray-300 px-2 py-1">Name</th>
                    <th class="border border-gray-300 px-2 py-1">Email</th>
                    <th class="border border-gray-300 px-2 py-1 w-20">Code</th>
                    <th class="border border-gray-300 px-2 py-1 w-24">Number</th>
                    <th class="border border-gray-300 px-2 py-1">Enquire</th>
                    <th class="border border-gray-300 px-2 py-1 w-20">Image</th>
                    <th class="border border-gray-300 px-2 py-1">Artist</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-2 py-1 text-center">' . $row['UserId'] . '</td>
                    <td class="border border-gray-300 px-2 py-1">' . htmlspecialchars($row['Name']) . '</td>
                    <td class="border border-gray-300 px-2 py-1">' . htmlspecialchars($row['Email']) . '</td>
                    <td class="border border-gray-300 px-2 py-1 text-center">' . htmlspecialchars($row['Code']) . '</td>
                    <td class="border border-gray-300 px-2 py-1">' . htmlspecialchars($row['Number']) . '</td>
                    <td class="border border-gray-300 px-2 py-1">' . htmlspecialchars($row['Enquire']) . '</td>
                    <td class="border border-gray-300 px-2 py-1 text-center">
                        <div class="w-24 h-auto md:w-32 lg:w-40 mx-auto">
                            <img src="' . htmlspecialchars($row['ImgPath']) . '" alt="Artwork Image" class="rounded-lg object-cover">
                        </div>
                    </td>
                    <td class="border border-gray-300 px-2 py-1">' . htmlspecialchars($row['Artist']) . '</td>
                </tr>';
    }
    echo '
            </tbody>
        </table>
    </div>';
} else {
    echo '<p class="text-gray-500 text-center mt-4">No records found.</p>';
}

$conn->close();
?>

    </div>
</body>
</html>