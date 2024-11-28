<?php

class Billings extends tableDataObject
{
    const TABLENAME = 'payments';
    
    public static function saveBillingOld(
                        $amountPaid,
                        $billDate,
                        $billType,
                        $paymentMethod,
                        $paymentStatus,
                        $paymentDescription,
                        $serialNumber,
                        $uuid,
                        $propertyid,
                        $clientid) {

        global $healthdb;

        if ($billType === 'Maintenance') {
            $lastOutstandingBillid = Tools::lastOutstandingBillid($clientid);
            if ($lastOutstandingBillid) {
                    
                $updateRent = "UPDATE `billing`
                SET `updatedAt` = NOW(),
                `paymentStatus` = 'success'
                WHERE `billid` = '$lastOutstandingBillid'";

                $healthdb->prepare($updateRent);
                $healthdb->execute();
            }
            else {
                echo 2;
                return;
            }
        }
            
        $getByUUID = "SELECT * FROM `payments` WHERE `uuid` = '$uuid'";
        $healthdb->prepare($getByUUID);
        $resultByUUID = $healthdb->singleRecord();

        if ($resultByUUID) {
            $query = "UPDATE `payments`
                    SET 
                    `amountPaid` = '$amountPaid',
                    `datePaid` = '$billDate',
                    `updatedAt` = NOW(),
                    `paymentMethod` = '$paymentMethod',
                    `billType` = '$billType',
                    `paymentDescription` = '$paymentDescription',
                    `serialNumber` = '$serialNumber',
                    `paymentStatus` = '$paymentStatus',
                    `propertyid` = '$propertyid',
                    `clientid` = '$clientid'

                    WHERE `uuid` = '$uuid'";

                $healthdb->prepare($query);
                $healthdb->execute();
        
            echo 3; // updated
        }
        else {
            $query = "INSERT INTO `payments`
                (`amountPaid`,
                `datePaid`,
                `createdAt`,
                `paymentMethod`,
                `billType`,
                `paymentDescription`,
                `serialNumber`,
                `paymentStatus`,
                `uuid`,
                `propertyid`,
                `clientid`,
                `receivedBy`
                )
                VALUES (
                '$amountPaid',
                '$billDate',
                NOW(),
                '$paymentMethod',
                '$billType',
                '$paymentDescription',
                '$serialNumber',
                '$paymentStatus',
                '$uuid',
                '$propertyid',
                '$clientid',
                'Admin'
                )";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully inserted

           
        
        }
    
    }


