<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.239.21/r1/CO-QA/GOB/DAFP-0022/SIGEP/wsConsultaHojaVida',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>'ewogICJub21icmVVc3VhcmlvIjogIjgwODU0Mzg1IiwKICAiY29udHJhc2VuYUUiOiAiRkpYa2lJOVZVeE9VcmNMOFhocnpuQT09IiwKICAiY29kaWdvU2lnZXAiOiAiMjczNyIKfQo=',
  CURLOPT_HTTPHEADER => array(
    'Accept: text/plain',
    'Content-Type: text/plain',
    'typeResponse: json',
    'x-road-client: CO-QA/GOB/SNR-0027/FM-SIR-QA',
    'token: eyJhbGciOiJIUzUxMiJ9.eyJleHAiOjE2NTIyODM2MDYsInN1YiI6IkF1dGVudGljYWNpb24gU0lHRVAiLCJpc3MiOiJTSUdFUElJLTI5Njk5MyIsImF1ZCI6IjgwODU0Mzg1In0.2wP7KEzJARN_yvx_kbwo0oWCYcxmZviNl6K67MsuQB88al9QBWCCi05CMxCZzTOCzepxGZdUFajCOoCaUs2mxQ',
    'json: eyAidGlwb0RvY3VtZW50byI6ICJDRURVTEEgREUgQ0lVREFEQU5JQSIsICJudW1lcm9kb2N1bWVudG8iOiAiODgyMzY4MTciIH0='
  ),
));

$response = curl_exec($curl);
curl_close($curl);

//$character=json_decode($response);
print_r($response);
?>



