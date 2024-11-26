<?php

class Property extends PostController
{

    public function saveProperty()
    {
        $propertyName = $_POST['propertyName'];
        $propertyType = $_POST['propertyType'];
        $propertyCategory = $_POST['propertyCategory'];
        $propertyAddress = $_POST['propertyAddress'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $numberOfTenants = $_POST['numberOfTenants'];
        $propertySize = $_POST['propertySize'];
        $furnishingStatus = $_POST['furnishingStatus'];
        $propertyManager = $_POST['propertyManager'];
        $selectedFacilities = $_POST['selectedFacilities'];
        $uuid = $_POST['uuid'];

        Properties::saveProperty(
            $propertyName,
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
            $uuid
        );

    }

    public function saveCategory()
    {
        $categoryName = $_POST['categoryName'];
        $description = $_POST['description'];
        Properties::saveCategory($categoryName,$description);
    }

    public function saveMaintenanceFee()
    {
        $propertyName = $_POST['propertyName'];
        $amount = $_POST['amount'];
        Properties::saveMaintenanceFee($propertyName,$amount);
    }

    public function editCategory()
    {
        $catid = $_POST['catid'];
        $categoryName = $_POST['categoryName'];
        $description = $_POST['description'];
        Properties::editCategory($categoryName,$description,$catid);
    }


    public function saveClientDetails()
    {

        $fullName = $_POST['fullName'];
        $emailAddress = $_POST['emailAddress'];
        $phoneNumber = $_POST['phoneNumber'];
        $altPhoneNumber = $_POST['altPhoneNumber'];
        $residentialAddress = $_POST['residentialAddress'];
        $nationality = $_POST['nationality'];
        $birthDate = $_POST['birthDate'];
        $gender = $_POST['gender'];
        $maritalStatus = $_POST['maritalStatus'];
        $occupation = $_POST['occupation'];
        $employerName = $_POST['employerName'];
        $employerContact = $_POST['employerContact'];
        $emergencyName = $_POST['emergencyName'];
        $emergencyContact = $_POST['emergencyContact'];
        $ownershipType = $_POST['ownershipType'];
        $clientType = $_POST['clientType'];
        $uuid = $_POST['uuid'];
        $propertyId = $_POST['propertyName'];
        $contractType = $_POST['contractType'];
        
        Clients::saveClientDetails(
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
        );
    }


    public function saveRentalDetails()
    {
        $rentAmount = $_POST['rentAmount'];
        $depositAmount = $_POST['depositAmount'];
        $leasePeriod = $_POST['leasePeriod'];
        $availabilityDate = $_POST['availabilityDate'];
        $utilitiesIncluded = $_POST['utilitiesIncluded'];
        $paymentFrequency = $_POST['paymentFrequency'];
        $uuid = $_POST['uuid'];
        $numberRooms = $_POST['numberRooms'];

        Properties::saveRentalDetails(
            $rentAmount,
            $depositAmount,
            $leasePeriod,
            $availabilityDate,
            $utilitiesIncluded,
            $paymentFrequency,
            $uuid,
            $numberRooms
        );
    }

    public function saveRentInfo()
    {
        $rentAmount = $_POST['rentAmount'];
        $securityDeposit = $_POST['securityDeposit'];
        $penaltyAmount = $_POST['penaltyAmount'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $leaseType = $_POST['leaseType'];
        $bedroomNumber = $_POST['bedroomNumber'];
        $leaseRenewable = $_POST['leaseRenewable'];
        $additionalDescription = $_POST['additionalDescription'];
        $additionalCharges = $_POST['additionalCharges'];
        $uuid = $_POST['uuid'];
        $propertyid = $_POST['propertyid'];
        $clientid = $_POST['clientid'];

        Properties::saveRentInfo(
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
        );
    }

    


}
