<?php

class Tools extends tableDataObject{

    //const REG_ROOT = 'https://registration.ahpcgh.org';

   public static  function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public static function Pagination($per_page,$page,$sql){

        global $payrolldb;
        //TODO new way to accomodate the frameworks url parsing. the above method is the old way 
        
        $output = explode('&',$_SERVER['QUERY_STRING']);
        unset($output[0]);
        $newstring = implode('&',$output);

        if ($newstring==""){
            $page_url="?";
        }elseif(isset($_GET['page']) && sizeof($output)==1){
            $page_url="?";
        }else{
            $page_url="?".str_replace("&page=".$page,"",$newstring).'&';
        }
         $payrolldb->prepare($sql);
         $payrolldb->execute();
         $result=$payrolldb->rowCount();
         $total = $result;
         $adjacents = "2"; 
    
         $page = ($page == 0 ? 1 : $page);  
         $start = ($page - 1) * $per_page;								
         
         $prev = $page - 1;							
         $next = $page + 1;
         $setLastpage = ceil($total/$per_page);
         $lpm1 = $setLastpage - 1;
         
         $setPaginate = "";
         if($setLastpage > 1)
         {	
             $setPaginate .= "<ul class='setPagninate blog-pagination ptb-20'>";
                     $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
             if ($setLastpage < 7 + ($adjacents * 2))
             {	
                 for ($counter = 1; $counter <= $setLastpage; $counter++)
                 {
                     if ($counter == $page)
                         $setPaginate.= "<li class='active'><a class='current-page active'>$counter</a></li>";
                     else
                         $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
                 }
             }
             elseif($setLastpage > 5 + ($adjacents * 2))
             {
                 if($page < 1 + ($adjacents * 2))		
                 {
                     for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                     {
                         if ($counter == $page)
                             $setPaginate.= "<li class='active'><a class='current-page active'>$counter</a></li>";
                         else
                             $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
                     }
                     $setPaginate.= "<li class='blank'>...</li>";
                     $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                     $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
                 }
                 elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                 {
                     $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                     $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                     $setPaginate.= "<li class='blank'>...</li>";
                     for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                     {
                         if ($counter == $page)
                             $setPaginate.= "<li class='active'><a class='current-page active'>$counter</a></li>";
                         else
                             $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
                     }
                     $setPaginate.= "<li class='blank'>..</li>";
                     $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                     $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
                 }
                 else
                 {
                     $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                     $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                     $setPaginate.= "<li class='blank'>..</li>";
                     for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
                     {
                         if ($counter == $page)
                             $setPaginate.= "<li class='active'><a class='current-page active'>$counter</a></li>";
                         else
                             $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
                     }
                 }
             }
             
             if ($page < $counter - 1){ 
                 $setPaginate.= "<li><a href='{$page_url}page=$next'>Next</a></li>";
                 $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
             }else{
                 $setPaginate.= "<li class='active'><a class='current-page active'>Next</a></li>";
                 $setPaginate.= "<li class='active'><a class='current-page active'>Last</a></li>";
             }
    
             $setPaginate.= "</ul>\n";		
         }
     
     
         return $setPaginate;
     } 

     public static function lock($item){
        return base64_encode(base64_encode(base64_encode($item)));

     }

     public static function unlock($item){
        return base64_decode(base64_decode(base64_decode($item)));

     }

     public static function clean ($string){
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }

    
     public static function neat($str) {
        $str = str_replace(' ', '', $str); // Replaces all spaces with hyphens.
        // Remove all characters that are not letters, numbers, or spaces
        $cleanedStr = preg_replace('/[^A-Za-z0-9\s]/', '', $str);
        return $cleanedStr;
    }
    
