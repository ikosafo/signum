<?php

class Pages extends Controller
{

    public function forgetPassword()
    {
        $this->view("pages/auth/forgotpassword");
    }
    

    public function index()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $userDetails = Users::userDetails($uuid);
        $this->view("pages/index",['userDetails' => $userDetails]);
    }


    public function viewRequests()
    {
        new Guard();
        $this->view("pages/viewRequests");
    }


    public function client()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $clientDetails = Clients::clientDetails($clientid);
        $this->view("pages/client",['clientDetails' => $clientDetails]);
    }


    public function worker()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $this->view("pages/worker");
    }


    public function inspector()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $this->view("pages/inspector");
    }
    

    public function addProperty() {
        new Guard();
        $listPropertyCategory = Properties::listPropertyCategory();
        $listUsers = Users::listUsers();
        $this->view("pages/addProperty",[
            'listPropertyCategory' => $listPropertyCategory,
            'listUsers' => $listUsers
        ]);
    }  


    public function addUser() {
        new Guard();
        $listUsers = Users::listUsers();
        $listDepartment = Institution::listDepartment();
        $this->view("pages/addUser",[
            'listUsers' => $listUsers,
            'listDepartment' => $listDepartment
        ]);
    }  


    public function addTenant() {
        new Guard();
        $listUsers = Users::listUsers();
        $listDepartment = Institution::listDepartment();
        $listProperties = Properties::listProperties();
        $this->view("pages/addTenant",[
            'listUsers' => $listUsers,
            'listDepartment' => $listDepartment,
            'listProperties' => $listProperties
        ]);
    }  


    public function editUser() {
        new Guard();

        $listUsers = Users::listUsers();
        $encryptedId = $_GET['userid'];
        $decryptedUserId = Tools::unlock($encryptedId);
        $userDetails = Institution::userDetails($decryptedUserId);
        $uuid = $userDetails['uuid'];
        $userPermissions = Users::userPermissions($uuid);
        $userComplaints = Users::userComplaints($uuid);
        $listDepartment = Institution::listDepartment();

        $this->view("pages/editUser",[
            'listUsers' => $listUsers,
            'listDepartment' => $listDepartment,
            'userid' => $decryptedUserId,
            'userDetails' => $userDetails,
            'userPermissions' => $userPermissions,
            'userComplaints' => $userComplaints
        ]);
    } 
    

    public function editProperty() {
        new Guard();

        $listUsers = Users::listUsers();
        $listProperties = Properties::listProperties();
        $listPropertyCategory = Properties::listPropertyCategory();
        $encryptedId = $_GET['propertyid'];
        $decryptedUserId = Tools::unlock($encryptedId);
        $propertyDetails = Properties::propertyDetails($decryptedUserId);
        $uuid = $propertyDetails['uuid'];

        $this->view("pages/editProperty",[
            'listProperties' => $listProperties,
            'userid' => $decryptedUserId,
            'uuid' => $uuid,
            'propertyDetails' => $propertyDetails,
            'listPropertyCategory' => $listPropertyCategory,
            'listUsers' => $listUsers
        ]);
    } 


    public function editPayment() {
        new Guard();

        $encryptedId = $_GET['paymentid'];
        $decryptedUserId = Tools::unlock($encryptedId);
        $paymentDetails = Billings::paymentDetails($decryptedUserId);
        $this->view("pages/editPayment",['paymentDetails' => $paymentDetails]);
    } 


    public function listUsers() {
        new Guard();
        $listUsers = Users::listUsers();
        $this->view("pages/listUsers",[
            'listUsers' => $listUsers
        ]);
    }  


    public function userPermissions() {
        new Guard();
        $this->view("pages/userPermissions");
    }  


    public function paymentHistory() {
        new Guard();
        $paymentHistory = Billings::paymentHistory();
        $this->view("pages/paymentHistory",[
            'paymentHistory' => $paymentHistory
        ]);
    }  


    public function listClients() {
        new Guard();
        $listClients = Properties::listClients();
        $this->view("pages/listClients",[
            'listClients' => $listClients
        ]);
    }  

    
    public function addClient() {
        new Guard();
        $listProperties = Properties::listProperties();
        $this->view("pages/addClient",[
            'listProperties' => $listProperties
        ]);
    } 
    
    
    public function addInspectors() {
        new Guard();
        $listUsers = Users::listUsers();
        $this->view("pages/addInspectors",[
            'listUsers' => $listUsers
        ]);
    } 


    public function rentInformation() {
        new Guard();
        $listProperties = Properties::listProperties();
        $this->view("pages/rentInformation",[
            'listProperties' => $listProperties
        ]);
    }  


    public function billPayments() {
        new Guard();
        $this->view("pages/billPayments");
    } 
    

    public function scheduleInspection() {
        new Guard();
        $listProperties = Properties::listProperties();
        $listUsers = Users::listUsers();
        $this->view("pages/scheduleInspection",[
            'listProperties' => $listProperties,
            'listUsers' => $listUsers
        ]);
    } 
    

    public function billPaymentClient() {
        new Guard();
        $this->view("pages/billPaymentClient");
    }  


    public function billMaintenanceClient() {
        new Guard();
        $this->view("pages/billMaintenanceClient");
    }  


    public function clientPaymentHistory() {
        new Guard();
        $this->view("pages/clientPaymentHistory");
    }  
    

    public function viewClient() {
        new Guard();

        $encryptedId = $_GET['clientid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $clientDetails = Clients::clientDetails($decryptedClientId);
        $propertyid = $clientDetails['propertyid'];
        $propertyName = Tools::propertyClient($propertyid);
        $uuid = $clientDetails['uuid'];

        $this->view("pages/viewClient",[
            'uuid' => $uuid,
            'clientDetails' => $clientDetails,
            'propertyName' => $propertyName
        ]);
    } 


    public function viewComplaint() {
        new Guard();

        $encryptedId = $_GET['complaintid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $complaintDetails = Complaints::complaintDetails($decryptedClientId);
        $complaintid = $complaintDetails['complaintid'];

        $this->view("pages/viewComplaint",[
            'complaintDetails' => $complaintDetails
        ]);
    } 


    public function viewInspectionDetail() {
        new Guard();

        $encryptedId = $_GET['inspectionid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $inspectionDetails = Inspections::inspectionDetails($decryptedClientId);

        $this->view("pages/viewInspectionDetail",[
            'inspectionDetails' => $inspectionDetails
        ]);
    } 


    public function viewPayment() {
        new Guard();

        $encryptedId = $_GET['paymentid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $paymentDetails = Billings::paymentDetails($decryptedClientId);

        $this->view("pages/viewPayment",['paymentDetails' => $paymentDetails]);
    } 


    
    public function viewClientRent() {
        new Guard();
        
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $lastRentId = Tools::lastRentId($clientid);
        $rentInfo = Properties::rentInfo($lastRentId);
        $previousRent = Properties::previousRent($clientid,$lastRentId);

        $this->view("pages/viewClientRent",[
            'rentInfo' => $rentInfo,
            'previousRent' => $previousRent
        ]);
    } 


    public function viewRentInfo() {
        new Guard();

        $encryptedId = $_GET['rentid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $rentInfo = Properties::rentInfo($decryptedClientId);

        $this->view("pages/viewRentInfo",[
            'rentInfo' => $rentInfo
        ]);
    } 


    public function editClient() {
        new Guard();

        $encryptedId = $_GET['clientid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $clientDetails = Clients::clientDetails($decryptedClientId);
        $propertyid = $clientDetails['propertyid'];
        $propertyName = Tools::propertyClient($propertyid);
        $listProperties = Properties::listProperties();
        $uuid = $clientDetails['uuid'];

        $this->view("pages/editClient",[
            'uuid' => $uuid,
            'clientDetails' => $clientDetails,
            'propertyName' => $propertyName,
            'listProperties' => $listProperties
        ]);
    } 


    public function editRentInfo() {
        new Guard();

        $encryptedId = $_GET['rentid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $rentInfo = Properties::rentInfo($decryptedClientId);

        $this->view("pages/editRentInfo",[
            'rentInfo' => $rentInfo
        ]);
    } 


    public function viewProperty() {
        new Guard();

        $encryptedId = $_GET['propertyid'];
        $decryptedClientId = Tools::unlock($encryptedId);
        $propertyDetails = Properties::propertyDetails($decryptedClientId);
        $ownerDetails = Properties::ownerDetails($decryptedClientId);
        $uuid = $propertyDetails['uuid'];

        $this->view("pages/viewProperty",[
            'uuid' => $uuid,
            'propertyDetails' => $propertyDetails,
            'ownerDetails' => $ownerDetails
        ]);
    } 


    public function listProperties() {
        new Guard();
        $listProperties = Properties::listProperties();
        $this->view("pages/listProperties",[
            'listProperties' => $listProperties
        ]);
    }  


    public function listComplaints() {
        new Guard();
        $this->view("pages/listComplaints");
    }  


    public function inspectionHistory() {
        new Guard();
        $this->view("pages/inspectionHistory");
    } 


    public function complaintStatuses() {
        new Guard();
        $this->view("pages/complaintStatuses");
    }  


    public function listRentInformation() {
        new Guard();
        $listRentInformation = Properties::listRentInformation();
        $this->view("pages/listRentInformation",[
            'listRentInformation' => $listRentInformation
        ]);
    } 


    public function propertyCategories() {
        new Guard();  
        $this->view("pages/propertyCategories");
    } 
    
    
    public function maintenanceFee() {
        new Guard();  
        $this->view("pages/maintenanceFee");
    } 


    public function companyDepartments() {
        new Guard();  
        $this->view("pages/companyDepartments");
    } 


    public function logComplaint() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $listProperties = Properties::listProperties();
        $this->view("pages/logComplaint",
            [
                'listProperties' => $listProperties,
                'clientid' => $clientid
            ]);
    } 


    public function dailyInspection() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $listProperties = Properties::listProperties();
        $this->view("pages/dailyInspection",['listProperties' => $listProperties]);
    } 


    public function changePasswordClient() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $this->view("pages/changePasswordClient",
            ['clientid' => $clientid, 
                'uuid' => $uuid
            ]
        );
    } 


    public function changePasswordUser() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $this->view("pages/changePasswordUser",
            ['uid' => $uid, 
            'uuid' => $uuid
            ]
        );
    } 

    public function userProfileAdmin() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $userDetails = Users::userDetails($uid);
        $this->view("pages/userProfileAdmin", ['userDetails' => $userDetails]
        );
    } 
    

    public function userProfileClient() {
        new Guard();  
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $clientDetails = Clients::clientDetails($clientid);
        $this->view("pages/userProfileClient",['clientDetails' => $clientDetails]
        );
    } 
    

    public function lock()
    {
        new Guard();
        $data = array(
            'username' => $_SESSION['username'],
            'name' => $_SESSION['name'],
            'mainaccesslevel' => $_SESSION['mainaccesslevel']
        );
        unset($_SESSION['uid']);
        session_destroy();
        $this->view('pages/lock', $data);
    }


    public function locked()
    {
        $this->view('pages/locked');
    }
  
   /*  public function mail()
    {
        print_r(SendEmail::compose('yawshadi23@gmail.com', 'hello', 'how are you doing today'));
    } */

}
