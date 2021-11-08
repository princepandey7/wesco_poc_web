    <?php
    session_start();
    $sessionId = session_id();
    require_once("web_admin/db.php");
    $fullName =  $email_create = $passWord = $phoneNo = $content = $adminTxt = "";
    $fullNameErr =  $email_createErr = $passWordErr = $phoneNoErr = "";

    $date = date('Y-m-d H:i:s');
    $error1 = 0;
    $random = md5(uniqid(rand(), true));
    $password = $_POST['password'];
    $fullName = $_REQUEST['first_name'] .' '. $_REQUEST['last_name'];
    //Insert Category
    $catCol = array( 'user_full_name' => $fullName, 'user_email'=>$_REQUEST['email_create'],'user_phone_no'=>$_REQUEST['mobile_number'], 'user_password'=>$password, 'user_random_code'=>$random, 'user_type'=>'Customer', 'user_status'=>'Active', 'user_created_date'=>$date);

    $connection->InsertQuery("user", $catCol); 
    // $lastId = $connection->lastInsertId();

    $smtpQuery = $connection->OneRow("*","smtp_settings");
    $adminEmailQuery = $connection->OneRow("*","email_settings");

    /****** USER EMAIL ******/

    $emailQuery = $connection->OneRowCondition("*","email_content","email_type='Register'");

    $recipients = explode(",", $emailQuery['email_bcc']);

    $content .= "<html><body style='background:#e6e7e8; padding:15px 0'><table width='700' border='0' align='center' cellpadding='1' cellspacing='1' style='font-family:Verdana, Geneva, sans-serif; color:#000; border-right:2px solid #d4d5d5; border-bottom:2px solid #d4d5d5;'>  <tr><td valign='top' bgcolor='#FFFFFF'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>  <td height='90' style='padding:0 15px; border-bottom:3px solid #b1904d;'><img src='".DIR."assets/images/loginpages/login_logo.png' border='0' alt='Holistique Learning' title='Holistique Learning'/></td></tr><tr><td style='padding:15px;'>";

    $userContent = $emailQuery['email_content'];
    $userContent = str_replace("~email~", $_REQUEST['email_create'], $userContent);
    $userContent = str_replace("~password~", $password, $userContent);

    $content .= $userContent;

    $strClientSignature = str_replace('emailer', DIR .'/assets/images/homepage' , $emailQuery['email_signature']);

    $content .="</td></tr><tr> <td height='25' valign='middle'>". $strClientSignature  ."</td></tr></table></td>  </tr></table></body></html>";
    $content .="</td></tr></table></td>  </tr></table></body></html>";

    $to = $_REQUEST['email_create'];
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Wesco<noreply@wesco.com>' . "\r\n";
    // mail($to,$emailQuery['email_subject'],$content,$headers);

    /****** ADMIN EMAIL ******/

    $emailAdminQuery = $connection->OneRowCondition("*","email_content","email_type='Admin Register'");

    $adminTxt .= "<html><body style='background:#e6e7e8; padding:15px 0'><table width='700' border='0' align='center' cellpadding='1' cellspacing='1' style='font-family:Verdana, Geneva, sans-serif; color:#000; border-right:2px solid #d4d5d5; border-bottom:2px solid #d4d5d5;'>  <tr><td valign='top' bgcolor='#FFFFFF'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>  <td height='90' style='padding:0 15px; border-bottom:3px solid #b1904d;'><img src='".DIR."assets/images/loginpages/login_logo.png' border='0' alt='Holistique Learning' title='Holistique Learning'/></td></tr><tr><td style='padding:15px;'>";

    $adminContent = $emailAdminQuery['email_content'];
    $adminContent = str_replace("~email~", $_REQUEST['email_create'], $adminContent);
    $adminContent = str_replace("~phoneNo~", $_REQUEST['mobile_number'], $adminContent);

    $adminTxt .= $adminContent;
    $strAdminSignature = str_replace('emailer', DIR .'/assets/images/homepage' , $emailAdminQuery['email_signature']);

    $adminTxt .="</td></tr><tr> <td height='25' valign='middle'>". $strAdminSignature ."</td></tr></table></td>  </tr></table></body></html>";
    $adminTxt .="</td></tr></table></td>  </tr></table></body></html>";


    // $adminAddress = explode(",", $adminEmailQuery['email_address']);
    $adminEmail = $adminEmailQuery['email_address'];
    $adminHeaders = "MIME-Version: 1.0" . "\r\n";
    $adminHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $adminHeaders .= 'From: Wesco<noreply@wesco.com>' . "\r\n";
    // $retval = mail($adminEmail,$emailAdminQuery['email_subject'],$adminTxt,$adminHeaders);

    //Insert Log
    $log = "user_full_name ~ ".$_REQUEST['email_create']." ~ ".$lastId."";
    $logCol = array('log_changes'=>$log, 'log_user'=>$lastId, 'log_table'=>'user', 'log_action'=>'Insert',  'log_created_date'=> $date);
    $connection->InsertQuery("changes_log", $logCol);
    echo 1;