<?php

class Properties extends tableDataObject
{
    const TABLENAME = 'properties';

    public static function saveProperty($propertyName,
                                    $propertyType,
                                    $propertyCategory,
                                    $propertyAddress,
                                    $location,
                                    $description,
                                    $numberOfTenants,
                                    $propertySize,
                                    $furnishingStatus,
                                    $propertyManager,
                                    $selectedFacilities,
                                    $uuid) {

        global $healthdb;
        $facilitiesString = implode(',', $selectedFacilities);
        $propertyManagerString = implode(',', $propertyManager);

        // Query to check if the UUID already exists
        $getByUuid = "SELECT * FROM `properties` WHERE `uuid` = '$uuid'";
        $healthdb->prepare($getByUuid);
        $resultByUuid = $healthdb->singleRecord();

        if ($resultByUuid) {
            // Check if the new property name already exists for a different UUID
            $checkNameConflict = "SELECT * FROM `properties` WHERE `propertyName` = '$propertyName' AND `uuid` != '$uuid'";
            $healthdb->prepare($checkNameConflict);
            $resultNameConflict = $healthdb->singleRecord();

            if ($resultNameConflict) {
                // If the property name exists for a different UUID, echo 2
                echo 2;
            } else {
                // If no conflict, update the existing record
                $query = "UPDATE `properties` 
            SET `propertyName` = :propertyName,
                `propertyType` = :propertyType,
                `propertyCategory` = :propertyCategory,
                `propertyAddress` = :propertyAddress,
                `location` = :location,
                `description` = :description,
                `numberOfTenants` = :numberOfTenants,
                `propertySize` = :propertySize,
                `furnishingStatus` = :furnishingStatus,
                `propertyManager` = :propertyManager,
                `facilities` = :facilities,
                `updatedAt` = NOW()
            WHERE `uuid` = :uuid";

                $healthdb->prepare($query);
                $healthdb->bind(':propertyName', $propertyName);
                $healthdb->bind(':propertyType', $propertyType);
                $healthdb->bind(':propertyCategory', $propertyCategory);
                $healthdb->bind(':propertyAddress', $propertyAddress);
                $healthdb->bind(':location', $location);
                $healthdb->bind(':description', $description);
                $healthdb->bind(':numberOfTenants', $numberOfTenants);
                $healthdb->bind(':propertySize', $propertySize);
                $healthdb->bind(':furnishingStatus', $furnishingStatus);
                $healthdb->bind(':propertyManager', $propertyManagerString);
                $healthdb->bind(':facilities', $facilitiesString);
                $healthdb->bind(':uuid', $uuid);

                // Execute the statement and check for errors
                if (!$healthdb->execute()) {
                    die('Execute error: ' . $healthdb->error);
                } else {
                    echo 3;  // Print success message
                }

            }
        } else {
            // Query to check if a property with the same name exists
            $getByName = "SELECT * FROM `properties` WHERE `propertyName` = '$propertyName'";
            $healthdb->prepare($getByName);
            $resultByName = $healthdb->singleRecord();

            if ($resultByName) {
                // If a different UUID exists but the same property name exists, echo 2
                echo 2;
            } else {
                // Insert new property if no conflicts
                $query = "INSERT INTO `properties`
                    (`propertyName`, `propertyType`, `propertyCategory`, `propertyAddress`, `location`, `description`, `numberOfTenants`, `propertySize`, `furnishingStatus`, `propertyManager`, `facilities`, `createdAt`, `uuid`)
                    VALUES (:propertyName, :propertyType, :propertyCategory, :propertyAddress, :location, :description, :numberOfTenants, :propertySize, :furnishingStatus, :propertyManager, :facilities, NOW(), :uuid)";

                    $healthdb->prepare($query);

                    // Bind the variables using named parameters
                    $healthdb->bind(':propertyName', $propertyName);
                    $healthdb->bind(':propertyType', $propertyType);
                    $healthdb->bind(':propertyCategory', $propertyCategory);
                    $healthdb->bind(':propertyAddress', $propertyAddress);
                    $healthdb->bind(':location', $location);
                    $healthdb->bind(':description', $description);
                    $healthdb->bind(':numberOfTenants', $numberOfTenants);
                    $healthdb->bind(':propertySize', $propertySize);
                    $healthdb->bind(':furnishingStatus', $furnishingStatus);
                    $healthdb->bind(':propertyManager', $propertyManagerString);
                    $healthdb->bind(':facilities', $facilitiesString);
                    $healthdb->bind(':uuid', $uuid);

                    // Execute the statement and check for errors
                    if (!$healthdb->execute()) {
                        die('Execute error: ' . $healthdb->error);
                    } else {
                        echo 1;  // Successfully inserted
                    }

                

                $logInsQ = "insert into systemlog (logcategory,user,logmessage,diagnostic)
					values ('debug','AD API',:message,:logdiag)";

                    $healthdb->prepare($facilitiesString);
                    $healthdb->bind(':pin', $propertyManagerString);
            }
        }
    }


