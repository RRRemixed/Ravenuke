<?php

// how many newest members to show
$recent_member_count = 2;
// show online guests IP in online list
$show_guest_list = true;
// how long before inactive uses are dropped from online list
$max_session_mins = 10;
// maximum number of guests to display
$max_display_guests = 5;
// maximum number of members to display
$max_display_members = 10;
// notify users of private message by using a javascript drop box
$pm_notify_dropin = true;
// if set to true, users will only be notified of private messages once per visit
$pm_dropin_once = false;
// set the colors for the dropin box
$dropin_bgcolor = '#EEEEEE';
$dropin_bordercolor = '#4C44BA';


if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}

global $db, $prefix, $user_prefix, $user, $sitekey, $gfx_chk, $admin;

$content = '
<!-- Start Info -->
<table width="100%">
';

// get user info/show login
if (is_user($user))
{
  $uinfo = cookiedecode($user);
  
  $content .= '<tr><td style="border-bottom: 1px dotted #CCCCCC; padding-bottom: 4px; padding-top: 4px;" title="Hello '. $uinfo[1] .'">
  <a href="modules.php?name=Your_Account&amp;op=edituser" style="text-decoration: none" title="Edit Account Info"><img src="images/info/user.png" alt="" style="border: 0px;"> <span style="font-size: 14px;"><strong>'. $uinfo[1] .'</strong></span></a><br />';
  $content .= '<div>';
  $content .= '<img src="images/info/your_ip.png" alt="">  <strong>'. $_SERVER['REMOTE_ADDR'] .'</strong><br />';
  $content .= '<a href="modules.php?name=Forums&amp;file=search&amp;search_id=egosearch" style="text-decoration: none" title="View Your Forum Posts"><img src="images/info/your_posts.png" alt="" style="border: 0px;"> <strong>Your Forum Posts</strong></a><br />';
  $content .= '<a href="modules.php?name=Your_Account&amp;op=logout" style="text-decoration: none" title="Logout"><img src="images/info/logout.png" alt="" style="border: 0px;"> <strong>Logout</strong></a>';
  $content .= '</div></td></tr>';
  
  // check new pms
  $sql = "SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='". intval($uinfo[0]) ."' AND (privmsgs_type='5' OR privmsgs_type='1')";
  if ( !($result = $db->sql_query($sql)) )
  {
    // error
    die('error checking new pms');
  }
  $new_pms = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  
  // check old pms
  $sql = "SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='". intval($uinfo[0]) ."' AND (privmsgs_type='0')";
  if ( !($result = $db->sql_query($sql)) )
  {
    // error
    die('error checking old pms');
  }
  $old_pms = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  
  $content .= '
  <tr>
  <td style="border-bottom: 1px dotted #CCCCCC; padding-bottom: 4px; padding-top: 4px;">
  <img src="images/info/pms.png" alt=""> <strong>Your Messages:</strong><br />
  <div style=" ">
  <img src="images/info/new_pms.png" alt=""> Unread: <a href="modules.php?name=Private_Messages"><strong>'. $new_pms .'</strong></a><br />';
  if ($pm_notify_dropin && $new_pms > 0)
  {
    $content .= '
    <script type="text/javascript" language="JavaScript1.2">
    
    // Drop-in content box- By Dynamic Drive
    // For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
    // This credit MUST stay intact for use
    
    var ie=document.all
    var dom=document.getElementById
    var ns4=document.layers
    var calunits=document.layers? "" : "px"
    
    var bouncelimit=32 //(must be divisible by 8)
    var direction="up"
    
    function initbox(){
    if (!dom&&!ie&&!ns4)
    return
    crossobj=(dom)?document.getElementById("dropin").style : ie? document.all.dropin : document.dropin
    scroll_top=(ie)? truebody().scrollTop : window.pageYOffset
    crossobj.top=scroll_top-250+calunits
    crossobj.visibility=(dom||ie)? "visible" : "show"
    dropstart=setInterval("dropin()",50)
    }
    
    function dropin(){
    scroll_top=(ie)? truebody().scrollTop : window.pageYOffset
    if (parseInt(crossobj.top)<100+scroll_top)
    crossobj.top=parseInt(crossobj.top)+40+calunits
    else{
    clearInterval(dropstart)
    bouncestart=setInterval("bouncein()",50)
    }
    }
    
    function bouncein(){
    crossobj.top=parseInt(crossobj.top)-bouncelimit+calunits
    if (bouncelimit<0)
    bouncelimit+=8
    bouncelimit=bouncelimit*-1
    if (bouncelimit==0){
    clearInterval(bouncestart)
    }
    }
    
    function dismissbox(){
    if (window.bouncestart) clearInterval(bouncestart)
    crossobj.visibility="hidden"
    }
    
    function truebody(){
    return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
    }
    
    
    function get_cookie(Name) {
    var search = Name + "="
    var returnvalue = ""
    if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search)
    if (offset != -1) {
    offset += search.length
    end = document.cookie.indexOf(";", offset)
    if (end == -1)
    end = document.cookie.length;
    returnvalue=unescape(document.cookie.substring(offset, end))
    }
    }
    return returnvalue;
    }
    
    function dropornot(){';
  if ($pm_dropin_once)
  {
    $content .= '
    if (get_cookie("droppedin")==""){
    window.onload=initbox
    document.cookie="droppedin=yes"
    }';
  }
  else
  {
    $content .= '
    window.onload=initbox
    
    ';
  }
  $content .= '
    }
    dropornot()
    </script>
    ';
    $content .= '
    <div id="dropin" style="position:absolute;visibility:hidden;left:400px;top:100px;width:300px;height:100px;background-color:'.$dropin_bgcolor.';border: 1px solid '.$dropin_bordercolor.'">
    
    <div align="right"><a href="#" onClick="dismissbox();return false">[Close Box] </a></div>
    <br />
    <a href="messages.html" onClick="dismissbox();">You have <strong>'. $new_pms .'</strong> new Private Messages.</a>
    
    </div>
    ';
  }
  $content .= '
  <img src="images/info/old_pms.png" alt=""> Read: <strong>'. $old_pms .'</strong><br />
  </div>
  </td>
  </tr>
  ';
    
  
}
else
{
  $content .= '
  <tr>
  <td style="border-bottom: 1px dotted #CCCCCC; padding-bottom: 4px; padding-top: 4px;">
  <a href="modules.php?name=Your_Account" style="text-decoration: none" title="Login or Register"><img src="images/info/user.png" alt="" style="border: 0px;"> <span style="font-size: 14px;"><strong>Anonymous</strong></span></a><br />';
  $content .= '<div style="" title="Your Ip Address">';
  $content .= '<img src="images/info/your_ip.png" alt="">  <strong>'. $_SERVER['REMOTE_ADDR'] .'</strong><br /></div>
  
  <form action="modules.php?name=Your_Account" method="post">
  '. _NICKNAME .':<br />
  <input type="text" name="username" value="" size="15" maxlength="25" /><br />
  '. _PASSWORD .':<br />
  <input type="password" name="user_password" size="15" maxlength="20" /><br />
  ';
  // see if security code is enabled
  if (extension_loaded('gd') && ($gfx_chk == 2 || $gfx_chk == 4 || $gfx_chk == 5 || $gfx_chk == 7))
  {
    mt_srand ((double)microtime()*1000000);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    
    $content .= '
    '. _SECURITYCODE .':<br />
    <img src="?gfx=gfx&amp;random_num='. $random_num .'" alt="'. _SECURITYCODE .'" /><br />
    '. _TYPESECCODE .':<br />
    <input type="text" name="gfx_check" value="" size="6" maxlength="6" /><br />
    <input type="hidden" name="random_num" value="'. $random_num .'" />
    ';
  }
  else
  {
    $content .= '<br />
    <input type="hidden" name="random_num" value="'. $random_num .'">
    <input type="hidden" name="gfx_check" value="'. $code .'">';
  }
  
  $content .= '
  <br />
  <input type="hidden" name="op" value="login" />
  <input type="submit" name="login" value="'. _LOGIN .'" /> 
  <input type="button" onclick="parent.location=\'modules.php?name=Your_Account&amp;op=new_user\'" name="'. _BREG .'" title="'. _BREG .'" value="'. _BREG .'" />
  </form>
  </td></tr>';
}




