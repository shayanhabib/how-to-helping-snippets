<?php 
if(isset($_GET['submit'])) {
  if($_GET['submit']=="ok") {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $message = mysqli_real_escape_string($db, $_POST['message']); 
    $datetime = date("Y-m-d H:i:s");

    $headers = "From: no-reply@ukvisashelp.com";
    $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

    $msg = "Name: ".$name."\r\n";
    $msg .= "Email: ".$email."\r\n";
    $msg .= "Phone: ".$phone."\r\n";
    $msg .= "Date/Time: ".$datetime."\r\n";
    $msg .= "Message: ".$message."\r\n";

    //Get uploaded file data
    $file_tmp_name    = $_FILES['my_file']['tmp_name'];
    $file_name        = $_FILES['my_file']['name'];
    $file_size        = $_FILES['my_file']['size'];
    $file_type        = $_FILES['my_file']['type'];
    $file_error       = $_FILES['my_file']['error'];

    if($file_error > 0)
    {
        die('Upload error or No files uploaded');
    }
    //read from the uploaded file & base64_encode content for the mail
    $handle = fopen($file_tmp_name, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $encoded_content = chunk_split(base64_encode($content));

    $boundary = md5("xayncreations");
    //header
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "From:no-reply@ukvisashelp.com\r\n"; 
    $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
    
    //plain text 
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
    $body .= chunk_split(base64_encode($msg)); 
    
    //attachment
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $file_type; name=".$file_name."\r\n";
    $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
    $body .= $encoded_content; 

    $to = "enquiries@ukvisashelp.com";
    $subject = "New request - UK Visas Help";
    
    $mail = @mail($to, $subject, $body, $headers) or die("Oops! Some problems occur in sending mail..");
    if(!$mail) { 
        echo 'Something went wrong while registering. Please try again later.';
        echo "<script>window.location='./requestform'</script>";
    }
    else {
        echo 'Successfully submitted. We will contact you soon !';
        echo "<script>window.location='./requestform'</script>";
    }
    //
  }
}
?>

<div class="col40">
  <form action="./requestform?submit=ok" method="post" enctype="multipart/form-data">
    <p><input type="text" placeholder="Full Name" name="name"></p>
    <p><input type="email" placeholder="Email" name="email"></p>
    <p><input type="text" placeholder="Phone Number" name="phone"></p>
    <p><textarea name="message" style="height: 200px;" placeholder="Tell us about your case"></textarea></p>
    <p>Select A File To Upload:</p>
    <p><input type="file" name="my_file" /></p>
    <p><input type="submit" value="Submit Request" style="font-size: 14px; padding: 10px 20px; line-height: normal !important;"></p>
  </form>
</div>