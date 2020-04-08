<?php
$sandbox_acc = "hello-facilitator@xayncreations.com";

$client_id = "ASBa4W6bmeZDkJgq_kZWsToTP7jUAa4wb6TEwJR_BmWJ1uQvpw_6xSvRVmIXIKE0lvmCQZvxtsurmHRx";
$client_secret = "EGcDlvvfDjPJAsndkpQYLjdHIVVpJ8Tt1UYW9CRiabPL79kwGFJmCIavx8B66PoSEwSQpWkmxD-NtK1W";

$nvp_client_id =  "ATvtoqMAZlKcGlkf4n8tDdB_1pkqXsIxC-2fTR3H2dRi4LdvkPHKyYiw5V4YpppOcsiXvrHuVLchZTgu";
$nvp_client_secret = "EPx86qAZ3C1_aV9zHkRdugzcEQmTpiwX9bBwXhrwZHOIq_9L9y6hJjoSSwgjq1W08TyrKEuZnV1ZXJJ0";

$access_token = "A21AAEc9ekhn8-D6jCzF7ci5Hpi_vajpmqUzcq433UEhZNuDJx1Y_pkdm4TCl-y4uUv_TQTsrO5k2tNn3sF17rkFeB7tgO1Ig";

$api_username = "hello-facilitator_api1.xayncreations.com";
$api_password = "TY6862QSHJR9GQT8";
$api_signature = "AcwHW1pRNXCPSP7YTaV-Am.oLhqJAM55srjnCI7UoYZvD0okP-LPx2CM";

//get access token of above paypal developer account 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sandbox.paypal.com/v1/oauth2/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "grant_type=client_credentials",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Authorization: Basic QVNCYTRXNmJtZVpEa0pncV9rWldzVG9UUDdqVUFhNHdiNlRFd0pSX0JtV0oxdVF2cHdfNnhTdlJWbUlYSUtFMGx2bUNRWnZ4dHN1cm1IUng6RUdjRGx2dmZEalBKQXNuZGtwUVlMamRISVZWcEo4VHQxVVlXOUNSaWFiUEw3OWt3R0ZKbUNJYXZ4OEI2NlBvU0V3U1FwV2tteEQtTnRLMVc=",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Type: application/x-www-form-urlencoded",
    "Host: api.sandbox.paypal.com",
    "Postman-Token: c578e36d-2319-4a07-bbbf-34a23043ec14,2d102e31-e8c8-455e-86a7-eef279959afb",
    "User-Agent: PostmanRuntime/7.15.0",
    "accept-encoding: gzip, deflate",
    "cache-control: no-cache",
    "content-length: 29",
    "cookie: X-PP-SILOVER=name%3DSANDBOX3.API.1%26silo_version%3D1880%26app%3Dapiplatformproxyserv%26TIME%3D3641861725%26HTTP_X_PP_AZ_LOCATOR%3Dsandbox.slc"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $arr = json_decode($response);
  //var_dump($arr);
  //echo "<BR>";
  $scope = $arr->scope;
  $access_token = $arr->access_token;
  $token_type = $arr->token_type;
  $app_id = $arr->app_id;
  $expires_in = $arr->expires_in;
  $nonce = $arr->nonce;

  //create payout
  $headers = array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$access_token
  );
  $data = array(
    "sender_batch_header" => array(
      "sender_batch_id" => time(),
      "email_subject" => "You have a payout!",
      "email_message" => "You have received a payout! Thanks for using our service!"
    ),
    "items" => array(
      array(
        "recipient_type" => "EMAIL",
        "amount" => array(
          "value" => "9.87",
          "currency" => "USD"
        ),
        "note" => "Thanks for your patronage!",
        "sender_item_id" => "201403140001",
        "receiver" => "receiver@example.com"
      ),
      array(
        "recipient_type" => "EMAIL",
        "amount" => array(
          "value" => "9.87",
          "currency" => "USD"
        ),
        "note" => "Thanks for your patronage!",
        "sender_item_id" => "201403140002",
        "receiver" => "info@example.com"
      )
    )
  );

  $ch = curl_init( 'https://api.sandbox.paypal.com/v1/payments/payouts' );

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  $err = curl_error($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close($ch);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $arr = json_decode($response);
    //var_dump($arr);
    $payout_details_log = json_encode($arr);

    $payout_details_payout_batch_id = $arr->batch_header->payout_batch_id;
    $payout_details_batch_status = $arr->batch_header->batch_status;
    $payout_details_sender_batch_id = $arr->batch_header->sender_batch_header->sender_batch_id;
    $payout_details_email_subject = $arr->batch_header->sender_batch_header->email_subject;
    $payout_details_email_message = $arr->batch_header->sender_batch_header->email_message;

    $payout_details_href = $arr->links[0]->href;
    $payout_details_rel = $arr->links[0]->rel;
    $payout_details_method = $arr->links[0]->method;
    $payout_details_encType = $arr->links[0]->encType;

    //check transaction details
    $headers = array(
      "Content-Type: application/json",
      "Authorization: Bearer ".$access_token
    );
    $data = array();
    
    $ch = curl_init( $payout_details_href );

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $arr = json_decode($response);
      //var_dump($arr);
      $transaction_details_logs = json_encode($arr);

      $transaction_details_payout_batch_id = $arr->batch_header->payout_batch_id;
      $transaction_details_batch_status = $arr->batch_header->batch_status;
      $transaction_details_time_created = $arr->batch_header->time_created;
      $transaction_details_sender_batch_id = $arr->batch_header->sender_batch_header->sender_batch_id;
      $transaction_details_email_subject = $arr->batch_header->sender_batch_header->email_subject;
      $transaction_details_amount_currency = $arr->batch_header->amount->currency;
      $transaction_details_amount_value = $arr->batch_header->amount->value;
      $transaction_details_fees_currency = $arr->batch_header->fees->currency;
      $transaction_details_fees_value = $arr->batch_header->fees->value;

      $transaction_details_items = $arr->items;
      foreach ($transaction_details_items as $key => $value) {
        
        $transaction_details_payout_item_id = $value->payout_item_id;
        $transaction_details_transaction_status = $value->transaction_status;
        $transaction_details_payout_item_fee_currency = $value->payout_item_fee->currency;
        $transaction_details_payout_item_fee_value = $value->payout_item_fee->value;
        $transaction_details_payout_batch_id = $value->payout_batch_id;

        $transaction_details_payout_item_recipient_type = $value->payout_item->recipient_type;
        $transaction_details_payout_item_amount_currency = $value->payout_item->amount->currency;
        $transaction_details_payout_item_amount_value = $value->payout_item->amount->value;
        $transaction_details_payout_item_note = $value->payout_item->note;
        $transaction_details_payout_item_receiver_email = $value->payout_item->receiver;
        $transaction_details_payout_item_sender_item_id = $value->payout_item->sender_item_id;
        $transaction_details_payout_item_recipient_wallet = $value->payout_item->recipient_wallet;

        $transaction_details_links_zero_href = $value->links[0]->href;
        $transaction_details_links_zero_rel = $value->links[0]->rel;
        $transaction_details_links_zero_method = $value->links[0]->method;
        $transaction_details_links_zero_encType = $value->links[0]->encType;

      }

      $transaction_details_href = $arr->links[0]->href;
      $transaction_details_rel = $arr->links[0]->rel;
      $transaction_details_method = $arr->links[0]->method;
      $transaction_details_encType = $arr->links[0]->encType;

    }
    //check transaction details = end

  }
  //create payout = end


}
//get access token of above paypal developer account = end