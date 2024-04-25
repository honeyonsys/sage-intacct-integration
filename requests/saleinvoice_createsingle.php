<?php

require '../configure.php';

// request doc: https://developer.intacct.com/api/accounts-receivable/invoices/#create-invoice-legacy
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
      <senderid>{{sender_id}}</senderid>
      <password>{{sender_password}}</password>
      <controlid>{{$timestamp}}</controlid>
      <uniqueid>false</uniqueid>
      <dtdversion>3.0</dtdversion>
      <includewhitespace>false</includewhitespace>
    </control>
    <operation>
      <authentication>
        <sessionid>{{session_id}}</sessionid>
      </authentication>
      <content>
        <function controlid="123456">
          <create_invoice>
            <customerid>DWL-CUS00020</customerid>
            <datecreated>
              <year>2018</year>
              <month>03</month>
              <day>31</day>
            </datecreated>
            <dateposted>
              <year>2018</year>
              <month>05</month>
              <day>31</day>
            </dateposted>
            <datedue>
              <year>2018</year>
              <month>04</month>
              <day>30</day>
            </datedue>
            <termname></termname>
            <batchkey></batchkey>
            <action>Submit</action>
            <invoiceno>A-1</invoiceno>
            <ponumber>OB-1</ponumber>
            <description>Opening Balance</description>
            <externalid></externalid>
            <billto>
              <contactname></contactname>
            </billto>
            <shipto>
              <contactname></contactname>
            </shipto>
            <basecurr>USD</basecurr>
            <currency>USD</currency>
            <exchratedate>
              <year>2018</year>
              <month>03</month>
              <day>31</day>
            </exchratedate>
            <exchratetype>Intacct Daily Rate</exchratetype>
            <nogl>false</nogl>
            <supdocid></supdocid>
            <customfields>
              <customfield>
                <customfieldname></customfieldname>
                <customfieldvalue></customfieldvalue>
              </customfield>
            </customfields>
            <invoiceitems>
              <lineitem>
                <glaccountno>16110</glaccountno>
                <offsetglaccountno></offsetglaccountno>
                <amount>937.68</amount>
                <memo></memo>
                <locationid>Big Corporate</locationid>
                <departmentid></departmentid>
                <key></key>
                <totalpaid>937.68</totalpaid>
                <totaldue>0</totaldue>
                <customfields>
                  <customfield>
                    <customfieldname></customfieldname>
                    <customfieldvalue></customfieldvalue>
                  </customfield>
                </customfields>
                <revrectemplate></revrectemplate>
                <defrevaccount></defrevaccount>
                <revrecstartdate>
                  <year></year>
                  <month></month>
                  <day></day>
                </revrecstartdate>
                <revrecenddate>
                  <year></year>
                  <month></month>
                  <day></day>
                </revrecenddate>
                <projectid></projectid>
                <customerid>DWL-CUS00020</customerid>
                <vendorid></vendorid>
                <employeeid></employeeid>
                <itemid></itemid>
                <classid></classid>
                <warehouseid></warehouseid>
              </lineitem>
            </invoiceitems>
          </create_invoice>
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




