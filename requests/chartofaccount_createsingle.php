<?php

require '../configure.php';

// request doc: https://developer.intacct.com/api/general-ledger/accounts/#create-account
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $sageintacct_api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="UTF-8"?>
<request>
    <control>
        <senderid>'.$sender_id.'</senderid>
        <password>'.$sender_password.'</password>
        <controlid>'.$control_id.'</controlid>
        <uniqueid>false</uniqueid>
        <dtdversion>3.0</dtdversion>
        <includewhitespace>false</includewhitespace>
    </control>
    <operation>
        <authentication>
            <sessionid>'.$global_session_id.'</sessionid>
        </authentication>
        <content>
            <function controlid="'.$control_id.'">
                <create>
                    <GLACCOUNT>
                        <ACCOUNTNO>23801</ACCOUNTNO>
                        <TITLE>Commission Payable</TITLE>
                        <NORMALBALANCE>credit</NORMALBALANCE>
                        <ACCOUNTTYPE>balancesheet</ACCOUNTTYPE>
                    </GLACCOUNT>
                </create>
            </function>
        </content>
    </operation>
</request>',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/xml',
    'Cookie: DFT_LOCALE=en_US.UTF-8'
  ),
));

$response = curl_exec($curl);
curl_close($curl);

responseHandler($response);