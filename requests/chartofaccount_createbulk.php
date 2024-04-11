<?php
require '../configure.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
// request doc: https://developer.intacct.com/api/general-ledger/accounts/#create-account

$spreadsheet = IOFactory::load('../datasheets/coa-migrate-edited-by-ajay.xlsx'); 
$worksheet = $spreadsheet->getActiveSheet();

$isFirstRow = 0;
foreach ($worksheet->getRowIterator() as $row) {
    sleep(5);
    $isFirstRow = $isFirstRow + 1;
    echo "Processing Row: $isFirstRow\n";
    if ($isFirstRow <= 2) { // Skip the first row
        echo "Skipping first row\n";
        continue;
    }
    $cellIterator = $row->getCellIterator();

    $bsOrIs = "BS";
    $coaCode = "";
    $coaName = "";

    foreach ($cellIterator as $cell) {
        $columnLetter = $cell->getColumn(); // Get Excel column name
        $value = $cell->getValue();
        switch ($columnLetter) {
            case 'A':
                $bsOrIs = $value;
                break;
            case 'C':
                $coaCode = $value;
                break;
            case 'F':
                $coaName = $value;
                break;
        }
    }
    if($bsOrIs != "" && $coaCode != "" && $coaName != "") {
        //echo $bsOrIs . "|" . $coaCode . "|" . $coaName . "<br>";
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
                            <GLACCOUNT>
                                <ACCOUNTNO>'.$coaCode.'</ACCOUNTNO>
                                <TITLE><![CDATA['.$coaName.']]></TITLE>
                                <NORMALBALANCE>'.($bsOrIs == "BS" ? "debit" : "credit").'</NORMALBALANCE>
                                <ACCOUNTTYPE>'.($bsOrIs == "BS" ? "balancesheet" : "incomestatement").'</ACCOUNTTYPE>
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
        
    }//condition to check if coa code and coa name is empty
    echo "\n\n\n";
} // main foreach ends here
/*

*/