$content .= '
<tr>
<td style="border-bottom: 1px dotted #CCCCCC; padding-bottom: 4px; padding-top: 4px;">
<img src="images/info/members.png" alt=""> <strong>User Stats:</strong>
<br />
';
// get new member info
$timestamp = time();
$today = date("M d, Y");
$yesterday = date("M d, Y", ($timestamp - 86400) );
$this_month = date("M");
$this_year = date("Y");

// today
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE user_regdate='$today'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting todays users');
}
list($new_today) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

// yesterday
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE user_regdate='$yesterday'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting yesterdays users');
}
list($new_yesterday) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

// this month
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE SUBSTRING(user_regdate, 1, 4)='$this_month' AND SUBSTRING(user_regdate, 9, 12)='$this_year'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting this months users');
}
list($new_month) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

// this year
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE SUBSTRING(user_regdate, 9, 12)='$this_year'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting this years users');
}
list($new_year) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

// all time
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting total users');
}
list($total_users) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$content .= '
<div style="">
<img src="images/info/today.png" alt=""> Today: <strong>'. $new_today .'</strong><br />
<img src="images/info/yesterday.png" alt=""> Yesterday: <strong>'. $new_yesterday .'</strong><br />
<img src="images/info/month.png" alt=""> This Month: <strong>'. $new_month .'</strong><br />
<img src="images/info/year.png" alt=""> This Year: <strong>'. $new_year .'</strong><br />
<img src="images/info/total_users.png" alt=""> Total Users: <strong>'. $total_users .'</strong><br />
</div>
</td>
</tr>
';

