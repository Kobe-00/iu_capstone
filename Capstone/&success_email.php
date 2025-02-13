
<?php
session_start();
require 'PHPMailer/PHPMailerAutoload.php';



if(isset($_POST['registered'])){


    $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");
    if (!$con)
    {die("Failed to connect to MySQL: " . mysqli_connect_error()); }

    $loginemail = $_SESSION['email'];
    $sql = "SELECT *
        FROM users
        WHERE email = '$loginemail'";



    $match_result = mysqli_query($con,$sql);
    if( mysqli_num_rows($match_result) == 1) {
        
        $sql1 = "SELECT *
        FROM emailNotification AS eM
        JOIN users as u on u.userID = eM.userID
        JOIN applicationForm as a on a.appID = eM.appID
        WHERE u.email = '$loginemail'";
    
        $result = $con -> query($sql1);

        $mail = new PHPMailer;

        // $mail->SMTPDebug = 3;                               // Enable verbose debug output
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'dandy0425@outlook.com';                 // SMTP username
        $mail->Password = 'Ajtwoddl970425!';                           // SMTP password
        $mail->SMTPSecure = 'STARTTLS';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        
        $mail->setFrom('dandy0425@outlook.com', 'Parking Share');
        $mail->addAddress($_SESSION['email']);     // Add a recipient
        $mail->addReplyTo('dandy0425@outlook.com', 'Parking Share');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = 'Order Confirmation';

        if  ($result -> num_rows > 0 ) {
            while ($row = $result -> fetch_assoc()) 
            {
    
    
                       // Add attachments
            }
        }
    
        
        $mail->Body    =                 
                        '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px">'
                        .'<center><img src="cid:check"></center>'. 
                        '<center><h1> THANK YOU FOR YOUR ORDER</h1></center><br><center>PARKING FEE: $'.$_SESSION['price'].'</center><br>
                        <center>LOCATION: '.$_SESSION['address'].'</center><br>
                        <center>ARRIVING TIME: '.$_SESSION['dateAvaliable']."&nbsp;&nbsp;&nbsp;".$_SESSION['startTime'].'</center><br>
                        <center>LEAVING TIME: '.$_SESSION['dateAvaliable']."&nbsp;&nbsp;&nbsp;".$_SESSION['endTime'].'</center><br>
                        <center>RENTOR: '.$_SESSION['fname']." ".$_SESSION['lname'].'</center><br>
                        <center>NOTES: '.$_SESSION['notesByRentor'].'</center>'
                    .'</span>';
        $mail->AddEmbeddedImage('images/email_check.png','check');  
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>location.replace('&payment_complete.php');</script>";
        }
    }
}

else if(isset($_POST['new'])){
    $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");
    if (!$con)
    {die("Failed to connect to MySQL: " . mysqli_connect_error()); }

    $loginemail = $_SESSION['email'];
    echo $loginemail;

    $sql = "SELECT *
    FROM emailNotification AS eM
    JOIN users as u on u.userID = eM.userID
    JOIN applicationForm as a on a.appID = eM.appID
    WHERE u.email = '$loginemail'";

    $result = $con -> query($sql);


    $mail = new PHPMailer;

    $mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'dandy0425@outlook.com';                 // SMTP username
    $mail->Password = 'Ajtwoddl970425!';                           // SMTP password
    $mail->SMTPSecure = 'STARTTLS';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    
    $mail->setFrom('dandy0425@outlook.com', 'Parking Share');
    $mail->addAddress($_POST['new']);     // Add a recipient
    $mail->addReplyTo('dandy0425@outlook.com', 'Parking Share');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Order Confirmation';


    if  ($result -> num_rows > 0 ) {
        while ($row = $result -> fetch_assoc()) 
        {


        }
    }

    
    $mail->Body    = 
                    '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px">'
                        .'<center><img src="cid:check"></center>'. 
                        '<center><h1> THANK YOU FOR YOUR ORDER</h1></center><br><center>PARKING FEE: $'.$_SESSION['price'].'</center><br>
                        <center>LOCATION: '.$_SESSION['address'].'</center><br>
                        <center>ARRIVING TIME: '.$_SESSION['dateAvaliable']."&nbsp;&nbsp;&nbsp;".$_SESSION['startTime'].'</center><br>
                        <center>LEAVING TIME: '.$_SESSION['dateAvaliable']."&nbsp;&nbsp;&nbsp;".$_SESSION['endTime'].'</center><br>
                        <center>RENTOR: '.$_SESSION['fname']." ".$_SESSION['lname'].'</center><br>
                        <center>NOTES: '.$_SESSION['notesByRentor'].'</center>'
                    .'</span>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->AddEmbeddedImage('images/email_check.png','check');  
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
    else {
        echo "<script>location.replace('&payment_complete.php');</script>";
    }
}
?>