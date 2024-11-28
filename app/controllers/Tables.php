<?php

class Tables extends Controller
{

    public function propertyCategories()
    {
        $listPropertyCategory = Properties::listPropertyCategory();
        $this->view("tables/propertyCategories",['listPropertyCategory' => $listPropertyCategory]);
    }

    public function maintenanceFee()
    {
        $listMaintenanceFee = Properties::listMaintenanceFee();
        $this->view("tables/maintenanceFee",['listMaintenanceFee' => $listMaintenanceFee]);
    }

    public function companyDepartments()
    {
        $listCompanyDepartments = Institution::listCompanyDepartments();
        $this->view("tables/companyDepartments",['listCompanyDepartments' => $listCompanyDepartments]);
    }

    public function adminUsers()
    {
        $listAdminUsers = Institution::listUsers();
        $this->view("tables/adminUsers",['listAdminUsers' => $listAdminUsers]);
    }

    public function properties()
    {
        $listProperties = Properties::listProperties();
        $this->view("tables/properties",['listProperties' => $listProperties]);
    }

    public function userPermissions() {
        new Guard();
        $listPermissions = Users::listPermissions();
        $this->view("tables/userPermissions",[
            'listPermissions' => $listPermissions
        ]);
    }  

    public function clients()
    {
        $listClients = Properties::listClients();
        $this->view("tables/clients",['listClients' => $listClients]);
    }

    public function rentInformation()
    {
        $listClients = Properties::listClients();
        $this->view("tables/rentInformation",['listClients' => $listClients]);
    }

    public function addRentInfo()
    {
        $listRentInformation = Properties::listRentInformation();
        $this->view("tables/addRentInfo",['listRentInformation' => $listRentInformation]);
    }
    
    public function billPayment()
    {
        $listClients = Properties::listClients();
        $this->view("tables/billPayment",['listClients' => $listClients]);
    }


    public function billPaymentMaintenance()
    {
        $listClients = Properties::listClients();
        $this->view("tables/billPaymentMaintenance",['listClients' => $listClients]);
    }


    public function billPaymentClient() {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $listRentDue = Properties::listRentDue($clientid);
        $this->view("tables/billPaymentClient",['listRentDue' => $listRentDue]);
    } 


    public function billMaintenanceClient() {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $listMaintenanceDue = Properties::listMaintenanceDue($clientid);
        $this->view("tables/billMaintenanceClient",['listMaintenanceDue' => $listMaintenanceDue]);
    } 

    
    public function clientPaymentHistoy() {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $clientPaymentHistoy = Billings::clientPaymentHistoy($clientid);
        $this->view("tables/clientPaymentHistoy",['clientPaymentHistoy' => $clientPaymentHistoy]);
    } 
    
    public function paymentHistory()
    {
        $paymentHistory = Billings::paymentHistory();
        $this->view("tables/paymentHistory",['paymentHistory' => $paymentHistory]);
    }


    public function clientComplaints() {
        new Guard();
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $listClientComplaints = Complaints::listClientComplaints($clientid);
        $this->view("tables/clientComplaints",[
            'listClientComplaints' => $listClientComplaints
        ]);
    }  


    public function inspectionHistory() {
        new Guard();
        $uid = $_SESSION['uid'];
        $listInspection = Inspections::listInspections($uid);
        $this->view("tables/inspectionHistory",[
            'listInspection' => $listInspection
        ]);
    }  


    public function complaintStatuses() {
        new Guard();
        
        $uid = $_SESSION['uid'];
        $uuid = Tools::getUUIDbyid($uid);
        $clientid = Tools::getClientidbyUUID($uuid);
        $status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : null;
        $listComplaints = Complaints::listComplaints($status,$clientid);       
        $this->view("tables/complaintStatuses", [
            'listComplaints' => $listComplaints,
            'status' => $status
        ]);
    }
      


}