    public static function saveCategory($categoryName,$description) {

        global $healthdb;

        $getName = "SELECT * FROM `propertyCategory` WHERE `categoryName` = '$categoryName' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();

        if ($resultName) {
            //Already exists
            echo 2;
        }
        else {
            $query = "INSERT INTO `propertycategory`
            (`categoryName`,
             `description`,
              `createdAt`
             )
            VALUES ('$categoryName',
                    '$description',
                    NOW()
                    )";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully inserted
        }
       
    }


    public static function deleteMaintenanceFee($feeid) {
        global $healthdb;
        $query = "UPDATE `maintenancefee` 
        SET `status` = 0,
        `updatedAt` = NOW()
        WHERE `feeid` = '$feeid'";

        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;  // Successfully updated
       
    }


    public static function saveMaintenanceFee($propertyName,$amount) {

        global $healthdb;

        $getName = "SELECT * FROM `maintenancefee` WHERE `propertyid` = '$propertyName' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();

        if ($resultName) {
            //Already exists
            echo 2;
        }
        else {
            $query = "INSERT INTO `maintenancefee`
            (`propertyid`,
             `amount`,
              `createdAt`
             )
            VALUES ('$propertyName',
                    '$amount',
                    NOW()
                    )";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully inserted
        }
       
    }

    
    public static function editCategory($categoryName,$description,$catid) {

        global $healthdb;

        $getName = "SELECT * FROM `propertyCategory` WHERE `categoryName` = '$categoryName' AND `status` = 1";
        $healthdb->prepare($getName);
        $resultName = $healthdb->singleRecord();

        if ($resultName) {
            //Already exists
            echo 2;
        }
        else {
            $query = "UPDATE `propertycategory` 
            SET `categoryName` = '$categoryName',
            `updatedAt` = NOW(),
            `description` = '$description'
            WHERE `categoryId` = '$catid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully updated
        }
       
    }

    
    public static function deleteCategory($catid) {

        global $healthdb;
            $query = "UPDATE `propertycategory` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `categoryId` = '$catid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1;  // Successfully updated
       
    }


    public static function deleteProperty($propertyid) {

        global $healthdb;
            $query = "UPDATE `properties` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `propertyId` = '$propertyid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1; 
       
    }


    public static function deleteRentInfo($rentid) {

        global $healthdb;
            $query = "UPDATE `rentinfo` 
            SET `status` = 0,
            `updatedAt` = NOW()
            WHERE `rentid` = '$rentid'";

            $healthdb->prepare($query);
            $healthdb->execute();
            echo 1; 
       
    }


    public static function saveRentalDetails(
                                $rentAmount,
                                $depositAmount,
                                $leasePeriod,
                                $availabilityDate,
                                $utilitiesIncluded,
                                $paymentFrequency,
                                $uuid,
                                $numberRooms
                                ) {

        global $healthdb;

        //$rentAmountString = implode(',', $rentAmount);
        $numberRoomsString = implode(',', $numberRooms);

        // If no conflict, update the existing record
        $query = "UPDATE `properties` 
        SET `rentAmount` = :rentAmount,
            `depositAmount` = :depositAmount,
            `leasePeriod` = :leasePeriod,
            `availabilityDate` = :availabilityDate,
            `utilitiesIncluded` = :utilitiesIncluded,
            `paymentFrequency` = :paymentFrequency,
            `numberRooms` = :numberRooms,
            `updatedAt` = NOW()
        WHERE `uuid` = :uuid";

        // Prepare the query
        $healthdb->prepare($query);

        // Bind parameters to the query
        $healthdb->bind(':rentAmount', $rentAmount);
        $healthdb->bind(':depositAmount', $depositAmount);
        $healthdb->bind(':leasePeriod', $leasePeriod);
        $healthdb->bind(':availabilityDate', $availabilityDate);
        $healthdb->bind(':utilitiesIncluded', $utilitiesIncluded);
        $healthdb->bind(':paymentFrequency', $paymentFrequency);
        $healthdb->bind(':numberRooms', $numberRoomsString);
        $healthdb->bind(':uuid', $uuid);

        // Execute and check for errors
        if (!$healthdb->execute()) {
            die('Execute error: ' . $healthdb->error);
        } else {
            echo 1;  // Indicate success
        }

    }


