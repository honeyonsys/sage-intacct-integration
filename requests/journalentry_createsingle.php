<?php

require '../configure.php';

// request doc: https://developer.intacct.com/api/general-ledger/journal-entries/#create-journal-entry
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
        <function controlid="{{$guid}}">
            <create>
            <GLBATCH>
                <JOURNAL>GJ</JOURNAL>
                <BATCH_DATE>03/31/2018</BATCH_DATE>
                <BATCH_TITLE>Payroll accrual 03/31/2018</BATCH_TITLE>
                <ENTRIES>
                    <GLENTRY>
                        <ACCOUNTNO>62510</ACCOUNTNO>
                        <DEPARTMENT>1000</DEPARTMENT>
                        <LOCATION>Big Corporate</LOCATION>
                        <CURRENCY>GBP</CURRENCY>
                        <TR_TYPE>-1</TR_TYPE>
                        <AMOUNT>5.50</AMOUNT>
                        <EXCH_RATE_TYPE_ID></EXCH_RATE_TYPE_ID>
                        <EXCHANGE_RATE>1</EXCHANGE_RATE>
                        <DESCRIPTION>Accrued salaries</DESCRIPTION>
                    </GLENTRY>
                    <GLENTRY>
                        <ACCOUNTNO>20001</ACCOUNTNO>
                        <DEPARTMENT>1031</DEPARTMENT>
                        <LOCATION>Big Corporate</LOCATION>
                        <CURRENCY>GBP</CURRENCY>
                        <TR_TYPE>1</TR_TYPE>
                        <AMOUNT>5.50</AMOUNT>
                        <EXCH_RATE_TYPE_ID></EXCH_RATE_TYPE_ID>
                        <EXCHANGE_RATE>1</EXCHANGE_RATE>
                        <DESCRIPTION>Salary expense</DESCRIPTION>
                    </GLENTRY>
                    
                </ENTRIES>
            </GLBATCH>
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