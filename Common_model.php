<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Handles admin functions.
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Models
 * @author
 */

// ------------------------------------------------------------------------

class Common_model extends CI_Model {
	//private $ci; // CI Instance
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->ci = &get_instance();
        //$this->ci->load->library('email');
		//$this->ci->load->config('email');
       // $this->ci->email->initialize($this->ci->config->item('email'));
		$this->load->library('email');
	}
	 
	function safe_html($input_field)
	{ 
		return htmlspecialchars(trim(strip_tags($input_field)));
	}
	
	function safe_sql($input_field)
	{ 
		//return @mysqli_real_escape_string(trim(strip_tags($input_field)));
		return $this->db->escape_str(trim(strip_tags($input_field)));
	}
	
	function get_post_url()
	{
		$postURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$postURL .= "s";}
		$postURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$postURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$postURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $postURL;
	}
	function generateRandomString($length = 6) {
   // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
		/**
	 * get the config value
	 *
	 * @return unknown
	 */
	function get_config_item($conf_name){				
		$query = $this->db->query("SELECT config_value FROM ".$this->db->dbprefix."site_configuration WHERE config_name='".$conf_name."'");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			if($row->config_value){
				return $row->config_value;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	/**
	 * get the config value
	 *
	 * @return unknown
	 */
	function get_config_script($conf_name){				
		$query = $this->db->query("SELECT config_text FROM ".$this->db->dbprefix."site_configuration WHERE config_name='".$conf_name."'");
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			if($row->config_text){
				return $row->config_text;			
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	

	function getemail(){

		$html ="<html lang='en'>
<head>
  <meta charset='utf-8'> 
	<meta name='viewport' content='width=device-width'> 
	<meta http-equiv='X-UA-Compatible' content='IE=edge'> 
  <title></title>
   <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'> 
  <style type='text/css'>

@font-face {font-family:'Rubik',sans-serif;        font-style:normal;        font-weight:400;        src:local(Rubik),local(Rubik),url(https://fonts.googleapis.com/css?family=Rubik:400,500,700) format('woff');}
		html,body{
			margin:0;
			padding:0;
			height:100% !important;
			font-family:'Rubik',sans-serif;
			width:100% !important;
		}
		body,td,input,textarea,select{
			font-family:'Rubik',sans-serif;
		}
		p,h1,h2,h3{
			font-family:'Rubik',sans-serif;
		}
		.emailContent{
			font-family:'Rubik',sans-serif;
		}
		
		td.stack-column-center {
          background: #636363;
		  }
		    .footer{  background: #636363;}
		
	
		* {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}
		

		.ExternalClass {
			width: 100%;
		}  
		

		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}
		

    table {
			border-spacing:0 !important;
    }

		.ExternalClass,
		.ExternalClass * {
    	line-height: 100%;
		}
		
		table {
		  border-collapse: collapse;
		  margin: 0 auto;
		}
	
		img {
			-ms-interpolation-mode:bicubic;
		}
		

    .yshortcuts a {
			border-bottom: none !important;
    }

    .mobile-link--footer a {
	    color: #666666 !important;
    }
    
	
		img {
			border:0 !important;
			outline:none !important;
			text-decoration:none !important;
		}
		img.social-icon {
    width: 25px;
    padding-left: 5px;
}
 img.footer-logo {
    			width: 100px;
				}

		/* Media Queries */
    @media screen and (max-device-width: 600px), screen and (max-width: 600px) {
			
			
			.email-container {
				width: 100% !important;
			}

			
			img[class='fluid'],
			img[class='fluid-centered'] {
				width: 100% !important;
				max-width: 100% !important;
				height: auto !important;
				margin: auto !important;
			}
			
			img[class='fluid-centered'] {
				margin: auto !important;
			}

			
			td[class='stack-column'],
			td[class='stack-column-center'] {
				display: block !important;
				width: 100% !important;
				direction: ltr !important;
			}
		
			td[class='stack-column-center'] {
				text-align: center !important;
			}
 
 			
 			td[class='data-table-th'] {
	 			display: none !important;
 			}
 			
 			td[class='data-table-td'],
 			td[class='data-table-td-title'] {
				display: block !important;
				width: 100% !important;
				border: 0 !important;
 			}
 			
 			td[class='data-table-td-title'] {
	 			font-weight: bold;
	 			color: #333333;
				padding: 10px 0 0 0 !important;
	 			border-top: 2px solid #eeeeee !important;
 			}
 			
 			td[class='data-table-td'] {
				padding: 5px 0 0 0 !important
 			}
 			/* What it does: Provides a visual divider between table rows. In this case, a bit of extra space. */
 			td[class='data-table-mobile-divider'] {
				display: block !important;
				height: 20px;
 			}
			img.social-icon {
    			width: 19px;
   			 padding-left: 5px;}
			 img.footer-logo {
    			width: 100px;
				}
				.shop-buttoncx { width: 70%;}
	
 			/* END Data Table Styles */

		}
		          
  </style>
</head>
<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' bgcolor='#f9f9f9' style='margin:0; padding:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;'>
<table cellpadding='0' cellspacing='0' border='0' height='100%' width='100%' bgcolor='#f9f9f9' style='border-collapse:collapse;'>
<tr>
<td>



  <!-- Email wrapper : BEGIN -->
  <table border='0' width='600' cellpadding='0' cellspacing='0' align='center' style='width:600px; margin: auto;' class='email-container'>
    <tr>
    	<td>

        <!-- Logo + Links : BEGIN -->
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
        
          <tr>
            <td valign='middle' width='150' style='padding:5px 0; text-align:left; line-height: 1;background: #262626;' class='stack-column-center'>
           <!--    <img src='img/logo.png' alt='alt text' width='150' height='' border='0' style='display: block; margin: auto; padding-bottom:15px;padding-top:15px;'> -->
           <img alt='' src='http://eficaztechsol.com/Libeloc/img/logo_libe.png' style='height:auto; width:190px;display: block; margin: auto; padding-bottom:15px;padding-top:15px;' />
            </td>
            
          </tr>
          
        
        </table>
        <!-- Logo + Links : END -->
        
        <table  border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#ffffff;' class='second-div'>
        <tr valign='middle' align='center'> 
        <td><h2 style='text-align:center;background: #fff;margin: 0;padding: 35px 0 35px;color: #11dcca;line-height: 38px;font-size: 24px;'></h2>
        </td></tr>
        </table>
  
        <!-- Main Email Body : BEGIN -->
        <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#ffffff'>
      
           <tr>
            <td style='padding: 0 60px 0; font-size: 14px; line-height: 1.7; color: #A7A9AC;'>
		Dear ABC ,
        </td>
          </tr>
          <tr>
            <td style='padding: 4%;  font-size: 19px; line-height: 1.7; color: #A7A9AC; text-align:center;'>
				Your booking ref no. is 112 .The request for activity on date is in process subject to acceptance by the provider.
 
     	  </td>
          </tr>
            
          <!-- Full Width, Fluid Column : BEGIN -->
          <tr>
            <td style=' font-size: 14px; line-height: 1.7; color: #A7A9AC; text-align:center;    padding: 0 60px 0;'>

			
        
			</td>
          </tr>
          <!-- Full Width, Fluid Column : END -->
              
       <tr>
       <td style='font-size: 13px;line-height: 1.7;color: #11dcca;text-align: center;font-weight: 600; padding: 0 60px 25px;'>
        *Thanking you for choosing LIBE.
       </td>
       </tr>
	    <tr>
       <td style='font-size: 13px;line-height: 1.7;color: #11dcca;text-align: center;font-weight: 600; padding: 0 60px 25px;'>
        *This is an automated email.Please DONOT respond to this email,this mailbox is not monitored.  
       </td>
       </tr>
        </table>
        <!-- Main Email Body : END -->
        
      </td>
		</tr>
    
    <!-- Footer : BEGIN -->

  </table>
  <!-- Email wrapper : END -->

</td>
</tr>
</table>
</body>
</html>";

return $html;

	}


	function getemailBodycommon($Username,$Password,$Name){

		$html = '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:800px;margin:0 auto;background-color:#fff;border-collapse:collapse;">
 	<tr>
 		<td class="m_-855868515962414057desktop-block" align="left" valign="top" style="padding-top:10px;padding-bottom:0"> 
          <table style="min-width:100%;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%"> 
            <tbody> 
              <tr> 
                <td align="center" colspan="2" style="text-align:center" class="m_-855868515962414057desktop-block"> 
                    <div style="text-align:center;font-size:13px;color:rgb(51,51,51);padding-bottom:10px;border:0;background-color:#fff" class="m_-855868515962414057disclaimer m_-855868515962414057mobile-disclaimer">
                    </div>
                 </td>
              </tr>
            </tbody>
           </table> 
          </td>
 	</tr>
 	<tr>
 	<td align="center" valign="top" style="padding-top:0;padding-bottom:0;background-color:#3282c9;"> 
       <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#3282c9;border-collapse:collapse;color:white">
 	<tbody>
 	 <tr>
	  <td style="padding:22px 0px 0px 0px; text-align: center; font-weight: bold;font-size: 36px;margin-top:30px">
 	<img src="'.base_url().'files_upload/themesettings/main.png" style="width:20%;">
 	</td>
	 </tr>
	 <tr>
	  <td style="padding:22px 0px 0px 0px; text-align: center; font-weight: bold;font-size: 36px;margin-top:30px">
	   GET XCCELERATED !!!
	  </td>
	 </tr>
	  <tr>
		<td style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:26px;text-align:center">
			Dear '.$Name.',
		</td>
	</tr>
	<tr>
		<td style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:26px;text-align:center">
			Welcome to Xccelerate , workplace training delivered from the cloud
		</td>
	</tr>
	<tr>
		<td style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:26px;text-align:center">
			An account has been created for you, the login details are
		</td>
	</tr>
	 <tr>
		<td style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:26px;text-align:center">
			  Username :'.$Username.'
		</td>
	</tr>
	 <tr>
		<td style="color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:26px;text-align:center">
			  Password :'.$Password.'
		</td>
	</tr>
	<tr>
		<td style="padding:44px 10px 40px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:26px;text-align:center">
			Click here to access Xccelerate <a href="'.base_url().'" align="left" bgcolor="#B13DAC" style="border-radius:40px;display:block;text-align:center;width:200px;margin:0 auto;padding:15px 0px;font-size:17px;background-color:#fff;text-decoration: none;">Login</a>
		</td>
	</tr>
	 <tr>
	  <td>
	 <img src="'.base_url().'/assets/images/RegisterforCourses_Graphic_v3.jpg" style="width: 800px;">
	  </td>
	  </tr>
	  
	 <tr>
		<td style="text-align: center"> 
			You have recieved this email because you are a user of the Xccelerate platform
		</td>
	</tr>


 </tbody>
</table>

</td>
</tr>
</table>';
					

		return $html;

	}


function getemailBody($CategoryID,$CreateUser,$IsActive)
	{
		$this->db->select('*');
		$this->db->from('emailtemplates');
		$this->db->where('CategoryID',$CategoryID);
		$this->db->where('CreateUser',$CreateUser);
		if($IsActive)
		$this->db->where('IsActive',1);
		$result=$this->db->get();
		if($result->num_rows()>0)
		{
			
		    return $result->row()->Body;	
		}else
		{
			
			return false;
		}

	}
	function getPdfBody($CategoryID,$CreateUser,$IsActive)
	{
		$this->db->select('*');
		$this->db->from('pdftemplates');
		$this->db->where('CategoryID',$CategoryID);
		$this->db->where('CreateUser',$CreateUser);
		if($IsActive)
		$this->db->where('IsActive',1);
		$result=$this->db->get();
		if($result->num_rows()>0)
		{
			
		    return $result->row()->Body;	
		}else
		{
			
			return false;
		}

	}
	function process_send_mail  ($email, $email_array, $title = '' ,$from_name ='',$from='',$attachment=array())
	{
		$values_array		= array ();			
		$result_array       = $this->common_model->get_mail_content_and_title ($title);
		foreach ($result_array as $key=>$value)
		{
			$mail_subject   = $key;
			$email_body     = $value;
		}
		$matches            = array();
		preg_match_all("/\{\%([a-z_A-Z0-9]*)\%\}/",$email_body, $matches);
		$variables_array    = $matches[1];
	
		if (count($variables_array) > 0) 
		foreach (@$variables_array as $key)
		{
			@$values_array[] = @$email_array[$key];
		}
	
		$new_variables_array    = array();
		foreach($variables_array as $variable)
		{
			$new_variables_array[] = '/\{\%'.$variable.'\%\}/';
		}
		$body_content ='';
		$body_content .= preg_replace ($new_variables_array, $values_array, $email_body);		
		
		if ($this->common_model->send_mail($email,$from_name, $mail_subject, $body_content,array(),$from))
			return TRUE;
		else
			return FALSE;
		
	}

// function send_mail($to_email='', $from='', $subject, $message,$from_mailname='', $attachment = array(),  $cc=array(), $bcc=array(), $batch_mode=false, $batch_size=200)
// 	{

// 			$from=$_SESSION['companyEmail'];
// 			$from_mailname=$_SESSION['CompanyName'];
			


// 			if(!empty($attachment)){
					
// 					    $content = file_get_contents($attachment[0]);
// 						//$content = chunk_split(base64_encode($content));
// 						$filename=pathinfo(	$attachment[0]);
// 						$filename=$filename['basename'];
// 						// a random hash will be necessary to send mixed content
// 						$separator = md5(time());
					
						
						
// 						$headers = "From: ".$from_mailname." <".$from.">";
// 						//$semi_rand = md5(time());
// 						$mime_boundary = "==Multipart_Boundary_x{$separator}x";
					
// 						$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
					
// 						$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
					
// 						$message .= "--{$mime_boundary}\n";
// 						$attachment = chunk_split(base64_encode($content));
// 						//$subject = "Invoice $InvoiceID from Green Cross Training Ltd";
					
// 						$message .= "Content-Type: application/octet-stream; name=\"$filename\"\n" . "Content-Disposition: attachment;\n" . " filename=\"$filename\"; \n" . "Content-Transfer-Encoding: base64\n\n" . $attachment . "\n\n";
					
// 						$message .= "--{$mime_boundary}--";
// 						$returnpath = "-f" . $from;
					
// 						$mail =mail($to_email, $subject, $message, $headers, $returnpath);
// 						if($mail)
// 						{
// 						  return true;
// 						 }
// 						else
// 						{
// 						  return false;
// 						}
						
// 					}else{
// 					$headers  = 'MIME-Version: 1.0' . "\r\n";
// 					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// 					$headers .= 'From: '.$from_mailname.' <'.$from.'>' . "\r\n";
// 					$headers .= "Reply-To: ".$from."\r\n";
// 					$headers .= "Return-Path: ".$from."\r\n";
// 					$body=$message;
// 					}
// 					if(mail($to_email,$subject,$body,$headers))
// 					{
// 					  return true;
// 					 }
// 				 	else
// 					{
// 					  return false;
// 					}
		
// 	}


function send_mail($to_email, $subject, $message, $attachment = '',$fileName='', $cc=array(), $bcc=array(), $batch_mode=false, $batch_size=200)
	{
			
			$from='noreply@greencrosstraining.com';//$_SESSION['companyEmail'];
			$from_mailname='Greencross';//$_SESSION['CompanyName'];
			
				$this->load->library('email');
				$body=$message;
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					$this->email->from($from, $from_mailname);
					$this->email->to($to_email);
					$this->email->subject($subject);
					$this->email->message($body, $headers);
					if(!empty($attachment)){


						$this->email->attach($attachment,'attachment',$fileName,'application/pdf');
					}
					
					if($this->email->send()){
						
					//	print_r($this->email->print_debugger());
					
						return true;
					}else{
						// print_r($this->email->print_debugger());
						// echo 856;
						// exit;
						return false;
					}
					
		
	}
	function sendpdfattachment($to, $from='', $subject, $body_content,$fileatt,$fileName)
	{
	
		$from='noreply@greencrosstraining.com';//$_SESSION['companyEmail'];
		$from_mailname='No Reply';//$_SESSION['CompanyName'];
		
		
	
	$this->load->library('email');
	$this->email->from($from, $from_mailname);
	$this->email->to($to);
	$this->email->subject($subject);
	$this->email->message($body_content);
	//$this->email->attach($attachment);
	$this->email->attach($fileatt,'attachment',$fileName,'application/pdf');
	if($this->email->send())
		{
			
		  return true;
		 }
		else
		{
		//	print_r($this->email->print_debugger());
		//echo 856;
		  return true;
		}
	}

	function sendSMS($message,$selectednums)
	{
		$uname = 'graeme.law@greencrosstraining.co.uk';
     $pword = 'Gingus33$3';
	//$uname = '88HxWF';
    //$pword = 'laJWDQ';
    $test = '0';

    $from = 'GCT';
    $content = $message;
    $message = urlencode($message);
		$info="";
    $data = "uname=".$uname."&pword=".$pword."&message=".$message."&from=".$from."&selectednums=".$selectednums."&info=".$info."&test=".$test;

    $ch = curl_init('http://www.txtlocal.com/sendsmspost.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    

    $recipient = $selectednums;
    $referencetype = 'NA';
    $reference = '0';
    $pendingreply = '0';
		$insertarray=array(
			'recipient'=>$recipient,
			'content'=>$content,
			'ReferenceType'=>$referencetype,
			'Reference'=>$reference,
			'PendingReply'=>$pendingreply
		);
		//$this->save('SMS_Outbound',$insertarray);
		
	}
	function save_data($table, $data){
		return $this->db->insert($table,$data);
	}
	
	// Common save
	function save($table, $data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	// Update
	function update($table, $data, $where){
		
		 if(!empty($data)){ 
			$this->db->where($where, "", false); 
			$this->db->set ($data);
			// $this->db->update ($table); 
			return $this->db->update ($table);
			if($this->db->update ($table))
			{
				//echo $this->db->last_query();
				return TRUE;
			}
			else
			{
				return FALSE;
			}
        }
	}


// Common save CRM
	
	function update_re($table, $data, $where){
		  if(!empty($data)){ 

			$this->db->where($where, "", false); 

			$this->db->set($data);

			 $this->db->update ($table);
			// echo $this->db->last_query();
			if($this->db->affected_rows()>0){

				return TRUE;

			}else{

				return FALSE;

			}

        }
	}
	 
	// Common Delete function
	function delete($table, $where=array()) {
		if(!empty($table)){  
			if( $this->db->delete($table, $where) ){
				if($this->db->affected_rows()>0){

					return TRUE;

				}else{

					return FALSE;

				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	

	public function get_Certificate($CourseNumber,$delegateID)

	{

		$this->db->select('C_ID,PassFail');

		$this->db->from('certificates');

		$this->db->where('DelegateID',$delegateID);

		$this->db->where('CourseNumber',$CourseNumber);

		$result=$this->db->get();

		if($result->num_rows()>0)

		{

			return $result->row();

		}else

		{

			return false;

		}

	}
	
	function saveaudit($data){



		$data['Username']=$_SESSION['Username'];

		$data['IP']=$this->get_ipaddress();

			



		 $this->save('audit', $data); 

	}
	function savemail_record($data){
		$data['User']=(!empty($_SESSION['Username']))?$_SESSION['Username']:'Web';		
		$this->save('mail_record', $data); 

	}
	
	function get_travelling_distance($origin,$destination)
	{
	 		$origin = str_replace(' ', '%20', $origin);
			$destination = str_replace(' ', '%20', $destination);
			$url1="https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin['Lat'].",".$origin['Lng']."&destinations=".$destination['Lat'].",".$destination['Lng']."&mode=driving&language=en-EN&sensor=false&units=imperial&key=".get_google_api();
			
            //request the directions
			$api_return=json_decode(file_get_contents($url1));
			
			$status=$api_return->status;
			$routes=$api_return->rows;
			if($status=='OK')
			{
				
				if($routes[0]->elements[0]->status!='ZERO_RESULTS'){
					$dist=$routes[0]->elements[0]->distance->text;
					$miles = substr($dist, 0, -3);;
					if (strpos($dist, 'ft') !== false) {
						$miles = $miles/5280;
						$miles=number_format($miles, 2, '.', ',');
					}
				}else{
					return 'ZERO_RESULTS';
				}
				return $miles;//returns 9.0 km
			}else{
			 //print the shortest distance
			return  false; 
			}
       
         
          return $res;
	}

	function get_geolocation($Postcode){
		
		$Postcode = str_replace(' ', '', $Postcode);
		$data=array();
		$deleteq = "DELETE FROM `locationlist` WHERE (`Lng`='' or `Lat`='')";
			$this->db->query($deleteq);
		
		$query = "SELECT Lng,Lat from locationlist where SearchKey = '$Postcode' LIMIT 1";
		
			 $sql = $this->db->query($query);		
			   if ( $sql->num_rows() > 0) 
			     {		
				 return $sql->row_array();
		
			   }else{
		
		$url1 = "https://maps.google.com/maps/api/geocode/json?address=".$Postcode."&key=".get_google_api();
		
		//AIzaSyCWU3sZ4otvsoRYLBrUJoFHVjcCPKAd9TQ";
		//AIzaSyD80tIX41Hiaxv0TDT8yszQaqcU1sihi6s
		//AIzaSyC1AC5IJqZ_lvEvtl5Fe0tqPEBLIYzvfHI
				 $ch1 = curl_init();
				   curl_setopt($ch1, CURLOPT_URL,$url1);
				   curl_setopt($ch1, CURLOPT_POST, 1);
				   curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
				   curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
				   curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: text/json'));
				   curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
				  curl_setopt($ch1, CURLOPT_HTTPHEADER,array('Content-Length: 0'));
				   $response = curl_exec($ch1);
		
					$aResponse = json_decode($response, true);
				
					if(!empty($aResponse['results'])){
		
					$resp_res = $aResponse['results'][0]['geometry']['location'];
				
					$data['Lat']=$resp_res['lat'];
					$data['Lng']=$resp_res['lng'];
					
					return $data;
				}else{
		
					return false;
				}
			 }
		}

	function get_ipaddress(){


		return getenv('HTTP_CLIENT_IP')?:

		getenv('HTTP_X_FORWARDED_FOR')?:

		getenv('HTTP_X_FORWARDED')?:

		getenv('HTTP_FORWARDED_FOR')?:

		getenv('HTTP_FORWARDED')?:

		getenv('REMOTE_ADDR');
	}


	function checktrainerisfree($startdate,$enddate,$TrainerID)
 	{

	  $dave_date=true;

	  $main_query="SELECT cl.* from course_list as cl  WHERE TrainerID='$TrainerID' AND ((cl.StartDate BETWEEN '$startdate' AND '$enddate') or ('$startdate' BETWEEN cl.StartDate AND cl.EndDate)) AND cl.Status!='Cancelled'  ORDER by cl.StartDate asc,cl.EndDate desc";

	  $result=$this->db->query($main_query);

	  if($result->num_rows()>0)

	  {

		 $dave_date=false;

	  }else{


  	 	// $sql="Select HolidayRequestID from holidayrequest where Status=1 AND trainerID='$TrainerID' AND ((holidayrequest.DateFrom>='$startdate' AND holidayrequest.DateFrom<='$enddate') or(holidayrequest.DateTo>='$startdate' AND holidayrequest.DateTo<='$enddate'))";
		$sql="Select HolidayRequestID from holidayrequest where Status=1 AND trainerID='$TrainerID' AND ((holidayrequest.DateFrom BETWEEN '$startdate' AND '$enddate') or ('$startdate' BETWEEN holidayrequest.DateFrom AND holidayrequest.DateTo))";

		 $result=$this->db->query($sql);

		  if($result->num_rows()>0)

		  {

			  $dave_date=false;

		  }
	  }

	  return  $dave_date;

	}


	function checkdelegateisfree($startdate,$enddate,$ID)
 	{

	  $dave_date=true;

	  $main_query="SELECT cl.* from orders as cl LEFT JOIN orderdelegates as orderdelegates on(orderdelegates.OrderID = cl.Order_ID) WHERE orderdelegates.DelegateID ='$ID' AND ((cl.Start_Date BETWEEN '$startdate' AND '$enddate') or ('$startdate' BETWEEN cl.Start_Date AND cl.End_Date)) AND cl.Status!='Cancelled'  ORDER by cl.Start_Date asc,cl.End_Date desc";

	  $result=$this->db->query($main_query);

	  if($result->num_rows()>0)

	  {

		 $dave_date=false;

	  }else{

		$dave_date=true;
	  }

	  return  $dave_date;

	}


	function get_usl($usl){

		$query = $this->db->query("SELECT USL FROM usl WHERE type = '$usl'");
		if($query->num_rows()>0){

			return $query->row();
		}else{
			return false;
		}
	}

	function aasort (&$array, $key) {

		$sorter=array();

		$ret=array();

		reset($array);

		foreach ($array as $ii => $va) {

			$sorter[$ii]=$va[$key];

		}

		asort($sorter);

		foreach ($sorter as $ii => $va) {

			$ret[$ii]=$array[$ii];

		}

		$array=$ret;

	}

	function insertaudit($Username,$Description,$EntityID,$Entity,$url,$Section=''){

		$data = array(
			'Username'=>$Username,
			'Description'=>$Description,
			'EntityID'=>$EntityID,
			'Entity'=>$Entity,
			'Section'=>$Section,
			'URL'=>$url);

		 $this->save('audit', $data); 

	}
	public function eficaz_crypt( $string, $action = 'e' ) {
		// you may change these values to your own
		$secret_key = 'bs8523697415corty';
		$secret_iv = 'as8523697415cortys';
	
		//$secret_key = 'b5435n';
		//$secret_iv = 'a5435s';
		
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt($string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}
	
		return $output;

		
	}

	public function get_row_data($table,$where='',$selectparm='*',$join_table=NULL,$join=NULL,$join_by=NULL,$order_by_field=NULL,$order_by=NULL){
		
		 	$this->db->select($selectparm);
			if(!empty($where)){
				$this->db->where($where, "", false); 
			} 
			if($join_table && $join && $join_by){
				$this->db->join($join_table,$join,$join_by);
			}
			if($order_by && $order_by_field){
				$this->db->order_by($order_by_field,$order_by);
			}
			$query =$this->db->get($table);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
      
	}

	public function get_array_data($table,$where='',$selectparm='*',$join_table=NULL,$join=NULL,$join_by=NULL,$order_by_field=NULL,$order_by=NULL)
	{
		 	$this->db->select($selectparm);
		 	if(!empty($where)){
				$this->db->where($where, "", false); 
			}
			if($join_table && $join && $join_by){
				$this->db->join($join_table,$join,$join_by);
			}
			if($order_by && $order_by_field){
				$this->db->order_by($order_by_field,$order_by);
			}
			$this->db->distinct();
			$query =$this->db->get($table);
			//echo $this->db->last_query();
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return FALSE;
			}
      
	}

		public function get_row_data_order($table,$where='',$selectparm='*',$order_by_field=NULL,$order_by=NULL){
		
		 	$this->db->select($selectparm);
			if(!empty($where)){
				$this->db->where($where, "", false); 
			} 
			
			if($order_by && $order_by_field){
				$this->db->order_by($order_by_field,$order_by);
			}
			$query =$this->db->get($table);
			if($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
      
	}

	public function get_array_data_order($table,$where='',$selectparm='*',$order_by_field=NULL,$order_by=NULL){
		
		 	$this->db->select($selectparm);
		 	if(!empty($where)){
				$this->db->where($where, "", false); 
			}
			
			if($order_by && $order_by_field){
				$this->db->order_by($order_by_field,$order_by);
			}
			$this->db->distinct();
			$query =$this->db->get($table);
			//echo $this->db->last_query();
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return FALSE;
			}
      
	}

	public function get_data($table){
		
		 	$this->db->select('*');
			$query =$this->db->get($table);
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return FALSE;
			}
      
	}
	
	function get_data1( $table, $fields = '*', $where = array(),$order_by = '' ){
	if((is_array($where) && count($where)>0) or (!is_array($where) && trim($where) != '')) $this->db->where($where);
	if($order_by) $this->db->order_by($order_by);
	$this->db->select($fields);
	$query = $this->db->get($table);
	return $query->row();
	}

	public function get_row_count($table,$where){
		
		 	$this->db->select('*');
		 	if(!empty($where)){
				$this->db->where($where, "", false); 
			}
			$query =$this->db->get($table);
			if($query->num_rows()>0){
				return $query->num_rows();
			}else{
				return 0;
			}
      
	}

	public function get_sum_data($table,$where,$selectpara){
		
		 	$this->db->select($selectpara);
		 	if(!empty($where)){
				$this->db->where($where, "", false); 
			}
			$query =$this->db->get($table);
			if($query->num_rows()>0){
				return $query->row()->value_sum;
			}else{
				return 0;
			}
      
	}

	
	
	public function get_user_id($userName)
	{
		$query = $this->db->query("SELECT * FROM users WHERE Username = '$userName'");
		if($query->num_rows() == 0)
			{
				return $query->row();		
			}
		else 
			{
				return 'error';
			}			
	}

	function download($filename,$path,$OrderID,$FileID){

        $join_table = 'uploadfilerelation';
        $join='uploadfilerelation.FileID=file_upload_list.FileID';
        $join_by='left';
        $get_dat = $this->Common_model->get_row_data('file_upload_list',"uploadfilerelation.FileID='$FileID'",'Description',$join_table,$join,$join_by);
        $Description = $get_dat->Description;


         $this->Common_model->insertaudit($_SESSION['Username'],$Description.'-downloaded',$OrderID,'orders',current_url(),'Files');
         //------------------------------

        $this->load->helper('download');
        $data = file_get_contents(base_url().'files_upload/'.$path.'/'.$filename);
        force_download($filename, $data);    
    
    }
	
	/////getemail body////////
	function getemailtemplateBody($CategoryID,$IsActive)
	{
		$this->db->select('*');
		$this->db->from('emailtemplates');
		$this->db->where('CategoryID',$CategoryID);
		//$this->db->where('CreateUser',$CreateUser);
		if($IsActive)
		$this->db->where('IsActive',1);
		$result=$this->db->get();
		if($result->num_rows()>0)
		{
			
		    return $result->row()->Body;	
		}else
		{
			
			return false;
		}

	}

	////get navigation levels
	public function get_NavigationLevel($USL,$Function)
	{

		$query = $this->db->query("SELECT $USL FROM navigationlevel2 WHERE subID = '$Function'");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}

	}




	
}