    public static function saveRentInfo(
        $rentAmount,
        $securityDeposit,
        $penaltyAmount,
        $startDate,
        $endDate,
        $leaseType,
        $bedroomNumber,
        $leaseRenewable,
        $additionalDescription,
        $additionalCharges,
        $uuid,
        $propertyid,
        $clientid
    ) {
        global $healthdb;
    
        $getByUUID = "SELECT * FROM `rentinfo` WHERE `clientid` = '$clientid' AND `uuid` = '$uuid'";
        $healthdb->prepare($getByUUID);
        $resultByUUID = $healthdb->singleRecord();
    
        if ($resultByUUID) {
            $query = "UPDATE `rentinfo`
                SET 
                    `propertyid` = '$propertyid',
                    `rentAmount` = '$rentAmount',
                    `securityAmount` = '$securityDeposit',
                    `penaltyAmount` = '$penaltyAmount',
                    `startDate` = '$startDate',
                    `endDate` = '$endDate',
                    `leaseType` = '$leaseType',
                    `numberRoom` = '$bedroomNumber',
                    `renewable` = '$leaseRenewable',
                    `description` = '$additionalDescription',
                    `addCharges` = '$additionalCharges',
                    `updatedAt` = NOW()
                WHERE `uuid` = '$uuid'";
    
            $healthdb->prepare($query);
            $healthdb->execute();
    
            echo 3; // Updated
        } else {
            $getByClient = "SELECT * FROM `rentinfo` WHERE `clientid` = '$clientid' AND `endDate` >= NOW()";
            $healthdb->prepare($getByClient);
            $resultByClient = $healthdb->singleRecord();
    
            if ($resultByClient) {
                echo 2; // Another active lease exists
            } else {
                $query = "INSERT INTO `rentinfo` (
                        `propertyid`,
                        `clientid`,
                        `rentAmount`,
                        `securityAmount`,
                        `penaltyAmount`,
                        `startDate`,
                        `endDate`,
                        `leaseType`,
                        `numberRoom`,
                        `renewable`,
                        `description`,
                        `addCharges`,
                        `uuid`,
                        `createdAt`
                    )
                    VALUES (
                        '$propertyid',
                        '$clientid',
                        '$rentAmount',
                        '$securityDeposit',
                        '$penaltyAmount',
                        '$startDate',
                        '$endDate',
                        '$leaseType',
                        '$bedroomNumber',
                        '$leaseRenewable',
                        '$additionalDescription',
                        '$additionalCharges',
                        '$uuid',
                        NOW()
                    )";
    
                $healthdb->prepare($query);
                $healthdb->execute();
    
                // Add billing rows
                self::generateMonthlyBills($startDate, $endDate, $uuid, $clientid);
    
                echo 1; // Successfully inserted
            }
        }
    }
    
    // Generate monthly billing records
    public static function generateMonthlyBills($startDate, $endDate, $uuid, $clientid)
    {
        global $healthdb;

        $rentAmount = Tools::getMaintenanceFee($clientid);
    
        // Convert dates to DateTime objects
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
    
        // Set to the first day of the month
        $start->modify('first day of this month');
    
        // Loop through each month until the end date
        while ($start <= $end) {
            $dateDue = $start->format('Y-m-d');
    
            // Prepare the insert query for billing
            $query = "INSERT INTO `billing` (
                    `billType`,
                    `amountPaid`,
                    `clientid`,
                    `createdAt`,
                    `uuid`,
                    `description`,
                    `dateDue`
                )
                VALUES (
                    'Rent',
                    '$rentAmount', 
                    '$clientid',
                    NOW(),
                    '$uuid',
                    'Monthly rent due',
                    '$dateDue'
                )";
    
                $healthdb->prepare($query);
                $healthdb->execute();
    
            // Move to the next month
            $start->modify('+1 month');
        }
    }
    


    public static function listPropertyCategory() {
        global $healthdb;

        $getList = "SELECT * FROM `propertyCategory` where `status` = 1 ORDER BY `categoryId` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listMaintenanceFee() {
        global $healthdb;

        $getList = "SELECT * FROM `maintenancefee` where `status` = 1 ORDER BY `feeid` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }

    
    public static function listRentInformation() {
        global $healthdb;

        $getList = "SELECT * FROM `rentinfo` where `status` = 1 ORDER BY `createdAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
    
    
    public static function categoryDetails($catid) {
        global $healthdb;

        $getList = "SELECT * FROM `propertyCategory` where `categoryId` = '$catid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
        $categoryName = $resultRec->categoryName;
        $description = $resultRec->description;
        return [
            'categoryName' => $categoryName,
            'description' => $description
        ];
    }


    public static function listProperties() {
        global $healthdb;

        $getList = "SELECT * FROM `properties` where `status` = 1 ORDER BY createdAt DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }

    
    public static function listClients() {
        global $healthdb;

        $getList = "SELECT * FROM `clients` where `status` = 1 ORDER BY `createdAt` DESC, `updatedAt` DESC, fullName";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listClientsProp($propertyId) {
        global $healthdb;

        $getList = "SELECT * FROM `clients` where `status` = 1 AND propertyid = '$propertyId' ORDER BY `createdAt` DESC, `updatedAt` DESC, fullName";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listRentDue($clientid) {
        global $healthdb;

        $getList = "SELECT * FROM `rentinfo` WHERE `clientid` = '$clientid' AND `status` = 1 ORDER BY `createdAt` DESC, `updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function listMaintenanceDue($clientid) {
        global $healthdb;

        $getList = "SELECT * FROM `billing` WHERE `clientid` = '$clientid' AND `status` = 1 ORDER BY `createdAt` DESC, `updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }


    public static function previousRent($clientid,$lastRentId) {
        global $healthdb;

        $getList = "SELECT * FROM `rentinfo` WHERE `clientid` = '$clientid' AND `rentid` != '$lastRentId' AND `status` = 1 ORDER BY `createdAt` DESC, `updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
    
 
    public static function propertyDetails($propertyid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `properties` WHERE `propertyId` = '$propertyid' OR `uuid` = '$propertyid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'propertyName' => $resultRec->propertyName,
            'propertyType' => $resultRec->propertyType,
            'propertyCategory' => $resultRec->propertyCategory,
            'propertyAddress' => $resultRec->propertyAddress,
            'location' => $resultRec->location,
            'description' => $resultRec->description,
            'numberOfTenants' => $resultRec->numberOfTenants,
            'propertySize' => $resultRec->propertySize,
            'furnishingStatus' => $resultRec->furnishingStatus,
            'propertyManager' => $resultRec->propertyManager,
            'createdAt' => $resultRec->createdAt,
            'updatedAt' => $resultRec->updatedAt,
            'uuid' => $resultRec->uuid,
            'facilities' => $resultRec->facilities,
            'status' => $resultRec->status,
            'rentAmount' => $resultRec->rentAmount,
            'depositAmount' => $resultRec->depositAmount,
            'leasePeriod' => $resultRec->leasePeriod,
            'availabilityDate' => $resultRec->availabilityDate,
            'utilitiesIncluded' => $resultRec->utilitiesIncluded,
            'paymentFrequency' => $resultRec->paymentFrequency,
            'propertyId' => $resultRec->propertyId,
            'numberRooms' => $resultRec->numberRooms

        ];
    }


    public static function ownerDetails($propertyid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `clients` WHERE `propertyid` = '$propertyid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'clientType' => @$resultRec->clientType,
            'ownershipType' => @$resultRec->ownershipType,
            'fullName' => @$resultRec->fullName,
            'emailAddress' => @$resultRec->emailAddress,
            'phoneNumber' => @$resultRec->phoneNumber,
            'altPhoneNumber' => @$resultRec->altPhoneNumber,
            'residentialAddress' => @$resultRec->residentialAddress,
            'nationality' => @$resultRec->nationality,
            'birthDate' => @$resultRec->birthDate,
            'gender' => @$resultRec->gender,
            'maritalStatus' => @$resultRec->maritalStatus,
            'occupation' => @$resultRec->occupation,
            'employersName' => @$resultRec->employersName,
            'employersPhone' => @$resultRec->employersPhone,
            'emergencyName' => @$resultRec->emergencyName,
            'emergencyPhone' => @$resultRec->emergencyPhone,
            'uuid' => @$resultRec->uuid,
            'propertyid' => @$resultRec->propertyid,
            'contractType' => @$resultRec->contractType

        ];
    }

    
    public static function rentInfo($rentid) {
        global $healthdb;
    
        $getList = "SELECT * FROM `rentinfo` WHERE `rentid` = '$rentid'";
        $healthdb->prepare($getList);
        $resultRec = $healthdb->singleRecord();
    
        return [
            'rentAmount' => $resultRec->rentAmount,
            'securityAmount' => $resultRec->securityAmount,
            'penaltyAmount' => $resultRec->penaltyAmount,
            'startDate' => $resultRec->startDate,
            'endDate' => $resultRec->endDate,
            'leaseType' => $resultRec->leaseType,
            'numberRoom' => $resultRec->numberRoom,
            'renewable' => $resultRec->renewable,
            'description' => $resultRec->description,
            'addCharges' => $resultRec->addCharges,
            'clientid' => $resultRec->clientid,
            'propertyid' => $resultRec->propertyid,
            'uuid' => $resultRec->uuid
        ];
    }

}