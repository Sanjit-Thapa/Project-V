<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Art Gallery</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F1EDE4] text-[#3A061F] font-sans">

    <!-- Page Content -->
    <section class="container mx-auto mt-12 px-4">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-2">Explore Our Art Gallery</h1>
            <p class="text-lg text-[#6B4226]">Discover unique artworks from a variety of styles and artists.</p>
        </div>

        <!-- Search and Filter Options -->
        <div class="flex justify-center gap-6 mb-8">
            <div class="relative w-full max-w-md">
                <form action="EntireGallery.php" method="post">
                    <input 
                        type="text" 
                        placeholder="Search for art..." 
                        class="w-full px-4 py-2 border rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-[#D9BB63]" 
                        name="artType"
                    />
                    <button 
                        class="absolute right-2 top-2 bg-[#3A061F] text-white px-4 py-1 rounded-md hover:bg-[#5f2a4e] transition" 
                        name="search"
                    >
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Artworks Gallery -->
        <section>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
                <?php 
                    require "connection.php";

                    if (isset($_POST['search'])) {
                        $searchQuery = $_POST['artType'] ?? '';
                        $stmt = $conn->prepare("SELECT ArtId, ArtTitle, ImgPath, Description, ArtForm 
                                                FROM artistview_tb 
                                                WHERE Listed = 'Yes' 
                                                AND (ArtTitle LIKE ? OR ArtForm LIKE ?)");
                        $likeQuery = "%$searchQuery%";
                        $stmt->bind_param("ss", $likeQuery, $likeQuery);
                    } else {
                        $stmt = $conn->prepare("SELECT ArtId, ArtTitle, ImgPath, Description, ArtForm 
                                                FROM artistview_tb 
                                                WHERE Listed = 'Yes'");
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="flex flex-col items-stretch border-2 p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 h-full">';
                            echo '<img src="' . $row['ImgPath'] . '" alt="Artwork Image" class="w-full h-[200px] object-contain mb-6 rounded-md shadow-md">';

                            echo '<div class="flex-grow text-center p-4 rounded-md shadow-sm cursor-pointer">';
                            echo '<h4 class="text-[1rem] uppercase font-semibold text-[#3a061f] mb-2 truncate">' . $row['ArtTitle'] . '</h4>';
                            echo '<h4 class="text-[1rem] font-semibold text-[#3a061f] mb-2 truncate">Type: ' . $row['ArtForm'] . '</h4>';
                            echo '<h2 class="text-black text-sm text-left mt-2 font-light truncate">' . $row['Description'] . '</h2>';
                            echo '</div>';

                            echo '<div class="flex justify-center gap-2 mt-3">';
                            echo '<button class="More px-4 py-2 bg-[#3a061f] text-white rounded-full text-sm hover:bg-[#5f2a4e] truncate">See More</button>';
                            echo '<form action="ArtGallery.php" method="post">';
                            echo '<input type="hidden" name="Artid" value="' . $row['ArtId'] . '">';
                            echo '<button type="submit" name="Reserve" class="px-4 py-2 bg-[#082c1e] text-white rounded-full text-sm hover:bg-[#202460]">Enquire</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="col-span-4 text-center text-gray-600">No artworks found.</p>';
                    }
                ?>
            </div>
        </section>
    </section>

    <script>
  let moreButtons = document.querySelectorAll(".More");

for (let i = 0; i < moreButtons.length; i++) {
    moreButtons[i].addEventListener("click", (evt) => {
        let parent = moreButtons[i].parentNode;
        let grandParent = parent.parentElement;
        let contentDiv = grandParent.querySelector("div"); // Target the content area
        let targetTextElements = contentDiv.querySelectorAll(".truncate, .break-words"); // Only focus on elements with these classes

        targetTextElements.forEach((textElement) => {
            if (textElement.classList.contains("truncate")) {
                textElement.classList.remove("truncate");
                textElement.classList.add("break-words");
            } else {
                textElement.classList.remove("break-words");
                textElement.classList.add("truncate");
            }
        });
    });
}

    </script>
</body>
</html>
