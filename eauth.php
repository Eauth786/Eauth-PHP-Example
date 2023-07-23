<?php
session_start();
define("ApplicationKey", "");
define("AccountKey", "");

define("e_url", "https://eauth.us.to/api/");
$Logged = null;
class eauth
{
    function __construct()
    {
        $this->Username = null;
        $this->Rank = null;
        $this->CreateDate = null;
        $this->ExpireDate = null;
        $this->Hwid = null;
        $this->Application_Name = null;
        $this->Logged = null;
        $this->Registered = null;
        $this->Disabled = null;
        $this->Status = null;
    }
private function z($sifr) 
{
    $altashfir = array("0","1","2","3","4","5","6","7","8","9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    $tabadal = array("-QZ-", "-SA-", "-IF-", "DE-", "-EE-", "-JJ-", "-GG-", "MP-", "-WI-", "-ZF-","-XC-", "-YU-", "-OL-", "MV-", "-RS-", "-EV-", "-WZ-", "DP-", "-IJ-", "-KN-", "-CA-", "-TW-", "-BI-", "-JH-", "-MW-", "-IS-", "-LA-", "-ME-", "-EP-", "-ON-", "-WK-", "-NB-", "-BA-", "-RE-", "-IN-", "-LU-");
    $wahid = str_replace($tabadal, $altashfir, $sifr);
    return $wahid;
} 
private function a($sifr) 
{
    $altashfir = array("0","1","2","3","4","5","6","7","8","9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    $tabadal = array("-QZ-", "-SA-", "-IF-", "DE-", "-EE-", "-JJ-", "-GG-", "MP-", "-WI-", "-ZF-","-XC-", "-YU-", "-OL-", "MV-", "-RS-", "-EV-", "-WZ-", "DP-", "-IJ-", "-KN-", "-CA-", "-TW-", "-BI-", "-JH-", "-MW-", "-IS-", "-LA-", "-ME-", "-EP-", "-ON-", "-WK-", "-NB-", "-BA-", "-RE-", "-IN-", "-LU-");
    $aithnayn = str_replace($altashfir, $tabadal, $sifr);
    return $aithnayn;
}
public function init()
{
    $fields = [
        's0rt'      => $this->a("e_init"),
        '111110'      => $this->a(ApplicationKey),
        '001011'      => $this->a(AccountKey)
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, e_url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    $result = curl_exec($ch);
    $z_result = $this->z($result);
    if ($z_result == "not_found")
    {
        echo('<div class="alert alert-danger" role="alert">
        Incorrect application details!
</div>');
    }
    else
    {
        $z_result = str_replace('[', '', $z_result);
        $z_result = str_replace(']', '', $z_result);
        $j_decode = json_decode($z_result);
        $this->Application_Name = $j_decode->{'APPNAME'};
        $this->Logged = $j_decode->{'LOGGED'};
        $this->Registered = $j_decode->{'REGISTERED'};
        $Disabled = $j_decode->{'PAUSED'};
        $Status = $j_decode->{'STATUS'};
        if ($Status != "1")
        {
            echo('<div class="alert alert-warning" role="alert">
            ' . $Disabled .'
    </div>');
        }
    }
}
public function signin(string $username, string $password)
{
    $password = hash("sha512", $password);
    $fields = [
        's0rt'      => $this->a("e_l0gin"),
        'username'      => $this->a($username),
        'passw0rd'      => $this->a($password),
        'appkey'      => $this->a(ApplicationKey),
        'acckey'      => $this->a(AccountKey)
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, e_url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    $result = curl_exec($ch);
    $z_result = $this->z($result);
    if ($z_result == "not_found")
    {
        echo('<div class="alert alert-danger" role="alert">
        Incorrect login details!
</div>');
return false;
    }
    else if ($z_result == "expired")
    {
        echo('<div class="alert alert-danger" role="alert">
        Your subscription has expired!
</div>');
return false;
    }
    else
    {
        $z_result = str_replace('[', '', $z_result);
        $z_result = str_replace(']', '', $z_result);
        $j_decode = json_decode($z_result);
        $this->Username = $j_decode->{'NAME'};
        $this->Rank = $j_decode->{'RANKUSER'};
        $this->CreateDate = $j_decode->{'CREATEDATE'};
        $this->ExpireDate = $j_decode->{'EXPIREDATE'};
        $this->Hwid = $j_decode->{'HWID'};
        $_SESSION['username'] = $this->Username;
        $_SESSION['rank'] = $this->Rank;
        $_SESSION['createdate'] = $this->CreateDate;
        $_SESSION['expiredate'] = $this->ExpireDate;
        $_SESSION['hwid'] = $this->Hwid;
        echo('<div class="alert alert-success" role="alert">
        ' . $this->Logged .'
</div>');
return true;
    }
}
public function signup(string $username, string $password, string $invite)
{
    $password = hash("sha512", $password);
    $fields = [
        's0rt'      => $this->a("e_register"),
        'username'      => $this->a($username),
        'passw0rd'      => $this->a($password),
        'invite'      => $this->a($invite),
        'appkey'      => $this->a(ApplicationKey),
        'acckey'      => $this->a(AccountKey)
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, e_url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    $result = curl_exec($ch);
    $z_result = $this->z($result);
    if ($z_result == "used")
    {
        echo('<div class="alert alert-danger" role="alert">
        Username already used!
</div>');
    }
    else if ($z_result == "upgrade")
    {
        echo('<div class="alert alert-warning" role="alert">
        The Application reached maximum users, it\'s time for an upgrade!
</div>');
    }
    else if ($z_result == "not_found")
    {
        echo('<div class="alert alert-danger" role="alert">
        Key not found!
</div>');
    }
    else if ($z_result == "incorrect")
    {
        echo('<div class="alert alert-danger" role="alert">
        Incorrect register details!
</div>');
    }
    else
    {
        echo('<div class="alert alert-success" role="alert">
        ' . $this->Registered .'
</div>');
    }
}
public function grabVariable(string $varid)
{
    $fields = [
        's0rt'      => $this->a("var"),
        'varid'      => $this->a($varid),
        'appkey'      => $this->a(ApplicationKey),
        'acckey'      => $this->a(AccountKey)
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, e_url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    $result = curl_exec($ch);
    $z_result = $this->z($result);
    if ($z_result == "var_not_found")
    {
        $varesponse = ">_<";
    }
    else if ($z_result == "incorrect_application_details")
    {
        die();
    }
    else
    {
        $varesponse = $z_result;
    }
    return $varesponse;
}
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
