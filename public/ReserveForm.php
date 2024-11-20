<?php
    

    require "connection.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();



    // if(isset($_POST['Reserve'])){

    //     $ArtId =  $_POST['Artid'];
    //     echo $ArtId;
        
    //     $id = $ArtId;
     
    // }
    // else{
    //     echo "not clicked";
    // }

   
    if(isset($_POST['submitContact']))
    {
        
         $id = $_SESSION['id'];
        
         //getting the data from the contact form

         $name = $_POST['Fullname'];
         $email = $_POST['Email'];
         $code = $_POST['country_code'];
         $phone = $_POST['number'];
         $enquire = $_POST['askUs'];

         //insertion of the user data into the database

         $insUser = "INSERT INTO userdetail_tb (Name, Email,CountryCode,Number,Enquire, ArtId) VALUES (?, ?,?, ?,?,?)";

         //prepare the statement

         $stmUser = $conn->prepare($insUser);

         //binding the parameter

         $stmUser->bind_param('sssssi',$name,$email,$code,$phone,$enquire,$id);

         //execution of the statement

         $result = $stmUser->execute();

         if($result===true)
         {
            echo "Data has been inserted successfully";

            //Create an instance; passing `true` enables exceptions
            require 'PHPmailer/Exception.php';
            require 'PHPmailer/PHPMailer.php';
            require 'PHPmailer/SMTP.php';
  
        $mail = new PHPMailer(true);
 
        try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($email, 'User');
        $mail->addAddress('', 'Admin');     //Add a recipient
    
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);  // Set email format to HTML

        $mail->Body = "
            <html>
            <head>
                <style>
                    /* Basic email styling */
                    body {
                        font-family: Arial, sans-serif;
                        color: #333333;
                        line-height: 1.6;
                        margin: 0;
                        padding: 0;
                        background-color: #f9f9f9;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    }
                    h2 {
                        color: #4CAF50;
                        text-align: center;
                    }
                    p {
                        font-size: 16px;
                        margin: 10px 0;
                    }
                    .highlight {
                        color: #333;
                        font-weight: bold;
                    }
                    .footer {
                        text-align: center;
                        font-size: 12px;
                        color: #888888;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>New Enquiry Details</h2>
                    <p><span class='highlight'>Name:</span> $name</p>
                    <p><span class='highlight'>Telephone Number:</span> $code $phone</p>
                    <p><span class='highlight'>Enquiring:</span> $enquire</p>
                    <div class='footer'>
                        <p>This email was sent from your website's enquiry form.</p>
                    </div>
                </div>
            </body>
            </html>";
        
        
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
            }
            else{
                echo "There is some error in the ";
            }

     
    }
    else{
        echo "hi";
    }

    
 
 
     



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="">
    
    <div class="min-h-screen flex items-center justify-center bg-[#e8c67d5b]">
        <div class="bg-white border-2  p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Contact Details</h1>
            <form action="ReserveForm.php" method="post" class="flex flex-col items-center gap-5">
                
                <!-- Name Input -->
                <input 
                    type="text" 
                    name="Fullname" 
                    id="Fname" 
                    placeholder="Enter Name" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 transition duration-200 hover:shadow-lg hover:border-indigo-500" 
                required>
    
                <!-- Email Input -->
                <input 
                    type="email" 
                    name="Email" 
                    id="Email" 
                    placeholder="Enter Email" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 transition duration-200 hover:shadow-lg hover:border-indigo-500"
                required>
    
                <div class="flex items-center space-x-2">
    <!-- Dropdown for Country Code -->
    <select 
        name="country_code" 
        id="countryCode" 
        class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[5vh] w-[15vw] placeholder-gray-500 rounded-md px-2 transition duration-200 hover:shadow-lg hover:border-indigo-500" 
        required>
        <!-- Options will be dynamically populated -->
    </select>

    <!-- Phone Number Input -->
    <input 
        type="tel" 
        name="number" 
        id="phoneNumber" 
        placeholder="Phone Number" 
        pattern="[0-9]{7,15}" 
        class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[5vh] w-[25vw] placeholder-gray-500 rounded-md px-3 transition duration-200 hover:shadow-lg hover:border-indigo-500" 
        required>
</div>

        <!-- Textarea -->
                <textarea 
                    name="askUs" 
                    id="ask" 
                    placeholder="Enquire" 
                    class="border-2 border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none h-[6vh] w-[30vw] placeholder-gray-500 rounded-md px-3 py-2 transition duration-200 hover:shadow-lg hover:border-indigo-500"
                required></textarea>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="bg-indigo-500 text-white font-semibold py-2 px-6 rounded-md transition duration-200 hover:bg-indigo-600 hover:shadow-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" name="submitContact"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
    
    <script>

    // Fetch Country Data
// Fetch Country Data
async function loadCountryCodes() {
    const selectElement = document.getElementById('countryCode');
    try {
        const response = await fetch('https://restcountries.com/v3.1/all'); // REST Countries API
        const countries = await response.json();

        // Sort countries alphabetically
        countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

        // Populate dropdown
        countries.forEach(country => {
            if (country.idd && country.idd.root && country.idd.suffixes) {
                const countryCode = `${country.idd.root}${country.idd.suffixes[0]}`;
                const option = document.createElement('option');
                option.value = countryCode;

                // Set option text with flag, name, and code
                option.innerHTML = `
                    ${country.name.common} (${countryCode})
                `;
                selectElement.appendChild(option);
            }
        });
    } catch (error) {
        console.error('Error loading country codes:', error);
    }
}

// Load data on page load
window.addEventListener('DOMContentLoaded', loadCountryCodes);





    </script>
    
</body>
</html>