    public static function saveBilling($amountPaid,
                        $billDate,
                        $billType,
                        $paymentMethod,
                        $paymentStatus,
                        $paymentDescription,
                        $serialNumber,
                        $uuid,
                        $propertyid,
                        $clientid) {
        global $healthdb;
    
        // Handle maintenance bill updates
        if ($billType === 'Maintenance') {
            $lastOutstandingBillid = Tools::lastOutstandingBillid($clientid);
            if ($lastOutstandingBillid) {
                $updateRent = "UPDATE `billing` SET `updatedAt` = NOW(), `paymentStatus` = 'success' WHERE `billid` = '$lastOutstandingBillid'";
                if (!$healthdb->execute($updateRent)) {
                    echo "Failed to update maintenance bill.";
                    return;
                }
            } else {
                echo "No outstanding maintenance bill.";
                return;
            }
        }
    
        // Check if payment exists
        $getByUUID = "SELECT * FROM `payments` WHERE `uuid` = '$uuid'";
        $existingPayment = $healthdb->singleRecord($getByUUID);
    
        if ($existingPayment) {
            // Update payment
            $query = "UPDATE `payments` SET `amountPaid` = '$amountPaid', `datePaid` = '$billDate', `updatedAt` = NOW(), 
                      `paymentMethod` = '$paymentMethod', `billType` = '$billType', `paymentDescription` = '$paymentDescription', 
                      `serialNumber` = '$serialNumber', `paymentStatus` = '$paymentStatus', 
                      `propertyid` = '$propertyid', `clientid` = '$clientid' WHERE `uuid` = '$uuid'";
            $result = $healthdb->execute($query);
            echo $result ? "Payment updated successfully." : "Failed to update payment.";
        } else {
            // Insert payment
            $query = "INSERT INTO `payments` (`amountPaid`, `datePaid`, `createdAt`, `paymentMethod`, `billType`, `paymentDescription`, 
                      `serialNumber`, `paymentStatus`, `uuid`, `propertyid`, `clientid`, `receivedBy`) 
                      VALUES ('$amountPaid', '$billDate', NOW(), '$paymentMethod', '$billType', '$paymentDescription', 
                      '$serialNumber', '$paymentStatus', '$uuid', '$propertyid', '$clientid', 'Admin')";
            $result = $healthdb->execute($query);
            echo $result ? "Payment inserted successfully." : "Failed to insert payment.";
        }
    }
    

    public static function paymentHistory() {
        global $healthdb;

        $getList = "SELECT * FROM `payments` where `status` = 1 ORDER BY `createdAt` DESC, `updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function clientPaymentHistoy($clientid) {
        global $healthdb;

        $getList = "SELECT * FROM `payments` where `status` = 1 AND `clientid` = '$clientid' ORDER BY `createdAt` DESC, `updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function updatePayment($reference,$status,$clientid,$amount,$uuid,$rentid) {
        global $healthdb;

        $updatedAmt = $amount / 100;

        $query = "INSERT INTO `payments`
                    (`amountPaid`,
                    `datePaid`,
                    `createdAt`,
                    `billType`,
                    `paymentMethod`,
                    `paymentDescription`,
                    `serialNumber`,
                    `paymentStatus`,
                    `uuid`,
                    `clientid`,
                    `receivedBy`
                )
                VALUES (
                    '$updatedAmt',
                    NOW(),
                    NOW(),
                    'Rent',
                    'PayStack',
                    '$status',
                    '$reference',
                    '$status',
                    '$uuid',
                    '$clientid',
                    'Client Portal'
                )";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully inserted


                $updateRent = "UPDATE `rentinfo`
                        SET `updatedAt` = NOW(),
                        `paymentStatus` = '$status'
                        WHERE `rentid` = '$rentid'";

                    $healthdb->prepare($updateRent);
                    $healthdb->execute();
                    echo 1;  // Successfully updated

                       // Email details
                    $subject = "Rent Payment Successful";
                    $fullName = Tools::clientName($clientid);
                    $emailAddress = Tools::clientEmail($clientid);
                    $transactionID = 'RNT-' . uniqid();
                    $paymentDate = date('F j, Y');
                    $amountPaid = number_format($updatedAmt, 2); // Format amount with 2 decimal places

                    // Validate email address
                    if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                        echo "Invalid email address: $emailAddress\n";
                        return; // Exit if email is invalid
                    }

                    // Email message
                    $message = "
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Payment Receipt</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 0;
                                padding: 0;
                                background-color: #f9f9f9;
                                color: #333;
                            }
                            .container {
                                max-width: 600px;
                                margin: 20px auto;
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            .header {
                                text-align: center;
                                border-bottom: 2px solid #4CAF50;
                                margin-bottom: 20px;
                            }
                            .header h1 {
                                color: #4CAF50;
                                margin: 0;
                            }
                            .content {
                                line-height: 1.6;
                            }
                            .content p {
                                margin: 10px 0;
                            }
                            .footer {
                                text-align: center;
                                margin-top: 20px;
                                font-size: 0.9em;
                                color: #777;
                            }
                            .details-table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 20px;
                            }
                            .details-table th, .details-table td {
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: left;
                            }
                            .details-table th {
                                background-color: #f2f2f2;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h1>Payment Receipt</h1>
                                <p>Thank you for your payment!</p>
                            </div>
                            <div class='content'>
                                <p>Dear $fullName,</p>
                                <p>We are pleased to confirm the successful payment for your property rent. Below are the payment details:</p>
                                <table class='details-table'>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <td>$transactionID</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Payment</th>
                                        <td>$paymentDate</td>
                                    </tr>
                                    <tr>
                                        <th>Amount Paid</th>
                                        <td>$$amountPaid</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>Paystack</td>
                                    </tr>
                                </table>
                                <p>If you have any questions or need further assistance, please contact us at support@signumproperties.com or call +1 (123) 456-7890.</p>
                            </div>
                            <div class='footer'>
                                <p>&copy; 2024 Signum Properties. All rights reserved.</p>
                            </div>
                        </div>
                    </body>
                    </html>";

                    // Send email and handle potential errors
                    try {
                        if (SendEmail::compose($emailAddress, $subject, $message)) {
                            echo "Email sent successfully.\n";
                        } else {
                            echo "Failed to send email.\n";
                        }
                    } catch (Exception $e) {
                        echo "Error sending email: " . $e->getMessage() . "\n";
                    }

                                        

    }


    public static function updateMaintenancePayment($reference,$status,$clientid,$amount,$uuid,$billid) {
        global $healthdb;

        $updatedAmt = $amount / 100;

        $query = "INSERT INTO `payments`
                    (`amountPaid`,
                    `datePaid`,
                    `createdAt`,
                    `billType`,
                    `paymentMethod`,
                    `paymentDescription`,
                    `serialNumber`,
                    `paymentStatus`,
                    `uuid`,
                    `clientid`,
                    `receivedBy`
                )
                VALUES (
                    '$updatedAmt',
                    NOW(),
                    NOW(),
                    'Maintenance',
                    'PayStack',
                    '$status',
                    '$reference',
                    '$status',
                    '$uuid',
                    '$clientid',
                    'Client Portal'
                )";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully inserted


                $updateRent = "UPDATE `billing`
                        SET `updatedAt` = NOW(),
                        `paymentStatus` = '$status'
                        WHERE `billid` = '$billid'";

                    $healthdb->prepare($updateRent);
                    $healthdb->execute();
                    echo 1;  // Successfully updated

                       // Email details
                    $subject = "Maintenance Payment Successful";
                    $fullName = Tools::clientName($clientid);
                    $emailAddress = Tools::clientEmail($clientid);
                    $transactionID = 'RNT-' . uniqid();
                    $paymentDate = date('F j, Y');
                    $amountPaid = number_format($updatedAmt, 2); // Format amount with 2 decimal places

                    // Validate email address
                    if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                        echo "Invalid email address: $emailAddress\n";
                        return; // Exit if email is invalid
                    }

                    // Email message
                    $message = "
                    <div class='container'>
                            <div class='header'>
                                <h1>Payment Receipt</h1>
                                <p>Thank you for your payment!</p>
                            </div>
                            <div class='content'>
                                <p>Dear $fullName,</p>
                                <p>We are pleased to confirm the successful payment for your property rent. Below are the payment details:</p>
                                <table class='details-table'>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <td>$transactionID</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Payment</th>
                                        <td>$paymentDate</td>
                                    </tr>
                                    <tr>
                                        <th>Amount Paid</th>
                                        <td>$$amountPaid</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>Paystack</td>
                                    </tr>
                                </table>
                                <p>If you have any questions or need further assistance, please contact us at support@signumproperties.com or call +1 (123) 456-7890.</p>
                            </div>
                            <div class='footer'>
                                <p>&copy; 2024 Signum Properties. All rights reserved.</p>
                            </div>
                        </div>";

                    // Send email and handle potential errors
                    try {
                        if (SendEmail::compose($emailAddress, $subject, $message)) {
                            echo "Email sent successfully.\n";
                        } else {
                            echo "Failed to send email.\n";
                        }
                    } catch (Exception $e) {
                        echo "Error sending email: " . $e->getMessage() . "\n";
                    }

                                        

    }
    

    public static function paymentDetails($paymentid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `payments` WHERE `payid` = '$paymentid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'amountPaid' => $resultRec->amountPaid,
            'datePaid' => $resultRec->datePaid,
            'paymentMethod' => $resultRec->paymentMethod,
            'billType' => $resultRec->billType,
            'paymentDescription' => $resultRec->paymentDescription,
            'serialNumber' => $resultRec->serialNumber,
            'paymentStatus' => $resultRec->paymentStatus,
            'propertyid' => $resultRec->propertyid,
            'clientid' => $resultRec->clientid,
            'receivedBy' => $resultRec->receivedBy,
            'createdAt' => $resultRec->createdAt

        ];
    }

}