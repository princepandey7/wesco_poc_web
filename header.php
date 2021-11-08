<?php

    // echo '<pre>';print_r($_SESSION);die;

    //ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    //ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');

    if(!isset($_SESSION)) 
    {
        session_start();
        $sessionId = session_id();
        
        $redis = new Redis();
        try {
            $redis->connect(REDIS_USERS, 6379);
            $redis->auth(REDIS_AUTH);
        } catch(Exception $e) {
           die( "Cannot connect to redis server:".$e->getMessage() );
        }

        $strRedisKey = "PHPREDIS_SESSION:".$sessionId;
        $arList = $redis->mGet([$strRedisKey]);
        // echo '<pre>';print_r($arList);die;

        // $string = $redis->get($strRedisKey);

        // $string = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $string);

        // $arList = json_decode($string,true);
        // echo '<pre>';print_r($arList);die;

        // echo $string;
        // die;
        // echo '<pre>';print_r($redis->get($strRedisKey));die;

        $arList = json_decode($redis->get($strRedisKey),true);

        if(!empty($arList)){
            $_SESSION['sso_status'] =  !empty($arList['sso_status']) ? $arList['sso_status'] : '';
            $_SESSION['token'] = !empty($arList['m_token']) ? $arList['m_token'] : '';
            $_SESSION['get_user_id'] = !empty($arList['m_user_name']) ? $arList['m_user_name'] : '';
            $_SESSION['user_email'] = !empty($arList['m_email']) ? $arList['m_email'] : '';
            $_SESSION['login_type'] = !empty($arList['login_type']) ? $arList['login_type'] : '';
        }else{
            session_destroy();
            unset($_SESSION);
        }
    }

    $strRequestUri = $_SERVER['REQUEST_URI'];   
    $strTest = explode('/', $strRequestUri );
    $getActiveUrl = end($strTest);
    $getUrlLists = explode('/', trim($strRequestUri,'/') );
    
    $checkUrl = true;
    // foreach($getUrlLists as $key => $getUrlList){
    //     if(strpos($getUrlList,".php")){
    //         $checkUrl = false;
    //         break;
    //     }
    // }
   
    if($checkUrl == false){
        
        header('Location: '. DIR .'not-found');
    }
	 
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  
  	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  
<div class="bs-example">
    <nav role="navigation" class="navbar  navbar-default custom-navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo DIR; ?>" class="navbar-brand"><h1>Wesco</h1></a>
            </div>
            <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <div class="nav navbar-nav navbar-right">
                   
                    <?php
                        $arrMenu = array('Home' => 'home', 'About' => 'about', 'Contact' => 'contact' );
                        
                        if(empty($_SESSION['get_user_id'])){
                            $arrMenu['Login'] = 'login';
                        } else {
                            $arrMenu['Product'] = 'product';
                            $arrMenu['My Account'] = 'my-account';

                            if(isset($_SESSION['login_type']) && (in_array($_SESSION['login_type'], ['mauth', 'msaml','oracle'])) ){
                                if($_SESSION['login_type'] == 'oracle'){
                                    $arrMenu['Logout'] = 'logout';
                                } else {
                                    $arrMenu['Logout'] = $_SESSION['login_type'].'_logout';    
                                }
                                
                            }
                        }

                    ?>
                    <ul class="btm-list">
                        <?php
                            foreach ($arrMenu as $key => $valueMenu) {
                                $activeClass = '';
                                
                                if( $getActiveUrl == $valueMenu || ( ( $getActiveUrl == '' ) && ( $valueMenu == 'index.php' ) ) ){
                                    $activeClass = 'active';
                                }
                                if(strtolower($key) == 'logout'){
                                    $strDisplayName = '';
                                    $strUrl = '';
                                    if(isset($_SESSION['get_user_id'])){
                                        $strDisplayName = $_SESSION['get_user_id'];
                                        $strUrl = 'mauth_logout.php';
                                        if($_SESSION['login_type'] == 'oracle'){
                                           $strUrl = 'logout.php'; 
                                       } else if($_SESSION['login_type'] == 'msaml'){
                                            $strUrl = $_SESSION['logout_url'];
                                        }
                                    }

                                    echo "<li class=". $activeClass ."><a href='". $strUrl ."'>". $key ."(". $strDisplayName .")</a></li>"; 
                                } else {
                                    echo "<li class=". $activeClass ."><a href='". DIR .$valueMenu .".php'>". $key ."</a></li>"; 
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>





