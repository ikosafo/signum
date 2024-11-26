<?php

class Institution extends tableDataObject
{
    const TABLENAME = 'companydepartments';

    public static function listCompanyDepartments() {
        global $healthdb;

        $getList = "SELECT * FROM `companydepartments` where `status` = 1 ORDER BY `departmentId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }

    public static function listUsers() {
        global $healthdb;

        $getList = "SELECT * FROM `compusers` where `status` = 1 ORDER BY `createdAt` DESC, `firstName`,`lastName` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
    
    public static function saveDepartment($departmentName,$description) {
        global $healthdb;

        $getName = "SELECT * FROM `companydepartments` WHERE `departmentName` = '$departmentName' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();

        if ($resultName) {
            //Already exists
            echo 2;
        }
        else {
            $query = "INSERT INTO `companydepartments`
            (`departmentName`,
             `description`,
              `createdAt`
             )
            VALUES ('$departmentName',
                    '$description',
                    NOW()
                    )";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully inserted
        }
       
    }

    public static function departmentDetails($deptid) {
        global $healthdb;

        $getList = "SELECT * FROM `companydepartments` where `departmentId` = '$deptid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
        $departmentName = $resultRec->departmentName;
        $description = $resultRec->description;
        return [
            'departmentName' => $departmentName,
            'description' => $description
        ];
    }

    public static function editDepartment($departmentName,$description,$deptid) {

        global $healthdb;

        $getName = "SELECT * FROM `companydepartments` WHERE `departmentName` = '$departmentName' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();

        if ($resultName) {
            //Already exists
            echo 2;
        }
        else {
            $query = "UPDATE `companydepartments` 
            SET `departmentName` = '$departmentName',
            `updatedAt` = NOW(),
            `description` = '$description'
            WHERE `departmentId` = '$deptid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully updated
        }
       
    }

    public static function deleteDepartment($deptid) {

        global $healthdb;
            $query = "UPDATE `companydepartments` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `departmentId` = '$deptid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully updated
       
    }
    
    public static function listDepartment() {
        global $healthdb;

        $getList = "SELECT * FROM `companydepartments` where `status` = 1 ORDER BY `departmentId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function saveUser(
        $firstName,
        $lastName,
        $emailAddress,
        $phoneNumber,
        $altPhoneNumber,
        $dateBirth,
        $department,
        $address,
        $jobTitle,
        $uuid
    ) {
        global $healthdb;
    
        // Query to check if the UUID already exists
        $getByUuid = "SELECT * FROM `compusers` WHERE `uuid` = :uuid";
        $healthdb->prepare($getByUuid);
        $healthdb->bind(':uuid', $uuid);
        $resultByUuid = $healthdb->singleRecord();
    
        if ($resultByUuid) {
            // Check for name conflict with a different UUID
            $checkNameConflict = "SELECT * FROM `compusers` 
                                  WHERE (`emailAddress` = :email OR `phoneNumber` = :phone) 
                                  AND `uuid` != :uuid";
            $healthdb->prepare($checkNameConflict);
            $healthdb->bind(':email', $emailAddress);
            $healthdb->bind(':phone', $phoneNumber);
            $healthdb->bind(':uuid', $uuid);
            $resultNameConflict = $healthdb->singleRecord();
    
            if ($resultNameConflict) {
                echo 2; // Conflict found
                return;
            } else {
                // Update existing record
                $query = "UPDATE `compusers`
                          SET `firstName` = :firstName,
                              `lastName` = :lastName,
                              `emailAddress` = :email,
                              `phoneNumber` = :phone,
                              `altPhoneNumber` = :altPhone,
                              `address` = :address,
                              `dateBirth` = :dateBirth,
                              `department` = :department,
                              `updatedAt` = NOW(),
                              `jobtitle` = :jobTitle
                          WHERE `uuid` = :uuid";
                $healthdb->prepare($query);
                $healthdb->bind(':firstName', $firstName);
                $healthdb->bind(':lastName', $lastName);
                $healthdb->bind(':email', $emailAddress);
                $healthdb->bind(':phone', $phoneNumber);
                $healthdb->bind(':altPhone', $altPhoneNumber);
                $healthdb->bind(':address', $address);
                $healthdb->bind(':dateBirth', $dateBirth);
                $healthdb->bind(':department', $department);
                $healthdb->bind(':jobTitle', $jobTitle);
                $healthdb->bind(':uuid', $uuid);
                $healthdb->execute();
    
                echo 1; // Update successful
                return;
            }
        } else {
            // Check for existing user with same email or phone
            $getByName = "SELECT * FROM `compusers` 
                          WHERE (`emailAddress` = :email OR `phoneNumber` = :phone)";
            $healthdb->prepare($getByName);
            $healthdb->bind(':email', $emailAddress);
            $healthdb->bind(':phone', $phoneNumber);
            $resultByName = $healthdb->singleRecord();
    
            if ($resultByName) {
                echo 2; // Conflict found
                return;
            } else {
                // Insert new user
                $password = Tools::generateRandomPassword();
                $encPassword = md5($password);
                $username = $emailAddress;
    
                $query = "INSERT INTO `compusers`
                          (`firstName`, `lastName`, `emailAddress`, `phoneNumber`, 
                           `altPhoneNumber`, `address`, `dateBirth`, `department`, 
                           `createdAt`, `uuid`, `jobtitle`, `password`, `username`)
                          VALUES (:firstName, :lastName, :email, :phone, 
                                  :altPhone, :address, :dateBirth, :department, 
                                  NOW(), :uuid, :jobTitle, :password, :username)";
                try {
                    $healthdb->prepare($query);
                    $healthdb->bind(':firstName', $firstName);
                    $healthdb->bind(':lastName', $lastName);
                    $healthdb->bind(':email', $emailAddress);
                    $healthdb->bind(':phone', $phoneNumber);
                    $healthdb->bind(':altPhone', $altPhoneNumber);
                    $healthdb->bind(':address', $address);
                    $healthdb->bind(':dateBirth', $dateBirth);
                    $healthdb->bind(':department', $department);
                    $healthdb->bind(':uuid', $uuid);
                    $healthdb->bind(':jobTitle', $jobTitle);
                    $healthdb->bind(':password', $encPassword);
                    $healthdb->bind(':username', $username);
    
                    $healthdb->execute();
                    echo 1; // Insert successful


                    $query = "INSERT INTO `test_passwords`
                    (`username`,
                     `password`,
                      `createdAt`
                     )
                    VALUES ('$username',
                            '$password',
                            NOW()
                            )";
        
                        $healthdb->prepare($query);
                        $healthdb->execute();


                } catch (Exception $e) {
                    error_log($e->getMessage());
                    echo 0; // Failure
                }

                flush(); // Send the response
                sleep(1); // Optional delay to separate the response from email processing
    
                // Send email
                self::sendWelcomeEmail($firstName, $lastName, $emailAddress, $password);
                return;
            }
        }
    }
    
    

    
    private static function sendWelcomeEmail($firstName, $lastName, $emailAddress, $password = null) {
        $fullName = $firstName . ' ' . $lastName;
        $subject = 'Welcome to Signum Properties - Account Created';
        $message = "Dear <span style='text-transform: uppercase'>$fullName</span>, 
    
        <p>Welcome to <b>Signum Properties</b>! Your account has been successfully created.</p>
        <p>You can log in to your portal at <a href='https://signumproperties.com'>https://signumproperties.com</a>.</p>";
    
        if ($password) {
            $message .= "<p><b>Login Credentials:</b><br>
            Username: <b>$emailAddress</b><br>
            Password: <b>$password</b></p>";
        }
    
        $message .= "<p>Please keep these credentials secure. We recommend updating your password after your first login.</p>
        <p>Thank you,<br>The Signum Properties Team</p>";
    
        try {
            SendEmail::compose($emailAddress, $subject, $message);
        } catch (Exception $e) {
            // Log email error if necessary
            error_log('Failed to send email to ' . $emailAddress . ': ' . $e->getMessage());
        }
    }
    


    public static function saveUserAccount(
                $username,
                $password, 
                $securityQuestion,
                $securityAnswer,
                $uuid
        ) {
        global $healthdb;
    
        $getByUuid = "SELECT * FROM `compusers` WHERE `uuid` = '$uuid'";
        $healthdb->prepare($getByUuid);
        $resultByUuid = $healthdb->singleRecord();
    
        if ($resultByUuid) {
            $checkNameConflict = "SELECT * FROM `compusers` WHERE `username` = '$username' AND `uuid` != '$uuid'";
            $healthdb->prepare($checkNameConflict);
            $resultNameConflict = $healthdb->singleRecord();
    
            if ($resultNameConflict) {
                echo 2;
            } else {
                $query = "UPDATE `compusers` 
                          SET `username` = '$username',
                              `password` = '$password',
                              `securityQuestion` = '$securityQuestion',
                              `securityAnswer` = '$securityAnswer',
                              `updatedAt` = NOW()
                          WHERE `uuid` = '$uuid'";
    
                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;
            }
        } else {
            $getByName = "SELECT * FROM `compusers` WHERE `username` = '$username'";
            $healthdb->prepare($getByName);
            $resultByName = $healthdb->singleRecord();
    
            if ($resultByName) {
                echo 2;
            } else {
                $query = "UPDATE `compusers` 
                          SET `username` = '$username',
                              `password` = '$password',
                              `securityQuestion` = '$securityQuestion',
                              `securityAnswer` = '$securityAnswer',
                              `updatedAt` = NOW()
                          WHERE `uuid` = '$uuid'";
    
                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;
            }
        }
    }


    public static function saveRole(
        $userRole,
        $permissions,
        $uuid,
        $complaints
    ) {
        global $healthdb;
        $complaintsString = is_array($complaints) ? implode(', ', $complaints) : $complaints;
    
        $query = "UPDATE `compusers` SET 
                   `accessLevel` = :userRole,
                   `updatedAt` = NOW()
                   WHERE `uuid` = :uuid";
    
        $healthdb->prepare($query);
        $healthdb->bind(':userRole', $userRole);
        $healthdb->bind(':uuid', $uuid);
        $healthdb->execute();
    
        $deleteQuery = "DELETE FROM `permission` WHERE `uuid` = :uuid";
        $healthdb->prepare($deleteQuery);
        $healthdb->bind(':uuid', $uuid);
        $healthdb->execute();
    
        foreach ($permissions as $permission) {
            $insertQuery = "INSERT INTO `permission` (`permission`, `uuid`) 
                            VALUES (:permission, :uuid)";
            $healthdb->prepare($insertQuery);
            $healthdb->bind(':permission', $permission);
            $healthdb->bind(':uuid', $uuid);
            $healthdb->execute();
        }


        $deleteQuery = "DELETE FROM `issuecategories` WHERE `uuid` = :uuid";
        $healthdb->prepare($deleteQuery);
        $healthdb->bind(':uuid', $uuid);
        $healthdb->execute();
    
        foreach ($complaints as $category) {
            $insertQuery = "INSERT INTO `issuecategories` (`category`, `uuid`) 
                            VALUES (:category, :uuid)";
            $healthdb->prepare($insertQuery);
            $healthdb->bind(':category', $category);
            $healthdb->bind(':uuid', $uuid);
            $healthdb->execute();
        }
    
        // Indicate success
        echo 1;
    }
    


    public static function userDetails($userid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `compusers` WHERE `id` = '$userid' OR `uuid` = '$userid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'firstName' => $resultRec->firstName,
            'lastName' => $resultRec->lastName,
            'emailAddress' => $resultRec->emailaddress,
            'phoneNumber' => $resultRec->phoneNumber,
            'altPhoneNumber' => $resultRec->altPhoneNumber,
            'address' => $resultRec->address,
            'dateBirth' => $resultRec->dateBirth,
            'username' => $resultRec->username,
            'accessLevel' => $resultRec->accessLevel,
            'department' => $resultRec->department,
            'emergencyContactInfo' => $resultRec->emergencyContactInfo,
            'jobtitle' => $resultRec->jobtitle,
            'securityQuestion' => $resultRec->securityQuestion,
            'securityAnswer' => $resultRec->securityAnswer,
            'createdAt' => $resultRec->createdAt,
            'updatedAt' => $resultRec->updatedAt,
            'uuid' => $resultRec->uuid,
            'accessLevel' => $resultRec->accessLevel
        ];
    }
    

}