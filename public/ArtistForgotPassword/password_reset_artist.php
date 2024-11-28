<?php

    require "../connection.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;



    $EmailReset = $_POST['Email'];

    // getting the email from the database and checking if it matches upto the database or the not

    $sqlQuer = "select Artistmail from artistsignup_tb where Artistmail = ?";

    //preparing the statement

    $stmt = $conn->prepare($sqlQuer);

    //binding the parameter from the statements

    $stmt->bind_param('s',$EmailReset);

    //ececuting the query
    
    if($stmt->execute()===true){

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc())
        {
            if($EmailReset===$row['Artistmail'])
            {
                //now for the token
    
             $token = bin2hex(random_bytes(16));
    
        //storing the token into the database by making it hashed and not plain
        //also using the sha256 algorithm to convert the plain hash value into the encrypted value 
        
             $hashedToken = hash("sha256",$token); //returns the 64 character string
    
        //to avoid the brute force attack from guessing the token value we will generate the token expiry time if the token is expired then the user or the admin can ask for the new token
    
        //here time() returns the current time from the system
        
            $expiry = date("Y-m-d H:i:s",time() + 60 * 30);//the token will expire after the 30 seconds
    
    
        //updation of the table
            $sql = "UPDATE artistsignup_tb SET token_hash = ?,token_expires=? where Artistmail = ?  ";
    
        //preparing the statement
    
        $stm = mysqli_prepare($conn,$sql);
    
        //binding of the parameter into the statement
    
        $stm->bind_param('sss',$hashedToken,$expiry,$EmailReset);
    
        //execution of the statement
       if( $stm->execute()){
        echo "updation successful";
        
                //Create an instance; passing `true` enables exceptions
                require '../PHPmailer/Exception.php';
                require '../PHPmailer/PHPMailer.php';
                require '../PHPmailer/SMTP.php';
      
            $mail = new PHPMailer(true);
     
            try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sandipthapa383@gmail.com';                     //SMTP username
            $mail->Password   = 'bjjs cstk gndu hfdj';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom($EmailReset, 'User');
            $mail->addAddress('sandipthapa383@gmail.com', 'Admin');     //Add a recipient
        
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);  // Set email format to HTML
    
            $mail->Body = " click <a href='http://localhost/Project-V/public/ArtistForgotPassword/reset_password_artist.php?token=$token' > here </a> to reset your password" ;
            
            $mail->send();
            header("Location:Back_Login_artist.html");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
       }
        else{
        echo "Sorry the updation is not completed";
        }
            }
        }

    }

?>