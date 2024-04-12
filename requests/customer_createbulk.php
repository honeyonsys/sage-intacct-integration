<?php
ini_set('memory_limit', '8G');
require '../configure.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// request doc: https://developer.intacct.com/api/accounts-receivable/customers/#create-customer

$spreadsheet = IOFactory::load('../datasheets/Customers-all-columns2.xlsx'); 
$worksheet = $spreadsheet->getActiveSheet();

$isFirstRow = 0;
foreach ($worksheet->getRowIterator() as $row) {
    sleep(5);
    $isFirstRow = $isFirstRow + 1;
    echo "Processing Row: $isFirstRow\n";
    if ($isFirstRow <= 1) { // Skip the first row
        echo "Skipping first row\n";
        continue;
    }
    $cellIterator = $row->getCellIterator();

    $CUSTOMERID = "";
    $NAME = "";
    $DISPLAYCONTACT = "";
    $STATUS = "";
    $ONETIME = "false";
    $HIDEDISPLAYCONTACT = "false";
    $CUSTTYPE = "";
    $CUSTREPID = "";
    $PARENTID = "";
    $GLGROUP = "";
    $TERRITORYID = "";
    $SUPDOCID = "";
    $TERMNAME = "";
    $OFFSETGLACCOUNTNO = "";
    $ARACCOUNT = "";
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
    $ARINVOICEPRINTTEMPLATEID = "";
    $OEQUOTEPRINTTEMPLATEID = "";
    $OEORDERPRINTTEMPLATEID = "";
    $OELISTPRINTTEMPLATEID = "";
    $OEINVOICEPRINTTEMPLATEID = "";
    $OEADJPRINTTEMPLATEID = "";
    $OEOTHERPRINTTEMPLATEID = "";
    $BILLTO = "";
    $SHIPTO = "";
    $CONTACT_LIST_INFO = "";
    $CUSTOMERCONTACTS = "";
    $OBJECTRESTRICTION = "";
    $RESTRICTEDLOCATIONS = "";
    $RESTRICTEDDEPARTMENTS = "";
    $CUSTOMEREMAILTEMPLATES = "";

    $DISPLAYCONTACT_PRINTAS = "";
    $DISPLAYCONTACT_CONTACTNAME = "";
    $DISPLAYCONTACT_COMPANYNAME = "";
    $DISPLAYCONTACT_TAXABLE = "true";
    $DISPLAYCONTACT_TAXGROUP = "";
    $DISPLAYCONTACT_PREFIX = "";
    $DISPLAYCONTACT_FIRSTNAME = "";
    $DISPLAYCONTACT_LASTNAME = "";
    $DISPLAYCONTACT_INITIAL = "";
    $DISPLAYCONTACT_TAXSCHEDULE = "";
    $DISPLAYCONTACT_TAXSOLUTIONID = "";
    $DISPLAYCONTACT_Optional = "";
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
    $DISPLAYCONTACT_MAILADDRESS_ADDRESS3 = "";
    $DISPLAYCONTACT_MAILADDRESS_CITY = "";
    $DISPLAYCONTACT_MAILADDRESS_STATE = "";
    $DISPLAYCONTACT_MAILADDRESS_ZIP = "";
    $DISPLAYCONTACT_MAILADDRESS_COUNTRY = "";
    $DISPLAYCONTACT_MAILADDRESS_ISOCOUNTRYCODE = "";

    $CONTACTINFO_CONTACTNAME = "";

    $BILLTO_CONTACTNAME = "";

    $SHIPTO_CONTACTNAME = "";

    $CONTACT_LIST_INFO_CATEGORYNAME = "";
    $CONTACT_LIST_INFO_CONTACT = "";

    $CUSTOMERENTITYCONTACTS_CATEGORYNAME = "";
    $CUSTOMERENTITYCONTACTS_CONTACT = "";

    $CONTACT_NAME = "";
    $CUSTOMEREMAILTEMPLATE_DOCPARID = "";
    $CUSTOMEREMAILTEMPLATE_EMAILTEMPLATENAME = "";

    foreach ($cellIterator as $cell) {
        $columnLetter = $cell->getColumn(); // Get Excel column name
        $value = $cell->getValue();
        switch ($columnLetter) {
            case 'A':
                $CUSTOMERID = $value;
                break;
            case 'B':
                $NAME = $value;
                break;
            case 'C':
                $STATUS = $value;
                break;
            // case 'D':
            //     $V = $value;
            //     break;
            // case 'E':
            //     $V = $value;
            //     break;
            // case 'F':
            //     $V = $value;
            //     break;
            case 'G':
                $RESALENO = $value;
                break;
            case 'H':
                $TAXID = $value;
                break;
            case 'I':
                $CREDITLIMIT = $value;
                break;
            // case 'J':
            //     $V = $value;
            //     break;
            case 'K':
                $COMMENTS = $value;
                break;
            case 'L':
                $CURRENCY = $value;
                break;
            case 'M':
                $SHIPPINGMETHOD = $value;
                break;
            case 'N':
                $CUSTTYPE = $value;
                break;
            case 'O':
                $GLGROUP = $value;
                break;
            case 'P':
                $TERRITORYID = $value;
                break;
            // case 'Q':
            //     $V = $value;
            //     break;
            // case 'R':
            //     $V = $value;
            //     break;
            case 'S':
                $DELIVERY_OPTIONS = $value;
                break;
            case 'T':
                $PARENTID = $value;
                break;
            // case 'U':
            //     $V = $value;
            //     break;
            // case 'V':
            //     $V = $value;
            //     break;
            // case 'W':
            //     $V = $value;
            //     break;
            // case 'X':
            //     $V = $value;
            //     break;
            // case 'Y':
            //     $V = $value;
            //     break;
            // case 'Z':
            //     $V = $value;
            //     break;
            // case 'AA':
            //     $V = $value;
            //     break;
            case 'AB':
                $CUSTMESSAGEID = $value;
                break;
            case 'AC':
                $ONHOLD = $value;
                break;
            // case 'AD':
            //     $V = $value;
            //     break;
            // case 'AE':
            //     $V = $value;
            //     break;
            // case 'AF':
            //     $V = $value;
            //     break;
            // case 'AG':
            //     $V = $value;
            //     break;
            // case 'AH':
            //     $V = $value;
            //     break;
            // case 'AI':
            //     $V = $value;
            //     break;
            // case 'AJ':
            //     $V = $value;
            //     break;
            // case 'AK':
            //     $V = $value;
            //     break;
            // case 'AL':
            //     $V = $value;
            //     break;
            case 'AM':
                $ARINVOICEPRINTTEMPLATEID = $value;
                break;
            case 'AN':
                $OEQUOTEPRINTTEMPLATEID = $value;
                break;
            case 'AO':
                $OEORDERPRINTTEMPLATEID = $value;
                break;
            case 'AP':
                $OELISTPRINTTEMPLATEID = $value;
                break;
            case 'AQ':
                $OEINVOICEPRINTTEMPLATEID = $value;
                break;
            case 'AR':
                $OEADJPRINTTEMPLATEID = $value;
                break;
            case 'AS':
                $OEOTHERPRINTTEMPLATEID = $value;
                break;
            // case 'AT':
            //     $V = $value;
            //     break;
            // case 'AU':
            //     $V = $value;
            //     break;
            // case 'AV':
            //     $V = $value;
            //     break;
            // case 'AW':
            //     $V = $value;
            //     break;
            // case 'AX':
            //     $V = $value;
            //     break;
            // case 'AY':
            //     $V = $value;
            //     break;
            // case 'AZ':
            //     $V = $value;
            //     break;
            // case 'BA':
            //     $V = $value;
            //     break;
            // case 'BB':
            //     $V = $value;
            //     break;
            // case 'BC':
            //     $V = $value;
            //     break;
            // case 'BD':
            //     $V = $value;
            //     break;
            // case 'BE':
            //     $V = $value;
            //     break;
            // case 'BF':
            //     $V = $value;
            //     break;
            // case 'BG':
            //     $V = $value;
            //     break;
            // case 'BH':
            //     $V = $value;
            //     break;
            // case 'BI':
            //     $V = $value;
            //     break;
            // case 'BJ':
            //     $V = $value;
            //     break;
            // case 'BK':
            //     $V = $value;
            //     break;
            // case 'BL':
            //     $V = $value;
            //     break;
            // case 'BM':
            //     $V = $value;
            //     break;
            case 'BN':
                $DISPLAYCONTACT_TAXABLE = $value;
                break;
            case 'BO':
                $DISPLAYCONTACT_TAXGROUP = $value;
                break;
            // case 'BP':
            //     $V = $value;
            //     break;
            // case 'BQ':
            //     $V = $value;
            //     break;
            // case 'BR':
            //     $V = $value;
            //     break;
            // case 'BS':
            //     $V = $value;
            //     break;
            // case 'BT':
            //     $V = $value;
            //     break;
            // case 'BU':
            //     $V = $value;
            //     break;
            // case 'BV':
            //     $V = $value;
            //     break;
            // case 'BW':
            //     $V = $value;
            //     break;
            // case 'BX':
            //     $V = $value;
            //     break;
            // case 'BY':
            //     $V = $value;
            //     break;
            // case 'BZ':
            //     $V = $value;
            //     break;
            // case 'CA':
            //     $V = $value;
            //     break;
            // case 'CB':
            //     $V = $value;
            //     break;
            // case 'CC':
            //     $V = $value;
            //     break;
            // case 'CD':
            //     $V = $value;
            //     break;
            // case 'CE':
            //     $V = $value;
            //     break;
            // case 'CF':
            //     $V = $value;
            //     break;
            // case 'CG':
            //     $V = $value;
            //     break;
            // case 'CH':
            //     $V = $value;
            //     break;
            // case 'CI':
            //     $V = $value;
            //     break;
            // case 'CJ':
            //     $V = $value;
            //     break;
            // case 'CK':
            //     $V = $value;
            //     break;
            // case 'CL':
            //     $V = $value;
            //     break;
            // case 'CM':
            //     $V = $value;
            //     break;
            // case 'CN':
            //     $V = $value;
            //     break;
            // case 'CO':
            //     $V = $value;
            //     break;
            case 'CP':
                $Status = $value;
                break;
            // case 'CQ':
            //     $V = $value;
            //     break;
            // case 'CR':
            //     $V = $value;
            //     break;
            // case 'CS':
            //     $V = $value;
            //     break;
            // case 'CT':
            //     $V = $value;
            //     break;
            // case 'CU':
            //     $V = $value;
            //     break;
            case 'CV':
                $BILLTO_CONTACTNAME = $value;
                break;
            // case 'CW':
            //     $V = $value;
            //     break;
            // case 'CX':
            //     $V = $value;
            //     break;
            // case 'CY':
            //     $V = $value;
            //     break;
            // case 'CZ':
            //     $V = $value;
            //     break;
            // case 'DA':
            //     $V = $value;
            //     break;
            // case 'DB':
            //     $V = $value;
            //     break;
            // case 'DC':
            //     $V = $value;
            //     break;
            // case 'DD':
            //     $V = $value;
            //     break;
            // case 'DE':
            //     $V = $value;
            //     break;
            // case 'DF':
            //     $V = $value;
            //     break;
            // case 'DG':
            //     $V = $value;
            //     break;
            // case 'DH':
            //     $V = $value;
            //     break;
            // case 'DI':
            //     $V = $value;
            //     break;
            // case 'DJ':
            //     $V = $value;
            //     break;
            // case 'DK':
            //     $V = $value;
            //     break;
            // case 'DL':
            //     $V = $value;
            //     break;
            // case 'DM':
            //     $V = $value;
            //     break;
            // case 'DN':
            //     $V = $value;
            //     break;
            // case 'DO':
            //     $V = $value;
            //     break;
            // case 'DP':
            //     $V = $value;
            //     break;
            // case 'DQ':
            //     $V = $value;
            //     break;
            // case 'DR':
            //     $V = $value;
            //     break;
            // case 'DS':
            //     $V = $value;
            //     break;
            // case 'DT':
            //     $V = $value;
            //     break;
            // case 'DU':
            //     $V = $value;
            //     break;
            // case 'DV':
            //     $V = $value;
            //     break;
            // case 'DW':
            //     $V = $value;
            //     break;
            // case 'DX':
            //     $V = $value;
            //     break;
            // case 'DY':
            //     $V = $value;
            //     break;
            // case 'DZ':
            //     $V = $value;
            //     break;
            // case 'EA':
            //     $SHIPTO_CONTACTNAME = $value;
            //     break;
            // case 'EB':
            //     $V = $value;
            //     break;
            // case 'EC':
            //     $V = $value;
            //     break;
            // case 'ED':
            //     $V = $value;
            //     break;
            // case 'EE':
            //     $V = $value;
            //     break;
            // case 'EF':
            //     $V = $value;
            //     break;
            // case 'EG':
            //     $V = $value;
            //     break;
            // case 'EH':
            //     $V = $value;
            //     break;
            // case 'EI':
            //     $V = $value;
            //     break;
            // case 'EJ':
            //     $V = $value;
            //     break;
            // case 'EK':
            //     $V = $value;
            //     break;
            // case 'EL':
            //     $V = $value;
            //     break;
            // case 'EM':
            //     $V = $value;
            //     break;
            // case 'EN':
            //     $V = $value;
            //     break;
            // case 'EO':
            //     $V = $value;
            //     break;
            // case 'EP':
            //     $V = $value;
            //     break;
            // case 'EQ':
            //     $V = $value;
            //     break;
            // case 'ER':
            //     $V = $value;
            //     break;
            // case 'ES':
            //     $V = $value;
            //     break;
            // case 'ET':
            //     $V = $value;
            //     break;
            // case 'EU':
            //     $V = $value;
            //     break;
            // case 'EV':
            //     $V = $value;
            //     break;
            // case 'EW':
            //     $V = $value;
            //     break;
            // case 'EX':
            //     $V = $value;
            //     break;
            // case 'EY':
            //     $V = $value;
            //     break;
            // case 'EZ':
            //     $V = $value;
            //     break;
            // case 'FA':
            //     $V = $value;
            //     break;
            case 'FB':
                $DISPLAYCONTACT_COMPANYNAME = $value;
                break;
            case 'FC':
                $DISPLAYCONTACT_PREFIX = $value;
                break;
            case 'FD':
                $DISPLAYCONTACT_FIRSTNAME = $value;
                break;
            case 'FE':
                $DISPLAYCONTACT_LASTNAME = $value;
                break;
            // case 'FF':
            //     $V = $value;
            //     break;
            case 'FG':
                $DISPLAYCONTACT_PRINTAS = $value;
                break;
            case 'FH':
                $DISPLAYCONTACT_PHONE1 = $value;
                break;
            case 'FI':
                $DISPLAYCONTACT_PHONE2 = $value;
                break;
            // case 'FJ':
            //     $V = $value;
            //     break;
            case 'FK':
                $DISPLAYCONTACT_PAGER = $value;
                break;
            case 'FL':
                $DISPLAYCONTACT_FAX = $value;
                break;
            case 'FM':
                $DISPLAYCONTACT_EMAIL1 = $value;
                break;
            case 'FN':
                $DISPLAYCONTACT_EMAIL2 = $value;
                break;
            case 'FO':
                $DISPLAYCONTACT_URL1 = $value;
                break;
            case 'FP':
                $DISPLAYCONTACT_URL2 = $value;
                break;
            // case 'FQ':
            //     $V = $value;
            //     break;
            case 'FR':
                $DISPLAYCONTACT_MAILADDRESS_ADDRESS1 = $value;
                break;
            case 'FS':
                $DISPLAYCONTACT_MAILADDRESS_ADDRESS2 = $value;
                break;
            // case 'FT':
            //     $V = $value;
            //     break;
            case 'FU':
                $DISPLAYCONTACT_MAILADDRESS_CITY = $value;
                break;
            case 'FV':
                $DISPLAYCONTACT_MAILADDRESS_STATE = $value;
                break;
            case 'FW':
                $DISPLAYCONTACT_MAILADDRESS_ZIP = $value;
                break;
            case 'FX':
                $DISPLAYCONTACT_MAILADDRESS_COUNTRY = $value;
                break;
            // case 'FY':
            //     $V = $value;
            //     break;
            // case 'FZ':
            //     $V = $value;
            //     break;
        }
    }
    if($CUSTOMERID != "" && $NAME != "") {
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
                            <CUSTOMER>
                                <CUSTOMERID>'.$CUSTOMERID.'</CUSTOMERID>
                                <NAME><![CDATA['.$NAME.']]></NAME>
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
                                <CUSTTYPE>'.$CUSTTYPE.'</CUSTTYPE>
                                <PARENTID>'.$PARENTID.'</PARENTID>
                                <GLGROUP>'.$GLGROUP.'</GLGROUP>
                                <TERRITORYID>'.$TERRITORYID.'</TERRITORYID>
                                <SUPDOCID>'.$SUPDOCID.'</SUPDOCID>
                                <TERMNAME>'.$TERMNAME.'</TERMNAME>
                                <OFFSETGLACCOUNTNO>'.$OFFSETGLACCOUNTNO.'</OFFSETGLACCOUNTNO>
                                <ARACCOUNT>'.$ARACCOUNT.'</ARACCOUNT>
                                <SHIPPINGMETHOD>'.$SHIPPINGMETHOD.'</SHIPPINGMETHOD>
                                <RESALENO>'.$RESALENO.'</RESALENO>
                                <TAXID>'.$TAXID.'</TAXID>
                                <CREDITLIMIT>'.$CREDITLIMIT.'</CREDITLIMIT>
                                <ONHOLD>'.$ONHOLD.'</ONHOLD>
                                <DELIVERY_OPTIONS>'.$DELIVERY_OPTIONS.'</DELIVERY_OPTIONS>
                                <CUSTMESSAGEID>'.$CUSTMESSAGEID.'</CUSTMESSAGEID>
                                <COMMENTS>'.$COMMENTS.'</COMMENTS>
                                <CURRENCY>'.$CURRENCY.'</CURRENCY>
                                <ARINVOICEPRINTTEMPLATEID>'.$ARINVOICEPRINTTEMPLATEID.'</ARINVOICEPRINTTEMPLATEID>
                                <OEQUOTEPRINTTEMPLATEID>'.$OEQUOTEPRINTTEMPLATEID.'</OEQUOTEPRINTTEMPLATEID>
                                <OEORDERPRINTTEMPLATEID>'.$OEORDERPRINTTEMPLATEID.'</OEORDERPRINTTEMPLATEID>
                                <OELISTPRINTTEMPLATEID>'.$OELISTPRINTTEMPLATEID.'</OELISTPRINTTEMPLATEID>
                                <OEINVOICEPRINTTEMPLATEID>'.$OEINVOICEPRINTTEMPLATEID.'</OEINVOICEPRINTTEMPLATEID>
                                <OEADJPRINTTEMPLATEID>'.$OEADJPRINTTEMPLATEID.'</OEADJPRINTTEMPLATEID>
                                <OEOTHERPRINTTEMPLATEID>'.$OEOTHERPRINTTEMPLATEID.'</OEOTHERPRINTTEMPLATEID>
                                <CONTACTINFO>
                                    <CONTACTNAME><![CDATA['.$CONTACTINFO_CONTACTNAME.']]></CONTACTNAME>
                                </CONTACTINFO>
                                <BILLTO>
                                    <CONTACTNAME><![CDATA['.$BILLTO_CONTACTNAME.']]></CONTACTNAME>
                                </BILLTO>
                                <SHIPTO>
                                    <CONTACTNAME><![CDATA['.$SHIPTO_CONTACTNAME.']]></CONTACTNAME>
                                </SHIPTO>
                                <OBJECTRESTRICTION>'.$OBJECTRESTRICTION.'</OBJECTRESTRICTION>
                                <RESTRICTEDLOCATIONS>'.$RESTRICTEDLOCATIONS.'</RESTRICTEDLOCATIONS>
                                <RESTRICTEDDEPARTMENTS>'.$RESTRICTEDDEPARTMENTS.'</RESTRICTEDDEPARTMENTS>
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
        
    }//condition to check if coa code and coa name is empty
    echo "\n\n\n";
} // main foreach ends here
/*

*/