<?php
ini_set('memory_limit', '8G');
require '../configure.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// request doc: https://developer.intacct.com/api/general-ledger/journal-entries/#create-journal-entry

$spreadsheet = IOFactory::load('../datasheets/DWL-JD-and-JC-TRANSACTIONS-8067-AT-DEC-2023.xlsx'); 
$worksheet = $spreadsheet->getActiveSheet();
$control_id = rand(1, 10);
$isFirstRow = 0;
$rowSeries = 0; //with this we will check that if the number is even then only the request will submit along with jd and jc append
$entriesLine = "";
foreach ($worksheet->getRowIterator() as $row) {
    sleep(2);
    $isFirstRow = $isFirstRow + 1;
    echo "Processing Row: $isFirstRow\n";
    if ($isFirstRow <= 2) { // Skip the first row
        echo "Skipping first row\n";
        continue;
    }
    $rowSeries = $rowSeries + 1;
    echo $rowSeries;
    if($rowSeries % 2 === 0) {
        echo " is Even";
    } else {
        echo " is Odd";
    }
    $cellIterator = $row->getCellIterator();
    
    
    $JOURNAL = "HJ";
    $BATCHDATE = "";
    $REVERSEDATE = "";
    $BATCHTITLE = "";
    $ACCOUNTNO = "";
    $DEPARTMENT = "";
    $LOCATION = "Big Corporate";
    $CURRENCY = "GBP";
    $TRTYPE = "";
    $AMOUNT = "";
    $EXCHRATETYPEID = "";
    $EXCHANGERATE = "1";
    $DESCRIPTION = "";
    
    foreach ($cellIterator as $cell) {
        $columnLetter = $cell->getColumn(); // Get Excel column name
        $value = $cell->getValue();
        switch ($columnLetter) {
            case 'B':
                $TRTYPE = $value;
                break;
            case 'F':
                $ACCOUNTNO = $value;
                break;
            case 'G':
                $DEPARTMENT = $value;
                break;
            case 'I':
                $DESCRIPTION = $value;
                break;
            case 'J':
                $date = DateTime::createFromFormat('d/m/Y', $value);
                $BATCHDATE = $date->format('m/d/Y');
                break;
            case 'K':
                $date = DateTime::createFromFormat('d/m/Y', $value);
                $REVERSEDATE = $date->format('m/d/Y');
                break;
            case 'M':
                $BATCHTITLE = $value;
                break;
            case 'O':
                $EXCHANGERATE = $value;
                break;
            case 'Q':
                $AMOUNT = $value;
                break;
        }
        
    }
    
    
    $entriesLine .= '<GLENTRY>
                        <ACCOUNTNO>'.$ACCOUNTNO.'</ACCOUNTNO>
                        <DEPARTMENT>'.$DEPARTMENT.'</DEPARTMENT>
                        <LOCATION>'.$LOCATION.'</LOCATION>
                        <CURRENCY>'.$CURRENCY.'</CURRENCY>
                        <TR_TYPE>'. ($TRTYPE == "JC" ? "1" : "-1") .'</TR_TYPE>
                        <AMOUNT>'.$AMOUNT.'</AMOUNT>
                        <EXCH_RATE_TYPE_ID></EXCH_RATE_TYPE_ID>
                        <EXCHANGE_RATE>'.$EXCHANGERATE.'</EXCHANGE_RATE>
                        <DESCRIPTION><![CDATA['.$DESCRIPTION.']]></DESCRIPTION>
                    </GLENTRY>';

    // if($rowSeries % 2 === 0) {
    //     echo $entriesLine;
    //     $entriesLine = "";   
    // }
    
    if($ACCOUNTNO != "" && $DEPARTMENT != "" && $AMOUNT != "") {
        if($rowSeries % 2 === 0) {
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
                            <GLBATCH>
                                <JOURNAL>'.$JOURNAL.'</JOURNAL>
                                <BATCH_DATE>'.$BATCHDATE.'</BATCH_DATE>
                                <REVERSEDATE>'.$REVERSEDATE.'</REVERSEDATE>
                                <BATCH_TITLE>'.$BATCHTITLE.' - '.$BATCHDATE.'</BATCH_TITLE>
                                <ENTRIES>'.$entriesLine.'</ENTRIES>
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
            customLogger('Response for journal # : '. $response);
            responseHandler($response);
            $entriesLine = "";
        } // even check condition ends here
    }//condition to check if coa code and coa name is empty
    
    echo "\n\n\n";
} // main foreach ends here
/*

*/