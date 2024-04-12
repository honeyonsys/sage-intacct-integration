<?php

require '../configure.php';

// request doc: https://developer.intacct.com/api/accounts-receivable/customers/#create-customer
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
                <CUSTOMER>
                    <CUSTOMERID>C-07250</CUSTOMERID>
                    <NAME>CARE 1ST</NAME>
                    <DISPLAYCONTACT>
                        <PRINTAS>CARE 1ST</PRINTAS>
                        <COMPANYNAME>CARE 1ST</COMPANYNAME>
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
                    <CUSTTYPE></CUSTTYPE>
                    <PARENTID></PARENTID>
                    <GLGROUP></GLGROUP>
                    <TERRITORYID></TERRITORYID>
                    <SUPDOCID></SUPDOCID>
                    <TERMNAME></TERMNAME>
                    <OFFSETGLACCOUNTNO></OFFSETGLACCOUNTNO>
                    <ARACCOUNT></ARACCOUNT>
                    <SHIPPINGMETHOD></SHIPPINGMETHOD>
                    <RESALENO></RESALENO>
                    <TAXID></TAXID>
                    <CREDITLIMIT></CREDITLIMIT>
                    <ONHOLD>false</ONHOLD>
                    <DELIVERY_OPTIONS>Print</DELIVERY_OPTIONS>
                    <CUSTMESSAGEID></CUSTMESSAGEID>
                    <COMMENTS></COMMENTS>
                    <CURRENCY></CURRENCY>
                    <ARINVOICEPRINTTEMPLATEID></ARINVOICEPRINTTEMPLATEID>
                    <OEQUOTEPRINTTEMPLATEID></OEQUOTEPRINTTEMPLATEID>
                    <OEORDERPRINTTEMPLATEID></OEORDERPRINTTEMPLATEID>
                    <OELISTPRINTTEMPLATEID></OELISTPRINTTEMPLATEID>
                    <OEINVOICEPRINTTEMPLATEID></OEINVOICEPRINTTEMPLATEID>
                    <OEADJPRINTTEMPLATEID></OEADJPRINTTEMPLATEID>
                    <OEOTHERPRINTTEMPLATEID></OEOTHERPRINTTEMPLATEID>
                    <CONTACTINFO>
                        <CONTACTNAME></CONTACTNAME>
                    </CONTACTINFO>
                    <BILLTO>
                        <CONTACTNAME></CONTACTNAME>
                    </BILLTO>
                    <SHIPTO>
                        <CONTACTNAME></CONTACTNAME>
                    </SHIPTO>
                    <OBJECTRESTRICTION></OBJECTRESTRICTION>
                    <RESTRICTEDLOCATIONS></RESTRICTEDLOCATIONS>
                    <RESTRICTEDDEPARTMENTS></RESTRICTEDDEPARTMENTS>
                    <CUSTOMFIELD1></CUSTOMFIELD1>
                </CUSTOMER>
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