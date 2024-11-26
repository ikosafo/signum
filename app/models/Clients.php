<?php

class Clients extends tableDataObject
{
    const TABLENAME = 'clients';
 
    public static function clientDetails($clientid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `clients` WHERE `clientid` = '$clientid' OR `uuid` = '$clientid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'clientType' => $resultRec->clientType,
            'ownershipType' => $resultRec->ownershipType,
            'fullName' => $resultRec->fullName,
            'emailAddress' => $resultRec->emailAddress,
            'phoneNumber' => $resultRec->phoneNumber,
            'altPhoneNumber' => $resultRec->altPhoneNumber,
            'residentialAddress' => $resultRec->residentialAddress,
            'nationality' => $resultRec->nationality,
            'birthDate' => $resultRec->birthDate,
            'gender' => $resultRec->gender,
            'maritalStatus' => $resultRec->maritalStatus,
            'occupation' => $resultRec->occupation,
            'employersName' => $resultRec->employersName,
            'employersPhone' => $resultRec->employersPhone,
            'emergencyName' => $resultRec->emergencyName,
            'emergencyPhone' => $resultRec->emergencyPhone,
            'uuid' => $resultRec->uuid,
            'propertyid' => $resultRec->propertyid,
            'contractType' => $resultRec->contractType,
            'clientid' => $resultRec->clientid

        ];
    }


    public static function deleteClient($clientid) {

        global $healthdb;
            $query = "UPDATE `clients` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `clientid` = '$clientid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully updated
       
    }

 
    public static function saveClientDetails(
                            $fullName,
                            $emailAddress,
                            $phoneNumber,
                            $altPhoneNumber,
                            $residentialAddress,
                            $nationality,
                            $birthDate,
                            $gender,
                            $maritalStatus,
                            $occupation,
                            $employerName,
                            $employerContact,
                            $emergencyName,
                            $emergencyContact,
                            $ownershipType,
                            $uuid,
                            $clientType,
                            $propertyId,
                            $contractType
                                    ) {

        global $healthdb;

        $chkuuid = "SELECT * from `clients` WHERE `uuid` = '$uuid'";
        $healthdb->prepare($chkuuid);
        $resultuuid = $healthdb->singleRecord();

        $chkEmail = "SELECT * FROM `clients` WHERE `emailAddress` = '$emailAddress' AND `uuid` != '$uuid'";
        $healthdb->prepare($chkEmail);
        $resultEmail = $healthdb->singleRecord();

        if ($resultEmail) {
            // Email already exists for a different UUID
            //echo "Email already exists for a different client";
            echo 2;
            return;
        }

        $chkUsername = "SELECT * FROM `compusers` WHERE `username` = '$emailAddress' AND `uuid` != '$uuid'";
        $healthdb->prepare($chkUsername);
        $resultUsername = $healthdb->singleRecord();

        if ($resultUsername) {
            //echo "Username or email already exists";
            echo 2;
            return;
        }

        if ($resultuuid) {

             // If UUID exists, update the existing record
            $query = "UPDATE `clients` 
            SET  `clientType` = '$clientType',
            `updatedAt` =   NOW(),
            `ownershipType` = '$ownershipType',
            `fullName` = '$fullName',
            `emailAddress` = '$emailAddress',
            `phoneNumber` = '$phoneNumber',
            `altPhoneNumber` = '$altPhoneNumber',
            `residentialAddress` = '$residentialAddress',
            `nationality` = '$nationality',
            `birthDate` = '$birthDate',
            `gender` = '$gender',
            `maritalStatus` = '$maritalStatus',
            `occupation` = '$occupation',
            `employersName` = '$employerName',
            `employersPhone` = '$employerContact',
            `emergencyName` = '$emergencyName',
            `emergencyPhone` = '$emergencyContact',
            `propertyid` = '$propertyId',
            `contractType` = '$contractType'

            WHERE `uuid` = '$uuid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully updated      

        }
        else {
            $query = "INSERT INTO `clients`
            (`clientType`,
             `uuid`,
             `createdAt`,
             `ownershipType`,
             `fullName`,
             `emailAddress`,
             `phoneNumber`,
             `altPhoneNumber`,
             `residentialAddress`,
             `nationality`,
             `birthDate`,
             `gender`,
             `maritalStatus`,
             `occupation`,
             `employersName`,
             `employersPhone`,
             `emergencyName`,
             `emergencyPhone`,
             `propertyid`,
             `contractType`
             )
            VALUES ('$clientType',
                    '$uuid',
                    NOW(),
                    '$ownershipType',
                    '$fullName',
                    '$emailAddress',
                    '$phoneNumber',
                    '$altPhoneNumber',
                    '$residentialAddress',
                    '$nationality',
                    '$birthDate',
                    '$gender',
                    '$maritalStatus',
                    '$occupation',
                    '$employerName',
                    '$employerContact',
                    '$emergencyName',
                    '$emergencyContact',
                    '$propertyId',
                    '$contractType'
                    )";

                    $healthdb->prepare($query);
                    $healthdb->execute();
                    echo 3;  // Successfully inserted

                    $subject = 'Welcome to Signum Properties - Account Created';

                    $password = Tools::generateRandomPassword();

                    $message = "Dear <span style='text-transform: uppercase'>$fullName</span>, 

                    <p>Welcome to <b>Signum Properties</b>! Your account has been successfully created.</p>
                    <p>You can log in to your portal at <a href='https://signumproperties.com'>https://signumproperties.com</a>.</p>
                    <p><b>Login Credentials:</b><br>
                    Username: <b>$emailAddress</b><br>
                    Password: <b>$password</b></p>

                    <p>Please keep these credentials secure. We recommend updating your password after your first login.</p>
                    <p>Thank you,<br>The Signum Properties Team</p>";

                    SendEmail::compose($emailAddress, $subject, $message);
                    $insertUser = "INSERT INTO `compusers` (`dateBirth`,`address`,`emailaddress`,`phoneNumber`,`altPhoneNumber`,`username`, `password`, `uuid`, `createdAt`,`accessLevel`) VALUES ('$birthDate','$residentialAddress','$emailAddress','$phoneNumber','$altPhoneNumber','$emailAddress', '" . md5($password) . "', '$uuid', NOW(), 'Client')";
                    $healthdb->prepare($insertUser);
                    $healthdb->execute();
  
        }

       

    }


    public static function updateProfileClient( $altPhoneNumber,
                                                $residentialAddress,
                                                $nationality,
                                                $birthDate,
                                                $gender,
                                                $maritalStatus,
                                                $occupation,
                                                $employerName,
                                                $employerContact,
                                                $emergencyName,
                                                $emergencyContact,
                                                $uuid) {

            global $healthdb;

            $chkuuid = "SELECT * from `clients` WHERE `uuid` = '$uuid'";
            $healthdb->prepare($chkuuid);
            $resultuuid = $healthdb->singleRecord();
    
            if ($resultuuid) {
    
                // If UUID exists, update the existing record
                $query = "UPDATE `clients` 
                SET  
                `updatedAt` =   NOW(),
                `altPhoneNumber` = :altPhoneNumber,
                `residentialAddress` = :residentialAddress,
                `nationality` = :nationality,
                `birthDate` = :birthDate,
                `gender` = :gender,
                `maritalStatus` = :maritalStatus,
                `occupation` = :occupation,
                `employersName` = :employerName,
                `employersPhone` = :employerContact,
                `emergencyName` = :emergencyName,
                `emergencyPhone` = :emergencyContact
    
                WHERE `uuid` = :uuid";
    
                $healthdb->prepare($query);
                $healthdb->bind(':altPhoneNumber', $altPhoneNumber);
                $healthdb->bind(':residentialAddress', $residentialAddress);
                $healthdb->bind(':nationality', $nationality);
                $healthdb->bind(':birthDate', $birthDate);
                $healthdb->bind(':gender', $gender);
                $healthdb->bind(':maritalStatus', $maritalStatus);
                $healthdb->bind(':occupation', $occupation);
                $healthdb->bind(':employerName', $employerName);
                $healthdb->bind(':employerContact', $employerContact);
                $healthdb->bind(':emergencyName', $emergencyName);
                $healthdb->bind(':emergencyContact', $emergencyContact);
                $healthdb->bind(':uuid', $uuid);

                if (!$healthdb->execute()) {
                    die('Execute error: ' . $healthdb->error);
                } else {
                    echo 1; 
                }   
    
            }
            else {
               echo 2;
               return;
            }

    }


    public static function saveComplaintDetails(
        $propertyName,
        $apartmentNumber,
        $location,
        $complaintType,
        $issueCategory,
        $expectedResolutionTime,
        $incidentSeverity,
        $complaintPriority,
        $contactMethod,
        $previousComplaints,
        $issueDescription,
        $stepsTaken,
        $additionalComments,
        $uuid,
        $clientid
        ) 
        {
            global $healthdb;

        
            $issueTrackingNumber = 'ITN-' . uniqid();

            $query = "INSERT INTO `complaints`
                    (`propertyid`, `apartment`, `location`, `complaintType`, `issueCategory`, 
                    `resolutionTime`, `incidentSeverity`, `compliantPriority`, `contactMethod`, 
                    `previousIssue`, `issueDescription`, `stepsTaken`, `additionalComments`, 
                    `createdAt`, `uuid`, `clientid`, `issueTrackingNumber`)
                VALUES (
                    :propertyName, :apartmentNumber, :location, :complaintType, :issueCategory,
                    :expectedResolutionTime, :incidentSeverity, :complaintPriority, :contactMethod, 
                    :previousComplaints, :issueDescription, :stepsTaken, :additionalComments,
                    NOW(), :uuid, :clientid, :issueTrackingNumber)";

            $healthdb->prepare($query);

            // Bind the variables using named parameters
            $healthdb->bind(':propertyName', $propertyName);
            $healthdb->bind(':apartmentNumber', $apartmentNumber);
            $healthdb->bind(':location', $location);
            $healthdb->bind(':complaintType', $complaintType);
            $healthdb->bind(':issueCategory', $issueCategory);
            $healthdb->bind(':expectedResolutionTime', $expectedResolutionTime);
            $healthdb->bind(':incidentSeverity', $incidentSeverity);
            $healthdb->bind(':complaintPriority', $complaintPriority);
            $healthdb->bind(':contactMethod', $contactMethod);
            $healthdb->bind(':previousComplaints', $previousComplaints);
            $healthdb->bind(':issueDescription', $issueDescription);
            $healthdb->bind(':stepsTaken', $stepsTaken);
            $healthdb->bind(':additionalComments', $additionalComments);
            $healthdb->bind(':uuid', $uuid);
            $healthdb->bind(':clientid', $clientid);
            $healthdb->bind(':issueTrackingNumber', $issueTrackingNumber);

            if (!$healthdb->execute()) {
                die('Execute error: ' . $healthdb->error);
            } else {
                $subject = "Complaint Acknowledgement - Your Issue Tracking ID: $issueTrackingNumber";
                $fullName = Tools::clientName($clientid);
                $emailAddress = Tools::clientEmail($clientid);

                $message = "<p>Dear $fullName,</p>

                <p>Thank you for submitting your complaint. We have successfully received your request and are currently reviewing the details to provide you with the appropriate support.</p>
                <p>Below are the details of your complaint:</p>
            
                <table style='border-collapse: collapse; width: 70%;'>
                    <tr>
                        <td><strong>Issue Tracking ID:</strong></td>
                        <td>$issueTrackingNumber</td>
                    </tr>
                    <tr>
                        <td><strong>Property Name:</strong></td>
                        <td>$propertyName</td>
                    </tr>
                    <tr>
                        <td><strong>Apartment Number:</strong></td>
                        <td>$apartmentNumber</td>
                    </tr>
                    <tr>
                        <td><strong>Location:</strong></td>
                        <td>$location</td>
                    </tr>
                    <tr>
                        <td><strong>Complaint Type:</strong></td>
                        <td>$complaintType</td>
                    </tr>
                    <tr>
                        <td><strong>Issue Category:</strong></td>
                        <td>$issueCategory</td>
                    </tr>
                    <tr>
                        <td><strong>Expected Resolution Time:</strong></td>
                        <td>$expectedResolutionTime</td>
                    </tr>
                    <tr>
                        <td><strong>Incident Severity:</strong></td>
                        <td>$incidentSeverity</td>
                    </tr>
                    <tr>
                        <td><strong>Priority Level:</strong></td>
                        <td>$complaintPriority</td>
                    </tr>
                    <tr>
                        <td><strong>Contact Method:</strong></td>
                        <td>$contactMethod</td>
                    </tr>
                </table>
            
                <p>Our team is committed to addressing your complaint promptly. Please use your <strong>Issue Tracking ID</strong> ($issueTrackingNumber) for any future correspondence regarding this issue.</p>
            
                <p>If you have any further questions or updates, please do not hesitate to reach out.</p>
            
                <p>Thank you for your patience and understanding.</p>
            
                <p>Best regards,</p>
                <p>Thank you,<br>The Signum Properties Team</p>";

                SendEmail::compose($emailAddress, $subject, $message);
                echo 'Complaint saved successfully with Tracking Number: ' . $issueTrackingNumber;
            }
    }

    public static function saveVerification(
            $verifyRemarks,
            $verifyFeedback,
            $idIndex
        ) 
        {
            global $healthdb;

            $query = "UPDATE `complaints` SET 
                    `verifyRemarks` = :verifyRemarks, 
                    `verifyFeedback` = :verifyFeedback, 
                    `updatedAt` = NOW()
                    WHERE complaintid = :idIndex";

            $healthdb->prepare($query);

            // Bind the variables using named parameters
            $healthdb->bind(':verifyRemarks', $verifyRemarks);
            $healthdb->bind(':verifyFeedback', $verifyFeedback);
            $healthdb->bind(':idIndex', $idIndex);

            // Execute the statement and check for errors
            if (!$healthdb->execute()) {
                die('Execute error: ' . $healthdb->error);
            } else {
                echo 1;  // Successfully inserted
            }
    }


    public static function savePassword($currentPassword,$newPassword,$uuid) {
        global $healthdb;

        $encrPassword = md5($newPassword);
        $encNewPassword = md5($currentPassword);
        $chkUser = "SELECT * FROM `compusers` WHERE `uuid` = '$uuid' AND `password` =  '$encNewPassword'";
        $healthdb->prepare($chkUser);
        $resultUser = $healthdb->singleRecord();

        if ($resultUser) {
            $query = "UPDATE `compusers` SET 
            `password` = :encrPassword,
            `updatedAt` = NOW()  
            WHERE `uuid` = :uuid";
            $healthdb->prepare($query);

            $healthdb->bind(':encrPassword', $encrPassword);
            $healthdb->bind(':uuid', $uuid);

            if (!$healthdb->execute()) {
                die('Execute error: ' . $healthdb->error);
            } else {
                echo 1; 
            }
        } else {
            echo 2;
            return;
        }


    }   


}