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
                                    $numberOfUnits,
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
                        SET `propertyName` = '$propertyName',
                            `propertyType` = '$propertyType',
                            `propertyCategory` = '$propertyCategory',
                            `propertyAddress` = '$propertyAddress',
                            `location` = '$location',
                            `description` = '$description',
                            `numberOfUnits` = '$numberOfUnits',
                            `propertySize` = '$propertySize',
                            `furnishingStatus` = '$furnishingStatus',
                            `propertyManager` = '$propertyManagerString',
                            `facilities` = '$facilitiesString',
                            `updatedAt` = NOW()
                        WHERE `uuid` = '$uuid'";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully updated
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
                            (`propertyName`,
                            `propertyType`,
                            `propertyCategory`,
                            `propertyAddress`,
                            `location`,
                            `description`,
                            `numberOfUnits`,
                            `propertySize`,
                            `furnishingStatus`,
                            `propertyManager`,
                            `facilities`,
                            `createdAt`,
                            `uuid`)
                        VALUES ('$propertyName',
                                '$propertyType',
                                '$propertyCategory',
                                '$propertyAddress',
                                '$location',
                                '$description',
                                '$numberOfUnits',
                                '$propertySize',
                                '$furnishingStatus',
                                '$propertyManagerString',
                                '$facilitiesString',
                                NOW(),
                                '$uuid')";

                $healthdb->prepare($query);
                $healthdb->execute();
                echo 1;  // Successfully inserted
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


    public static function saveRentalDetails($rentAmount,
                                $depositAmount,
                                $leasePeriod,
                                $availabilityDate,
                                $utilitiesIncluded,
                                $paymentFrequency,
                                $uuid,
                                $numberRooms) {

        global $healthdb;

        //$rentAmountString = implode(',', $rentAmount);
        $numberRoomsString = implode(',', $numberRooms);

        // If no conflict, update the existing record
        $query = "UPDATE `properties` 
        SET `rentAmount` = '$rentAmount',
            `depositAmount` = '$depositAmount',
            `leasePeriod` = '$leasePeriod',
            `availabilityDate` = '$availabilityDate',
            `utilitiesIncluded` = '$utilitiesIncluded',
            `paymentFrequency` = '$paymentFrequency',
            `numberRooms` = '$numberRoomsString',
            `updatedAt` = NOW()
        WHERE `uuid` = '$uuid'";

        $healthdb->prepare($query);
        $healthdb->execute();
        echo 1;  // Successfully updated

    }


    public static function listPropertyCategory() {
        global $healthdb;

        $getList = "SELECT * FROM `propertyCategory` where `status` = 1 ORDER BY `categoryId` DESC";
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

        $getList = "SELECT * FROM `properties` where `status` = 1 ORDER BY `propertyName`";
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
            'numberOfUnits' => $resultRec->numberOfUnits,
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

}