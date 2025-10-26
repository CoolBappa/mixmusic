<?php
$php_self = $_SERVER['PHP_SELF'];
$headsetadmin = $db->query('select * from `admin` where id = 1' , database::GET_ROW);
// on submit
if( isset($_POST[name]) && isset($_POST[email]) && isset($_POST[message]) && isset($_POST[captcha]) ){
$name = $_POST[name];
$email = $_POST[email];
$message = $_POST[message];
$captcha = $_POST[captcha];
$error = 0;
// name
if( $name == "" ){ $error ++; $error_name = "has-error"; }
// email
if( $email == "" ){ $error ++; $error_email = "has-error"; }
// message
if( $message == "" ){ $error ++; $error_message = "has-error"; }
// captcha
if( $captcha == "" || $captcha != $_SESSION[captcha]){ $error ++; $error_captcha = "has-error"; }
// no error, send email
if( $error == 0){               
// your email address
$address = $headsetadmin['email'];
// email subject
$subject = "$name";
// email content
$name = "Name:$name";
$email = "Email address: $email";
$content = "Message:$message";
// html email
$email_content = "<html><body>";
$email_content .= "<h3>$name</h3>";
$email_content .= "<p style='border:#d3d3d3;background:#f2f2f2;padding:15px;'>$content</p>";
$email_content .= "<p>$email</p>"; 
$email_content .= "</html></body>";                    
// headers for html email
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
// send email
mail($address, $subject, $email_content, $headers);         
// reset variables
$name = ""; $email = ""; $message = "";
$mail_sent = 1;                                                             
}
}
$num = rand(1, 20);
$num2 = rand(1, 9);     
$verif = $num . "+" . $num2;
$_SESSION[captcha] = $num + $num2;      
$def = contact;
include 'header.tpl';
echo '<h2 class="title-red">Contact Us</h2>';
if( $mail_sent == 1 ){
echo '<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>';
}
echo '<div class="fileinfo text-center">';
echo "
<form action='/contact/' method='post' class='form-horizontal' role='form'>
<fieldset>
<div class='form-group ".$error_name."'>
<label class='col-xs-4 control-label'>Name</label>  
<div class='col-xs-6 inputGroupContainer'>
<div class='input-group'>
<span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
<input  name='name' placeholder='Name' class='form-control'  type='text' value='".$name."'>
</div>
</div>
</div>
<div class='form-group ".$error_email."'>
<label class='col-xs-4 control-label error'>Email</label>  
<div class='col-xs-6 inputGroupContainer'>
<div class='input-group'>
<span class='input-group-addon'><i class='glyphicon glyphicon-envelope'></i></span>
<input  name='email' placeholder='Email' class='form-control'  type='email' value='".$email."'>
</div>
</div>
</div>
<div class='form-group ".$error_message."'>
<label class='col-xs-4 control-label'>Message</label>  
<div class='col-xs-6 inputGroupContainer'>
<div class='input-group'>
<span class='input-group-addon'><i class='glyphicon glyphicon-pencil'></i></span>
<textarea ".$error_message." placeholder='Message' name='message' class='form-control'></textarea>
</div>
</div>
</div>
<div class='form-group ".$error_captcha."'>
<label class='col-xs-4 control-label'>How much is ".$verif." = ?</label>  
<div class='col-xs-2 inputGroupContainer'>
<input class='form-control' type='text' ".$error_captcha." name='captcha' value=''>
</div>
</div>
<div class='form-group'>
<label class='col-md-4 control-label'></label>
<div class='col-md-6'>
<button type='submit' class='btn btn-block btn-success' >Send <span class='glyphicon glyphicon-send'></span></button>
</div>
</div>
</fieldset>
</form>";
?>
</div>
<? include 'footer.tpl';?>