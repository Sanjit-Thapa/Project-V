<?php 
    require "connection.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 

    if (isset($_POST['Reject']) || isset($_POST['Accept'])) {
        // Determine the status decision based on which button was pressed
        $Decide = isset($_POST['Reject']) ? $_POST['Reject'] : $_POST['Accept'];
        $num = $_POST['id'];
        
        //selection of the email address to which the mail should be sent out
         $sqlSel = "select Artistmail from artistsignup_tb where Artist_Id = $num";

         $resultSel = $conn -> query($sqlSel);
         
         if($row = mysqli_fetch_assoc($resultSel))
         {
                $recieptant =  $row['Artistmail'];
         }
         else{
            echo "sorry the mail couldn't be found";
         }
         
        // Prepare the SQL statement
        $sqlUpd = "UPDATE artistsignup_tb SET Status = ? WHERE Artist_Id = ?";
        $stm = $conn->prepare($sqlUpd);
    
        $stm->bind_param('si', $Decide, $num);
    
        // Execute the query and check if the update was successful
        if ($stm->execute() === true) {
            echo "Status successfully updated to '$Decide'.";
            mailing( $recieptant, $Decide);//to send the mail alert about the status to the certain artist who were signed up
          
        } else {
            echo "Sorry, the status couldn't be updated.";
        }

         if($Decide==="Rejected")
            {
                removeUser($recieptant);
            }
        
        $stm->close();
    } else {
        echo "Something might be missing.";
    }
    

    //removing the Rejected user from the the Database 

    function removeUser($rec)
    {
        require "connection.php";
        global $Decide;
       $sqlRem = "Delete from artistsignup_tb where Artistmail = '$rec'";
        
      $result = $conn->query($sqlRem);

      if($result){
            echo "Deleted since status is $Decide";
      }
      
    }

    //mail code

    function mailing($recieptant,$Decide)
    {
    
//Load Composer's autoloader
   require 'PHPmailer/Exception.php';
   require 'PHPmailer/PHPMailer.php';
   require 'PHPmailer/SMTP.php';
 
//Create an instance; passing `true` enables exceptions
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
    $mail->setFrom('', 'ArtGallery');
    $mail->addAddress($recieptant, 'Artist');     //Add a recipient
 

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    if($Decide === "Approved")
    {
        $mail->Body    = "sender message: You are $Decide and now you can enter your email and password to login";
    }
    else{
        $mail->Body    = "sender message: Sorry you are $Decide but you can again enter the details through the signup form";
    }

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

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

        <table class="border-2 w-full text-center mt-1 p-2 ">
            <thead class="border-2" >
                <tr class="border-2 text-indigo-800 text-[1.2vw]">
                    <th>Artist Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Decide</th>
                </tr>
            </thead>
        
          
            <?php

     
            $sqlget = "select Artist_id,Username,Artistmail,Status from artistsignup_tb";

            $result = $conn->query($sqlget);
            // Loop through each row and output data in table rows
            if($result)
            {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<form action='ArtistStatus.php' method = 'POST' >";
                    echo "<tr class='border-2 p-2 hover:bg-gray-200' >";
                    echo "<td><input type='number' name='id' value='{$row['Artist_id']}' readonly class='w-16 h-6 text-center bg-transparent border-none pointer-events-none'></td>";
                    ;
                    echo "<td>" . $row['Username'] . "</td>";
                    echo "<td>" . $row['Artistmail'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "<td class='p-3'>
                    <button name='Reject' class='border-2 font-semibold hover:bg-red-700 hover:text-white 
                rounded-full bg-red-500 text-white w-[6vw] h-[5vh] transition duration-300 ease-in-out' value='Rejected'>
                    Rejected
                 </button>
    
                     <button name='Accept' class='ml-4 border-2 font-semibold hover:bg-green-700 hover:text-white 
                        rounded-full bg-green-500 text-white w-[6vw] h-[5vh] transition duration-300 ease-in-out' value='Approved' >
                          Approved
                     </button>
    </td>
    "; // Example button in the "Decide" column
                    echo "</tr>";
                    echo "</form>";
                }
            }
            else{
                echo "<tr><td colspan='5'>Data is not fetched</td></tr>";
            }
           
        
        ?>
            </tbody>
        </table>

    
</body>
</html>
