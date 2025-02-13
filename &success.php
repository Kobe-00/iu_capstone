
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Email</title>
    <style>
        <?php include('includes/header.php'); ?>
        
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

</head>


<body style="background-color:#F5F5F5; position:relative;">
    
    <main class="sucess_main" style="width:50%;">
        <h1 class="subheading">NOTIFICATION EMAIL</h1>
        <hr class="solidline">
        <img style = "display: block; margin: 2.0em auto 0 ; height: 40px;"src="images/EMAIL@4x.png">
            <center>
                <h2 style="margin:2.0em;">WHERE DO YOU WISH TO RECEIVE</h2>
                <div class="div_box">
                    <form action="&success_email.php" method='POST'>
                        <div class="div_elem">
                            <input  type="checkbox"  name="registered" value="<?php $_SESSION['email']?>" checked="checked">
                                <label for="registered">CURRENT EMAIL ADDRESS:&nbsp<?php $_SESSION['email']; echo ''.$_SESSION['email'];?></label><br><br><br>
                            <input  type="checkbox"  name="new" value="new">
                                <label for="new">NEW EMAIL ADDRESS:&nbsp</label>
                                <input style="border:none; background-color:#F5F5F5; color:#ABABAB; padding:0.5em 1.0em; border-radius:5px; width:141px;"for="new" type="email" name ="new" placeholder='Email address'><br>
                                <button class="email_button" type="submit" name="choice_submit">SEND EMAIL</button>
                        </div>
                    </form>
                </div>

            </center>
    </main>
    <script>
    const emailInput = document.querySelector('input[type="email"]');
    const newCheckbox = document.querySelector('input[name="new"]');
    
    emailInput.addEventListener('click', function() {
        newCheckbox.checked = true;
    });
    </script>
</body>

</html>



    
