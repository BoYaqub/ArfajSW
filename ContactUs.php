<?php
$Title = "Contact Us";
include('Header.php'); 
include('connect-db.php');

require_once ('mail/class.phpmailer.php');


if(isset($_POST['send']))
{
    
    //Retriieve POST values
 	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	
    
    //Create an Object to the PHPMailer Class
	$mail = new PHPMailer();
	
    //Set the From Address - What user entered
	$mail->From = $email;
	$mail->FromName = $name;

    //Set the To Address
	$mail->AddAddress('oruchimaro@gmail.com');
	

    //Set the Subject and the Message Body
	$mail->Subject = "You have been contacted from KFU-Events";
	$mail->Body = $message;
    
    //SMTP Settings
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "smtp.drmisbha.net";
	$mail->Port = 587;
	$mail->Username = 'test@drmisbha.net';
	$mail->Password = 'ccsit_Kfu2013';

    //Success or Failure
    if($mail->Send())
	{
		header('Location: ContactUs.php?status=send');
	}
	else {
		header('Location: ContactUs.php?status=error');
	}   
}

?>
          
          
          
          
          
          <div id="ConactContent">
              <h2 id="ContactHeader">Contact Us</h2>
          <?php if(isset($_GET['status']) && $_GET['status']=='send') { ?>
    <p>Thank you for Contacting Us. We will be in touch shortly.</p>
    <?php }else if(isset($_GET['status']) && $_GET['status']=='error') { ?>
    <p>Sorry, the mail could not be send. </p>
    <?php } else { ?>
          
    <form name="ContactUsForm" action="ContactUs.php" method="post" onsubmit="return validate();">
      <table class="Table">
          
          <tr>
            <td><label for="ContactName">Name:</label></td>
            <td><input type="text" name="name"/></td>
          </tr>
          
          <tr>
            <td><label for="ContactMail">Email:</label></td>
            <td><input type="email" name="email"/></td>
          </tr>
          
          <tr>
            <td><label for="ContactComment">Comment:</label></td>
            <td><textarea name="message" cols="19" rows="7"></textarea></td>
          </tr>
      </table>

                     
        <input type="submit" class="CustomButtonA" name="send" id="ContactUsSubmit" onclick="validate();" value="Send" />
        <a href="" class="CustomButtonA" >Reset</a>
               
    </form>
          <?php }?>
          </div>   
      
      <script>
      
          function validate(){
            var name = document.ContactUsForm.name.value;
            var email = document.ContactUsForm.email.value;
            var comment = document.ContactUsForm.message.value;
            var flag = true;
            if(name=="")
          { document.ContactUsForm.name.style.backgroundColor="#FFC7C7";
          document.ContactUsForm.name.setAttribute("placeholder","Required");
          flag = false;
          }
              else { document.ContactUsForm.name.style.backgroundColor="#FFF"; 
                   document.ContactUsForm.name.setAttribute("placeholder","");
                   flag = true;
                   }
            if(email=="")
          { document.ContactUsForm.email.style.backgroundColor="#FFC7C7";
          document.ContactUsForm.email.setAttribute("placeholder","Required");
          flag = false;
          }
              else { document.ContactUsForm.email.style.backgroundColor="#FFF";
                   document.ContactUsForm.email.setAttribute("placeholder","");
                   flag = true;
                   }
            if(comment=="")
          { document.ContactUsForm.message.style.backgroundColor="#FFC7C7";
          document.ContactUsForm.message.setAttribute("placeholder","Required");
          flag = false;
          }
              else { document.ContactUsForm.message.style.backgroundColor="#FFF";
                   document.ContactUsForm.message.setAttribute("placeholder","");
                   flag = true;
                   }
                   if(flag){return true;}
                   else {return false;}
          }
            
      </script>

<?php include('Footer.php'); ?>