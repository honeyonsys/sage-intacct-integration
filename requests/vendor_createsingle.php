<?php

require '../configure.php';

// request doc: https://developer.intacct.com/api/accounts-payable/vendors/#create-vendor
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
                <VENDOR>
                    <VENDORID>TEST0001</VENDORID>
                    <NAME>TEST 001</NAME>
                    <DISPLAYCONTACT>
                        <PRINTAS>TEST CA</PRINTAS>
                        <COMPANYNAME>TEST CA</COMPANYNAME>
                        <TAXABLE>true</TAXABLE>
                        <TAXGROUP></TAXGROUP>
                        <PREFIX></PREFIX>
                        <FIRSTNAME></FIRSTNAME>
                        <LASTNAME></LASTNAME>
                        <INITIAL></INITIAL>
                        <PHONE1></PHONE1>
                        <PHONE2></PHONE2>
                        <CELLPHONE></CELLPHONE>
                        <PAGER></PAGER>
                        <FAX></FAX>
                        <EMAIL1/>
                        <EMAIL2/>
                        <URL1/>
                        <URL2/>
                        <MAILADDRESS>
                            <ADDRESS1></ADDRESS1>
                            <ADDRESS2></ADDRESS2>
                            <CITY></CITY>
                            <STATE></STATE>
                            <ZIP></ZIP>
                            <COUNTRY></COUNTRY>
                        </MAILADDRESS>
                    </DISPLAYCONTACT>
                    <ONETIME>false</ONETIME>
                    <STATUS>active</STATUS>
                    <HIDEDISPLAYCONTACT>false</HIDEDISPLAYCONTACT>
                    <VENDTYPE></VENDTYPE>
                    <PARENTID></PARENTID>
                    <GLGROUP></GLGROUP>
                    <SUPDOCID></SUPDOCID>
                    <TERMNAME></TERMNAME>
                    <APACCOUNT></APACCOUNT>
                    <TAXID></TAXID>
                    <CREDITLIMIT></CREDITLIMIT>
                    <ONHOLD>false</ONHOLD>
                    <COMMENTS></COMMENTS>
                    <CURRENCY></CURRENCY>
                    <CONTACTINFO>
                        <CONTACTNAME></CONTACTNAME>
                    </CONTACTINFO>
                    <PAYTO>
                        <CONTACTNAME></CONTACTNAME>
                    </PAYTO>
                    <RETURNTO>
                        <CONTACTNAME></CONTACTNAME>
                    </RETURNTO>
                    <PAYMETHODKEY>Printed Check</PAYMETHODKEY>
                    <MERGEPAYMENTREQ>true</MERGEPAYMENTREQ>
                    <PAYMENTNOTIFY>true</PAYMENTNOTIFY>
                    <BILLINGTYPE>openitem</BILLINGTYPE>
                    <PAYMENTPRIORITY>Normal</PAYMENTPRIORITY>
                    <TERMNAME></TERMNAME>
                    <DISPLAYTERMDISCOUNT>false</DISPLAYTERMDISCOUNT>
                    <ACHENABLED>true</ACHENABLED>
                    <ACHBANKROUTINGNUMBER>123456789</ACHBANKROUTINGNUMBER>
                    <ACHACCOUNTNUMBER>1111222233334444</ACHACCOUNTNUMBER>
                    <ACHACCOUNTTYPE>Checking Account</ACHACCOUNTTYPE>
                    <ACHREMITTANCETYPE>CTX</ACHREMITTANCETYPE>
                    <VENDORACCOUNTNO>9999999</VENDORACCOUNTNO>
                    <DISPLAYACCTNOCHECK>false</DISPLAYACCTNOCHECK>
                    <OBJECTRESTRICTION></OBJECTRESTRICTION>
                    <RESTRICTEDLOCATIONS></RESTRICTEDLOCATIONS>
                    <RESTRICTEDDEPARTMENTS></RESTRICTEDDEPARTMENTS>
                    <CUSTOMFIELD1></CUSTOMFIELD1>
                </VENDOR>
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