     public static function timeago($datetime){
        $then = new DateTime($datetime);
        $now = new DateTime();
        $delta = $now->diff($then);
        
        $quantities = array(
            'year' => $delta->y,
            'month' => $delta->m,
            'day' => $delta->d
           );
        
        $str = '';
        foreach($quantities as $unit => $value) {
            if($value == 0) continue;
            $str .= $value . ' ' . $unit;
            if($value != 1) {
                $str .= 's';
            }
            $str .=  ', ';
        }
        $str = $str == '' ? 'a moment ' : substr($str, 0, -2);
        
        echo $str."  ago";
     }

     
     public static function datediff($startdate,$enddate){
       
        $start = new DateTime($startdate);
        $end = new DateTime($enddate);
        // otherwise the  end date is excluded (bug?)
        $end->modify('+1 day');

        $interval = $end->diff($start);

        // total days
        $days = $interval->days;

        // create an iterateable period of date (P1D equates to 1 day)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        // best stored as array, so you can add more than one
        $holidays =  Holiday::holidays();
       
        foreach($period as $dt) {
            $curr = $dt->format('D');

            // substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $days--;
            }

            // (optional) for the updated question
            elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }


        return $days;
     }

     public static function plusOneDay($date){
       
        $date1 = str_replace('-', '/', $date);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        
        return $tomorrow;
     }

     public static function checkPassword($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        $message = '';
    
        //return multiple conditions message
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            if(!$uppercase){
                $message .= "Password should contain at least one upper case letter. <br>";
            }
            if(!$lowercase){
                $message .= "Password should contain at least one lower case letter. <br>";
            }
            if(!$number){
                $message .= "Password should contain at least one number. <br>";
            }
            if(!$specialChars){
                $message .= "Password should contain at least one special character. <br>";
            }
            if(strlen($password) < 8){
                $message .= "Password should be at least 8 characters in length. <br>";
            }

            return $message;
        }else{
            return '';
        }
   
       
     }

     public static function houseOwner($propertyid) {
        global $healthdb;

        $query = "SELECT `ownerFullName` FROM `properties` WHERE `propertyId` = '$propertyid'";
        $healthdb->prepare($query);
        $result = $healthdb->fetchColumn();

        return $result;
     }

     public static function propertyClient($propertyid) {
        global $healthdb;

        $query = "SELECT `propertyName` FROM `properties` WHERE `propertyId` = '$propertyid'";
        $healthdb->prepare($query);
        $result = $healthdb->fetchColumn();
        return $result;
     }


     public static function displayImages($uuid) {
        global $healthdb;

        $getname = "SELECT `newname` FROM `documents` where `randomnumber` = '$uuid'";
        $healthdb->prepare($getname);
        $result = $healthdb->resultSet();
        if ($result) {
            $imagesHtml = '';
            foreach ($result as $results) { 
                $imagesHtml .= '<img class="enlarge-on-hover" src="' . URLROOT . '/uploads/' . htmlspecialchars($results->newname) . '" style="width:95px;height:100px">';
            }
            return $imagesHtml.'<br><small style="font-size:8px">Hover to enlarge</small>';
        }
        else {
            return "";
        }
       
       
    }

  /*   public static function getIpDetails()
    {
        $ip_address = ''; // Initialize IP address variable
    
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP']; // IP from share internet
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR']; // IP pass from proxy
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR']; // Remote IP address
        }
    
        // Query ipinfo.io to get IP address details (city, country, location)
        $details_json = file_get_contents("https://ipinfo.io/{$ip_address}/json");
        $details = json_decode($details_json);
    
        // Return IP details as an array
        return [
            'ip_address' => $ip_address,
            'city' => isset($details->city) ? $details->city : '',
            'country' => isset($details->country) ? $details->country : '',
            'location' => isset($details->loc) ? $details->loc : ''
        ];
    } */

    public static function logAction($message, $action)
    {
        //IP Details 
        //$ip_details = self::getIpDetails();

        // Create an instance of the Mac class to get the MAC address
        $mac = new Mac();
        $mac_address = $mac->getMacAddress();

        // Get current date and time
        $today = date("Y-m-d H:i:s");
    
        if (@$_SESSION['username'] == "") {
            @$username = $_POST['username'];
        } else {
            $username = $_SESSION['username'];
        }    
    
        // Prepare IP details for logging
        //$ip_info = "IP: {$ip_details['ip_address']}, City: {$ip_details['city']}, Country: {$ip_details['country']}, Location: {$ip_details['location']}";
    
        $l = new logs();
        $logs = &$l->recordObject;
        $logs->message = $message;
        $logs->logdate = date('Y-m-d H:i:s');
        $logs->username = $username;
        $logs->mac_address = $mac_address;
       /*  $logs->ip_address = $ip_details['ip_address'];
        $logs->ip_details = $ip_info; */
        $logs->action = $action;
        $l->store();
    }

    public static function emailVerified($email_verified)
    {
        if ($email_verified == '1') {
            return "<span style = 'color:green'>Verified</span>";
        } else {
            return "<span style = 'color:red'>Not Verified</span>";
        }
    }



    public static function columnExists($table, $column) {
        global $healthdb;
        $query = "SHOW COLUMNS FROM $table LIKE '$column'";
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
        return !empty($result);
    }



    public static function generateUUID() {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        return sprintf(
            '%08s-%04s-%04s-%04s-%12s',
            bin2hex(substr($data, 0, 4)),
            bin2hex(substr($data, 4, 2)),
            bin2hex(substr($data, 6, 2)),
            bin2hex(substr($data, 8, 2)),
            bin2hex(substr($data, 10, 6))
        );
    }

    
    public static function getUserPermissions($userId) {
        global $healthdb;

        $query = "SELECT `permission` FROM `permission` WHERE user_id = '$userId'";
        $healthdb->prepare($query);
        $result = $healthdb->resultSet();
    
        // Extract permissions into an array
        $permissions = array_map(function($record) {
            return $record->permission;
        }, $result);
    
        return $permissions;
    }

    public static function hasPermission($permissions, $requiredPermission) {
        return in_array($requiredPermission, $permissions);
    }


    public static function checkLoginAttempts($username) {
        global $healthdb;
    
        // Fetch the remaining attempts for the given username
        $getAttempt = "SELECT `attempts` FROM `users` WHERE `username` = '$username'";
        $healthdb->prepare($getAttempt);
        $result = $healthdb->fetchColumn();
    
        // Check if attempts are exhausted
        if ($result <= 0) {
            return [
                'status' => false,
                'message' => "<span class='label label-light-danger label-inline font-weight-bold'>
                    Account blocked due to multiple login attempts. Contact IT for assistance.
                </span>"
            ];
        } else {
            return [
                'status' => true,
                'message' => "<span class='label label-light-danger label-inline font-weight-bold'>
                    $result attempt(s) left
                </span>",
                'attempts' => $result
            ];
        }
    }
    


    public static function timeElapsed($datetime, $full = false) {
        $then = new DateTime($datetime);
        $now = new DateTime();
        $delta = $now->diff($then);
    
        if ($delta->y > 0) {
            $str = $delta->y . ' year' . ($delta->y > 1 ? 's' : '');
        } elseif ($delta->m > 0) {
            $str = $delta->m . ' month' . ($delta->m > 1 ? 's' : '');
        } elseif ($delta->d >= 7 && !$full) {
            $weeks = floor($delta->d / 7);
            $str = $weeks . ' week' . ($weeks > 1 ? 's' : '');
        } elseif ($delta->d > 0) {
            $str = $delta->d . ' day' . ($delta->d > 1 ? 's' : '');
        } elseif ($delta->h > 0) {
            $str = $delta->h . ' hour' . ($delta->h > 1 ? 's' : '');
        } elseif ($delta->i > 0) {
            $str = $delta->i . ' minute' . ($delta->i > 1 ? 's' : '');
        } else {
            $str = 'a moment';
        }
    
        return $str . ' ago';
    }


    public static function getDepartment($id) {
        global $healthdb;

        $getName = "SELECT `departmentName` FROM `companydepartments` WHERE `departmentId` = '$id'";
        $healthdb->prepare($getName);
        $result = $healthdb->fetchColumn();
        return $result;
    }

    public static function categoryName($categoryId) {
        global $healthdb;

        $getName = "SELECT `categoryName` FROM `propertycategory` WHERE `categoryId` = '$categoryId'";
        $healthdb->prepare($getName);
        $result = $healthdb->fetchColumn();
        return $result;
    }

    public static function decryptUserId($encryptedId, $secretKey) {
        $data = base64_decode($encryptedId);
        $iv = substr($data, 0, 16); 
        $ciphertext = substr($data, 16);
    
        $decrypted = openssl_decrypt($ciphertext, 'AES-256-CBC', $secretKey, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }
    
 
}

