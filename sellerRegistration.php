<?php session_start();?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Registration</title>
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <style>
      .seller_body {
        background-color:#F5F5F5;
        margin-top:0;
        width:100% ;
        margin: 0 auto;
        font-family: pretendard, sans-serif;
      }
      .sellerRegister_div {
        margin-top:5vh;
        background-color:white;
        border-radius:10px;
        -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
        -moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
        box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);

      }
      .seller_info_div {
        display:flex;
        flex-direction:column;
        align-items:center;
        padding:4.0em 1.0em;

      }
      .regi_1 {
        display:flex;
        flex-direction:row;
        justify-content:space-between;
        padding-bottom:1.5em;
        gap:1.0em;
      }
      div.input-block {
        position: relative;
    }
    div.input-block input {
    font-weight: 500;
    font-size: 11px;
    color: #31302F;
    width: 262px;
    padding: 8px 13px 8px;
    border-radius: 5px;
    border: 1px solid #ababab;
    /* -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
  -moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
  box-shadow: 0px 0px 15px 0px rgba(222,222,222,1); */
    outline:none;
    }
    div.input-block span.placeholder {
    position: absolute;
    background-color:white;
    font-family: Roboto, sans-serif;
    color:  #ADABAB;
    display: flex;
    align-items: center;
    font-size: 12px;
    top:7px;
    left: 15px;
    transition: all 0.2s;
    transform-origin: 0% 0%;
    background: none;
    pointer-events: none;
    }
    div.input-block input:valid + span.placeholder,
    div.input-block input:focus + span.placeholder {
    transform: scale(0.8) translateY(-16px);
    background: #fff;
    }
    div.input-block input:focus{
    color: #31302F;
    border-color: #E63946;
    }
    div.input-block input:focus + span.placeholder {
    color: #E63946;
    }      
    .login_button2 {
    margin-top:2.0em;
    background: #E63946;
    border-radius: 5px ;
    border:none;
    font-weight: 600;
    color: #FFFFFF;
    padding: 0.5em 0.5em;
    }

    select {

/* styling */

color:#ADABAB;
font-weight: 600;
background-color: white;
border: thin solid #ababab;
border-radius: 5px;
display: inline-block;
font: inherit;
line-height: 1.70em;
padding: 0.5em 3.5em 0.5em 1em;

/* reset */

margin: 0;      
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
-webkit-appearance: none;
-moz-appearance: none;
}

    select.minimal {
        font-size:11px;
        font-weight:600;
  background-image:
    linear-gradient(45deg, transparent 50%, gray 50%),
    linear-gradient(135deg, gray 50%, transparent 50%),
    linear-gradient(to right, #ccc, #ccc);
  background-position:
    calc(100% - 15px) calc(0.65em + 5px),
    calc(100% - 10px) calc(0.65em + 5px),
    calc(100% - 2.75em) 0.5em;
  background-size:
    5px 5px,
    5px 5px,
    1px 1.7em;
  background-repeat: no-repeat;
}

select.minimal:focus {
  background-image:
    linear-gradient(45deg, #E63946 50%, transparent 50%),
    linear-gradient(135deg, transparent 50%, #E63946 50%),
    linear-gradient(to right, #E63946, #E63946);
  background-position:
  calc(100% - 10px) calc(0.65em + 5px),
    calc(100% - 15px) calc(0.65em + 5px),
    calc(100% - 2.75em) 0.5em;
  background-size:
    5px 5px,
    5px 5px,
    1px 1.7em;
  background-repeat: no-repeat;
  border-color: #E63946;
  outline: 0;
}


select:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #31302F;
}
textarea {
    font-family: pretendard, sans-serif;
    margin-bottom:2.0em;
    padding:1.0em;
    color:#31302F;
    font-size:11px;
    border: thin solid #ababab;
    border-radius: 5px;
    /* -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
  -moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
  box-shadow: 0px 0px 15px 0px rgba(222,222,222,1); */
}


    </style>
    
  </head>


<html>
  
  <body class="seller_body">
  <?php include('includes/header.php'); ?>
    <main class="sellerRegister_div">
      <div class="seller_info_div">
        <p name = titleFont><strong style="font-size:24px;">Register Parking Spaces</strong></p>
        <p style="color:#ADABAB; font-size:12px; margin:2.0em 0 4.0em 0;">Please enter your information</p>

        <form id="sellerRegistration" name="sellerRegistration" action="validate.php" method="post">
            <?php 
              $error_message = $_POST['hiddenField'];
              echo $error_message;
            ?>
            <div class="regi_1">
                <div class="input-block">
                    <input style ="width:200px;" type="text" id="address" name="address"  size="20"  required spellcheck="false">
                    <span class="placeholder">Address</span>
                </div>
                <div class="input-block">
                    <input style ="width:200px;" type="text" id="zip" name="zip"  size="20"  required spellcheck="false">
                    <span class="placeholder">Zip Code</span>
                </div>
            </div>

            <div class="regi_1">
                <div class="input-block">
                    <p style="font-size:x-small">Day Parking Space Opens</p>
                    <input type="date" style="width:200px;" id="start" name="start" min="<?echo date('Y-m-d');?>">
                    <p style="font-size:x-small">Date Parking S[pace Closes</p>
                    <input type="date" style="width:200px;" id="end" name="end" min="<?echo date('Y-m-d');?>">
                </div>
                
                <div class="input-block">
                    <!-- <h3>Time Available</h3> -->
                    <p style="font-size:x-small">Time available (Hold control to select multiple)</p>
                    <select style="width:227px; height:78px;font-size:11px;padding:0 auto;" id="time" name="time[]" multiple='multiple'>
                        <option value="1:00,2:00">1:00-2:00</option>
                        <option value="2:00,3:00">2:00-3:00</option>
                        <option value="3:00,4:00">3:00-4:00</option>
                        <option value="4:00,5:00">4:00-5:00</option>
                        <option value="5:00,6:00">5:00-6:00</option>
                        <option value="6:00,7:00">6:00-7:00</option>
                        <option value="7:00,8:00">7:00-8:00</option>
                        <option value="8:00,9:00">8:00-9:00</option>
                        <option value="9:00,10:00">9:00-10:00</option>
                        <option value="10:00,11:00">10:00-11:00</option>
                        <option value="11:00,12:00">11:00-12:00</option>
                        <option value="12:00,13:00">12:00-13:00</option>
                        <option value="13:00,14:00">13:00-14:00</option>
                        <option value="14:00,15:00">14:00-15:00</option>
                        <option value="15:00,16:00">15:00-16:00</option>
                        <option value="16:00,17:00">16:00-17:00</option>
                        <option value="17:00,18:00">17:00-18:00</option>
                        <option value="18:00,19:00">18:00-19:00</option>
                        <option value="19:00,20:00">19:00-20:00</option>
                        <option value="20:00,21:00">20:00-21:00</option>
                        <option value="21:00,22:00">21:00-22:00</option>
                        <option value="22:00,23:00">22:00-23:00</option>
                        <option value="23:00,24:00">23:00-24:00</option>
                        <option value="24:00,1:00">24:00-1:00</option>
                      </select>

                </div>
            </div>

            <div class="regi_1">
                <div class="input-block">
                    <input style ="width:200px;" type="text" id="price" name="price"  size="20"  required spellcheck="false">
                    <span class="placeholder">Price per Hour</span>
                </div>
                <div class="input-block">
                    <input style ="width:200px;" type="date" id="dob" name="dob"  size="20"  required spellcheck="false" max="<?echo date('Y-m-d');?>">
                    <span class="placeholder">Date of Birth</span>
                </div>


            </div>
            <div class="input-block">
                <textarea id="notes" name="notes"  rows="5" cols="80" placeholder='Any additional information to buyer' autofocus></textarea>

            </div>

            <input style="width:100px; float:right; " class ="login_button2" type="submit" value="REGISTER"/>

                
        </form>
        
        
      </div>

    </main>
  
  </body>

</html>