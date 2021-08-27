<?php 
// how to - download pdf file instead opening in browser
downlaod_PDF_file('https://greyscout.com/wp-content/uploads/2021/04/GreyScout-Counterfeit-Primer.pdf');

function downlaod_PDF_file($pdflink='') {
  $url = $pdflink;
  $file_name = basename($url);

  @header("Content-disposition: attachment; filename=".$file_name);
  @header("Content-type: application/pdf");
  @readfile($url);
}