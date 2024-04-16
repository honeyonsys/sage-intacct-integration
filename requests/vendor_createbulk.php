<?php
ini_set('memory_limit', '8G');
require '../configure.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// request doc: https://developer.intacct.com/api/accounts-receivable/customers/#create-customer

$spreadsheet = IOFactory::load('../datasheets/Vendors-all-columns.xlsx'); 
$worksheet = $spreadsheet->getActiveSheet();

$isFirstRow = 0;
foreach ($worksheet->getRowIterator() as $row) {
    sleep(2);
    $isFirstRow = $isFirstRow + 1;
    echo "Processing Row: $isFirstRow\n";
    if ($isFirstRow <= 1) { // Skip the first row
        echo "Skipping first row\n";
        continue;
    }
    $cellIterator = $row->getCellIterator();

    $VENDORID = "";
    $NAME = "";
    $DISPLAYCONTACT = "";
    $STATUS = "";
    $ONETIME = "false";
    $HIDEDISPLAYCONTACT = "false";
    $VENDTYPE = "";
    $PARENTID = "";
    $GLGROUP = "";
    $TERRITORYID = "";
    $SUPDOCID = "";
    $TERMNAME = "";
    $OFFSETGLACCOUNTNO = "";
    $APACCOUNT = "";
    $SHIPPINGMETHOD = "";
    $RESALENO = "";
    $TAXID = "";
    $CREDITLIMIT = "";
    $RETAINAGEPERCENTAGE = "";
    $ONHOLD = "false";
    $DELIVERY_OPTIONS = "";
    $CUSTMESSAGEID = "";
    $EMAILOPTIN = "";
    $COMMENTS = "";
    $CURRENCY = "";
    $ADVBILLBY = "";
    $ADVBILLBYTYPE = "";
    //$ARINVOICEPRINTTEMPLATEID = "";
    //$OEQUOTEPRINTTEMPLATEID = "";
    //$OEORDERPRINTTEMPLATEID = "";
    //$OELISTPRINTTEMPLATEID = "";
    //$OEINVOICEPRINTTEMPLATEID = "";
    //$OEADJPRINTTEMPLATEID = "";
    //$OEOTHERPRINTTEMPLATEID = "";
    $BILLTO = "";
    $SHIPTO = "";
    $CONTACT_LIST_INFO = "";
    $CUSTOMERCONTACTS = "";
    $OBJECTRESTRICTION = "";
    $RESTRICTEDLOCATIONS = "";
    $RESTRICTEDDEPARTMENTS = "";
    $CUSTOMEREMAILTEMPLATES = "";

    $DISPLAYCONTACT_PRINTAS = "";
    //$DISPLAYCONTACT_CONTACTNAME = "";
    $DISPLAYCONTACT_COMPANYNAME = "";
    $DISPLAYCONTACT_TAXABLE = "true";
    $DISPLAYCONTACT_TAXGROUP = "";
    $DISPLAYCONTACT_PREFIX = "";
    $DISPLAYCONTACT_FIRSTNAME = "";
    $DISPLAYCONTACT_LASTNAME = "";
    $DISPLAYCONTACT_INITIAL = "";
    
    $DISPLAYCONTACT_PHONE1 = "";
    $DISPLAYCONTACT_PHONE2 = "";
    $DISPLAYCONTACT_CELLPHONE = "";
    $DISPLAYCONTACT_PAGER = "";
    $DISPLAYCONTACT_FAX = "";
    $DISPLAYCONTACT_EMAIL1 = "";
    $DISPLAYCONTACT_EMAIL2 = "";
    $DISPLAYCONTACT_URL1 = "";
    $DISPLAYCONTACT_URL2 = "";

    $DISPLAYCONTACT_MAILADDRESS_ADDRESS1 = "";
    $DISPLAYCONTACT_MAILADDRESS_ADDRESS2 = "";
    $DISPLAYCONTACT_MAILADDRESS_CITY = "";
    $DISPLAYCONTACT_MAILADDRESS_STATE = "";
    $DISPLAYCONTACT_MAILADDRESS_ZIP = "";
    $DISPLAYCONTACT_MAILADDRESS_COUNTRY = "";
    //$DISPLAYCONTACT_MAILADDRESS_ISOCOUNTRYCODE = "";

    $CONTACTINFO_CONTACTNAME = "";

    $PAYTO_CONTACTNAME = "";

    $RETURNTO_CONTACTNAME = "";

    $PAYMETHODKEY = "";
    $MERGEPAYMENTREQ = "";
    $PAYMENTNOTIFY = "";
    $BILLINGTYPE = "";
    $PAYMENTPRIORITY = "";
    
    $DISPLAYTERMDISCOUNT = "";
    $ACHENABLED = "";
    $ACHBANKROUTINGNUMBER = "";
    $ACHACCOUNTNUMBER = "";
    $ACHACCOUNTTYPE = "";
    $ACHREMITTANCETYPE = "";
    $VENDORACCOUNTNO = "";
    $DISPLAYACCTNOCHECK = "";
    $OBJECTRESTRICTION = "";
    $RESTRICTEDLOCATIONS = "";
    $RESTRICTEDDEPARTMENTS = "";

    foreach ($cellIterator as $cell) {
        $columnLetter = $cell->getColumn(); // Get Excel column name
        $value = $cell->getValue();
        switch ($columnLetter) {
            case 'A':
                $VENDORID = $value;
                break;
            case 'B':
                $NAME = $value;
                break;
            case 'D':
                $STATUS = $value;
                break;
            case 'F':
                $TERMNAME = $value;
                break;
            case 'G':
                $RESALENO = $value;
                break;
            case 'H':
                $APACCOUNT = $value;
                break;
            case 'J':
                $TAXID = $value;
                break;
            case 'Q':
                $PAYMENTPRIORITY = $value;
                break;
            case 'R':
                $BILLINGTYPE = $value;
                break;
            case 'S':
                $VENDTYPE = $value;
                break;
            case 'T':
                $GLGROUP = $value;
                break;
            case 'U':
                $PARENTID = $value;
                break;
            case 'Z':
                $DISPLAYTERMDISCOUNT = $value;
                break;
            case 'AA':
                $ONETIME = $value;
                break;
            case 'AB':
                $ONHOLD = $value;
                break;
            case 'AX':
                $PAYMETHODKEY = $value;
                break;
            case 'AY':
                $PAYMENTNOTIFY = $value;
                break;
            case 'CH':
                $DISPLAYCONTACT_PHONE1 = $value;
                break;
            case 'CL':
                $DISPLAYCONTACT_EMAIL1 = $value;
                break;
            case 'CN':
                $DISPLAYCONTACT_FIRSTNAME = $value;
                break;
            case 'CO':
                $DISPLAYCONTACT_LASTNAME = $value;
                break;
            case 'CQ':
                $DISPLAYCONTACT_PRINTAS = $value;
                break;
            case 'CR':
                $DISPLAYCONTACT_CONTACTNAME = $value;
                break;
            case 'CS':
                $DISPLAYCONTACT_COMPANYNAME = $value;
                break;
            case 'CU':
                $DISPLAYCONTACT_TAXABLE = $value;
                break;
            case 'CV':
                $DISPLAYCONTACT_TAXGROUP = $value;
                break;
            case 'CW':
                $TAXID = $value;
                break;
            case 'DB':
                $HIDEDISPLAYCONTACT = $value;
                break;
            case 'DC':
                $DISPLAYCONTACT_MAILADDRESS_ADDRESS1 = $value;
                break;
            case 'DD':
                $DISPLAYCONTACT_MAILADDRESS_ADDRESS2 = $value;
                break;
            case 'DF':
                $DISPLAYCONTACT_MAILADDRESS_CITY = $value;
                break;
            case 'DG':
                $DISPLAYCONTACT_MAILADDRESS_STATE = $value;
                break;
            case 'DH':
                $DISPLAYCONTACT_MAILADDRESS_ZIP = $value;
                break;
            case 'DI':
                $DISPLAYCONTACT_MAILADDRESS_COUNTRY = $value;
                break;
            case 'DP':
                $STATUS = $value;
                break;
            
        }
    }
    if($VENDORID != "" && $NAME != "") {
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
        CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="UTF-8"?>
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
                            <VENDOR>
                                <VENDORID>'.$VENDORID.'</VENDORID>
                                <NAME><![CDATA['.$NAME.']]></NAME>
                                <LSP VENDORID>'.$VENDORID.'</LSP VENDORID>
                                <DISPLAYCONTACT>
                                    <PRINTAS>'.$DISPLAYCONTACT_PRINTAS.'</PRINTAS>
                                    <COMPANYNAME><![CDATA['.$DISPLAYCONTACT_COMPANYNAME.']]></COMPANYNAME>
                                    <TAXABLE>'.$DISPLAYCONTACT_TAXABLE.'</TAXABLE>
                                    <TAXGROUP>'.$DISPLAYCONTACT_TAXGROUP.'</TAXGROUP>
                                    <PREFIX>'.$DISPLAYCONTACT_PREFIX.'</PREFIX>
                                    <FIRSTNAME>'.$DISPLAYCONTACT_FIRSTNAME.'</FIRSTNAME>
                                    <LASTNAME>'.$DISPLAYCONTACT_LASTNAME.'</LASTNAME>
                                    <INITIAL>'.$DISPLAYCONTACT_INITIAL.'</INITIAL>
                                    <PHONE1>'.$DISPLAYCONTACT_PHONE1.'</PHONE1>
                                    <PHONE2>'.$DISPLAYCONTACT_PHONE2.'</PHONE2>
                                    <CELLPHONE>'.$DISPLAYCONTACT_CELLPHONE.'</CELLPHONE>
                                    <PAGER>'.$DISPLAYCONTACT_PAGER.'</PAGER>
                                    <FAX>'.$DISPLAYCONTACT_FAX.'</FAX>
                                    <EMAIL1>'.$DISPLAYCONTACT_EMAIL1.'</EMAIL1>
                                    <EMAIL2>'.$DISPLAYCONTACT_EMAIL2.'</EMAIL2>
                                    <URL1>'.$DISPLAYCONTACT_URL1.'</URL1>
                                    <URL2>'.$DISPLAYCONTACT_URL2.'</URL2>
                                    <MAILADDRESS>
                                        <ADDRESS1>'.$DISPLAYCONTACT_MAILADDRESS_ADDRESS1.'</ADDRESS1>
                                        <ADDRESS2>'.$DISPLAYCONTACT_MAILADDRESS_ADDRESS2.'</ADDRESS2>
                                        <CITY>'.$DISPLAYCONTACT_MAILADDRESS_CITY.'</CITY>
                                        <STATE>'.$DISPLAYCONTACT_MAILADDRESS_STATE.'</STATE>
                                        <ZIP>'.$DISPLAYCONTACT_MAILADDRESS_ZIP.'</ZIP>
                                        <COUNTRY>'.$DISPLAYCONTACT_MAILADDRESS_COUNTRY.'</COUNTRY>
                                    </MAILADDRESS>
                                </DISPLAYCONTACT>
                                <ONETIME>'.$ONETIME.'</ONETIME>
                                <STATUS>'.$STATUS.'</STATUS>
                                <HIDEDISPLAYCONTACT>'.$HIDEDISPLAYCONTACT.'</HIDEDISPLAYCONTACT>
                                <VENDTYPE>'.$VENDTYPE.'</VENDTYPE>
                                <PARENTID>'.$PARENTID.'</PARENTID>
                                <GLGROUP>'.$GLGROUP.'</GLGROUP>
                                <SUPDOCID>'.$SUPDOCID.'</SUPDOCID>
                                
                                <APACCOUNT>'.$APACCOUNT.'</APACCOUNT>
                                <TAXID>'.$TAXID.'</TAXID>
                                <CREDITLIMIT>'.$CREDITLIMIT.'</CREDITLIMIT>
                                <ONHOLD>'.$ONHOLD.'</ONHOLD>
                                <COMMENTS>'.$COMMENTS.'</COMMENTS>
                                <CURRENCY>'.$CURRENCY.'</CURRENCY>
                                <CONTACTINFO>
                                    <CONTACTNAME><![CDATA['.$CONTACTINFO_CONTACTNAME.']]></CONTACTNAME>
                                </CONTACTINFO>
                                <PAYTO>
                                    <CONTACTNAME><![CDATA['.$CONTACTINFO_CONTACTNAME.']]></CONTACTNAME>
                                </PAYTO>
                                <RETURNTO>
                                    <CONTACTNAME><![CDATA['.$CONTACTINFO_CONTACTNAME.']]></CONTACTNAME>
                                </RETURNTO>
                                <PAYMETHODKEY>'.$PAYMETHODKEY.'</PAYMETHODKEY>
                                <MERGEPAYMENTREQ>true</MERGEPAYMENTREQ>
                                <PAYMENTNOTIFY>'.$PAYMENTNOTIFY.'</PAYMENTNOTIFY>
                                <BILLINGTYPE>'.$BILLINGTYPE.'</BILLINGTYPE>
                                <PAYMENTPRIORITY>'.$PAYMENTPRIORITY.'</PAYMENTPRIORITY>
                                <TERMNAME>'.$TERMNAME.'</TERMNAME>
                                <DISPLAYTERMDISCOUNT>false</DISPLAYTERMDISCOUNT>
                                <ACHENABLED>false</ACHENABLED>
                                <ACHBANKROUTINGNUMBER></ACHBANKROUTINGNUMBER>
                                <ACHACCOUNTNUMBER></ACHACCOUNTNUMBER>
                                <ACHACCOUNTTYPE></ACHACCOUNTTYPE>
                                <ACHREMITTANCETYPE></ACHREMITTANCETYPE>
                                <VENDORACCOUNTNO></VENDORACCOUNTNO>
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
        
    }//condition to check if coa code and coa name is empty
    echo "\n\n\n";
} // main foreach ends here
/*

*/