// get newest member(s)
$sql = "SELECT username FROM ". $user_prefix ."_users ORDER BY user_id DESC LIMIT ". intval($recent_member_count);
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting latest users');
}
$content .= '
<tr>
<td style="border-bottom: 1px dotted #CCCCCC; padding-bottom: 4px; padding-top: 4px;">
<img src="images/info/new_users.png" alt=""> <strong>New';
$content .= $recent_member_count > 1 ? ' Members:</strong><br />' : 'est Member:</strong><br />';

while( $row = $db->sql_fetchrow($result) )
{
  $content .= '
  <div style="padding-left: 12px;">
  <img src="images/info/member_new.png" alt=""> <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$row['username'].'" title="View Profile: '.$row['username'].'">'.$row['username'].'</a>
  </div>
  ';
  // comment the 5 lines above and uncomment the 5 lines below to use the google tapped link
  //$content .= '
  //<div style="padding-left: 12px;">
  //<img src="images/info/member_new.png" alt=""> <a href="userinfo-'.$row['username'].'.html" title="View Profile: '.$row['username'].'">'.$row['username'].'</a>
  //</div>
  //';
}
$db->sql_freeresult($result);
$content .= '</td></tr>';


// show whos online
$members = '';
$guests = '';
$m = $g = 0;
$sql = "SELECT uname, time, host_addr, guest FROM ". $prefix ."_session WHERE time > '".( time() - ($max_session_mins * 60) )."' ORDER BY guest ASC,time DESC";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting online users');
}
$content .= '
<tr>
<td style="border-bottom: 1px dotted #CCCCCC; padding-bottom: 4px; padding-top: 4px;">
<img src="images/info/members.png" alt=""> <strong>Online Now:</strong>
<br />';

while( $row = $db->sql_fetchrow($result) )
{
  if ($row['guest'] == 0)
  {
    $m++;
    if ($m <= $max_display_members)
    {
      $members .= '
      <div style="padding-left: 12px;">
      <img src="images/info/online.png" alt=""> <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$row['uname'].'" title="View Profile: '.$row['uname'].'">'.$row['uname'].'</a>
      </div>
      ';
      // comment the 5 lines above and uncomment the 5 lines below to use the google tapped link
      //$members .= '
      //<div style="padding-left: 12px;">
      //<img src="images/info/online.png" alt=""> <a href="userinfo-'.$row['uname'].'.html" title="View Profile: '.$row['uname'].'">'.$row['uname'].'</a>
      //</div>
      //';
    }
  }
  else
  {
    $g++;
    if ($show_guest_list && $g <= $max_display_guests)
    {
      if (is_admin($admin))
      {
        $uname = $row['uname'];
      }
      else
      {
        // hide last 2 octets of guest ip's.
        $ip = explode('.', $row['uname']);
        $uname = $ip[0].'.'.$ip[1].'.'.ereg_replace("[0-9]", "x", $ip[2]).'.'.ereg_replace("[0-9]", "x", $ip[3]);
      }
      $guests .= '
      <div style="padding-left: 12px;">
      <img src="images/info/online_guest.png" alt=""> '.$uname.'
      </div>
      ';
    }
  }
}
$db->sql_freeresult($result);
if ($m > 0)
{
  $content .= '
  &nbsp; <em>Members</em>: <strong>
  '. $m .'</strong><br />
  '.$members.'<br />';
}

if ($g > 0)
{
  $content .= '
  &nbsp; <em>Guests</em>: <strong>
  '. $g .'</strong><br />
  '.$guests.'<br />';
}



$content .= '
&nbsp; <em>Total Online</em>: <strong>
  '. ($m + $g) .'</strong><br />
</td></tr>';

// change the date/time format below, php.net/date
$content .= '
<tr><td>
<img src="images/info/time.png" alt=""> <strong>Server Time:</strong><br />
<div style="padding-left: 18px;">
'. date('M d, Y <b\r /> h:i a T').'
</div>
</td></tr>
';

$content .= '
</table>
<!-- END Info -->';



?>
