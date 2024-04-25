<?php
ini_set('memory_limit', '8G');
require '../configure.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// request doc: https://developer.intacct.com/api/accounts-receivable/invoices/#create-invoice-legacy

$spreadsheet = IOFactory::load('../datasheets/DWL-SI-2018.xlsx'); 
$worksheet = $spreadsheet->getActiveSheet();
$control_id = rand(1, 10);
$isFirstRow = 0;
foreach ($worksheet->getRowIterator() as $row) {
    sleep(2);
    $isFirstRow = $isFirstRow + 1;
    echo "Processing Row: $isFirstRow\n";
    if ($isFirstRow <= 2) { // Skip the first row
        echo "Skipping first row\n";
        continue;
    }
    $cellIterator = $row->getCellIterator();

    $customerid = "";
    $datecreated_year = "";
    $datecreated_month = "";
    $datecreated_day = "";
    $dateposted_year = "";
    $dateposted_month = "";
    $dateposted_day = "";
    $datedue_year = "";
    $datedue_month = "";
    $datedue_day = "";
    $invoiceno = "";
    $ponumber = "";
    $header_description = "";
    $exchratedate_year = "";
    $exchratedate_month = "";
    $exchratedate_day = "";
    $exchratetype = "Intacct Daily Rate";
    $lineitem_description = "";
    $lineitem_glaccountno = "";
    $lineitem_amount = "";
    $lineitem_locationid = "Big Corporate"; //change this for different entity. 
    $lineitem_totalpaid = "";
    $lineitem_totaldue = "";
    $lineitem_customerid = "";

    foreach ($cellIterator as $cell) {
        $columnLetter = $cell->getColumn(); // Get Excel column name
        $value = $cell->getValue();
        switch ($columnLetter) {
            case 'A':
                $invoiceno = $value;
                break;
            case 'D':
                $lineitem_customerid = $value;
                $customerid = $value;
                break;
            case 'F':
                $lineitem_glaccountno = $value;
                break;
            case 'J':
                $header_description = "";
                $lineitem_description = $value;
                break;
            case 'K':
                $datecreated = $value;
                $dateParts = explode('/', $datecreated);
                list($day, $month, $year) = $dateParts;
                $datecreated_day = $day;
                $datecreated_month = $month;
                $datecreated_year = $year;
                break;
            case 'L':
                $dateposted = $value;
                $dateParts = explode('/', $dateposted);
                list($day, $month, $year) = $dateParts;
                $dateposted_day = $day;
                $dateposted_month = $month;
                $dateposted_year = $year;
                break;
            case 'M':
                $datedue = $value;
                $dateParts = explode('/', $datedue);
                list($day, $month, $year) = $dateParts;
                $datedue_day = $day;
                $datedue_month = $month;
                $datedue_year = $year;
                break;
            case 'N':
                $ponumber = $value.'-'.$invoiceno;
                break;
            case 'R':
                $lineitem_amount = $value;
                break;
            case 'V':
                $lineitem_totalpaid = $value;
                break;
            
            
        }
        $lineitem_totaldue = strval(floatval($lineitem_amount) - floatval($lineitem_totalpaid));
    }
    if($customerid != "" && $invoiceno != "") {
        if($customerid == '=#N/A') {
            continue; //skipping the invoice row where the customer id is not finalized
        }
        if (strpos($header_description, "Deleted") !== false) {
            continue; //skipping the invoice if the transaction is deleted previously in sage 50
         }
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
                        <create_invoice>
                        <customerid>'.$customerid.'</customerid>
                        <datecreated>
                            <year>'.$datecreated_year.'</year>
                            <month>'.$datecreated_month.'</month>
                            <day>'.$datecreated_day.'</day>
                        </datecreated>
                        <dateposted>
                            <year>'.$dateposted_year.'</year>
                            <month>'.$dateposted_month.'</month>
                            <day>'.$dateposted_day.'</day>
                        </dateposted>
                        <datedue>
                            <year>'.$datedue_year.'</year>
                            <month>'.$datedue_month.'</month>
                            <day>'.$datedue_day.'</day>
                        </datedue>
                        <termname></termname>
                        <batchkey></batchkey>
                        <action>Submit</action>
                        <invoiceno>'.$invoiceno.'</invoiceno>
                        <ponumber>'.$ponumber.'</ponumber>
                        <description>'.$header_description.'</description>
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
                            <year>'.$datecreated_year.'</year>
                            <month>'.$datecreated_month.'</month>
                            <day>'.$datecreated_day.'</day>
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
                                <glaccountno>'.$lineitem_glaccountno.'</glaccountno>
                                <offsetglaccountno></offsetglaccountno>
                                <amount>'.$lineitem_amount.'</amount>
                                <memo></memo>
                                <locationid>'.$lineitem_locationid.'</locationid>
                                <departmentid></departmentid>
                                <key></key>
                                <totalpaid>'.$lineitem_totalpaid.'</totalpaid>
                                <totaldue>'.$lineitem_totaldue.'</totaldue>
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
                                <customerid>'.$lineitem_customerid.'</customerid>
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
        customLogger('Response for invoice #'.$invoiceno.' : '. $response);
        responseHandler($response);
        
    }//condition to check if coa code and coa name is empty
    echo "\n\n\n";
} // main foreach ends here
/*

*/