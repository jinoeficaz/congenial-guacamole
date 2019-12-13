<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Handles admin functions.
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Models
 * @author
 */

// ------------------------------------------------------------------------
class Common_model extends CI_Model
{
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
        if ($_SERVER["HTTPS"] == "on") {
            $postURL .= "s";
        }
        $postURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $postURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $postURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $postURL;
    }
    
    function generateRandomString($length = 6)
    {
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function send_mail($to_email, $subject, $message, $attachment = '', $fileName = '', $cc = array(), $bcc = array(), $batch_mode = false, $batch_size = 200)
    {
        
        $from          = 'noreply@greencrosstraining.com'; //$_SESSION['companyEmail'];
        $from_mailname = 'Greencross'; //$_SESSION['CompanyName'];
        $this->load->library('email');
        $body    = $message;
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        $this->email->from($from, $from_mailname);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($body, $headers);
        if (!empty($attachment)) {
            
            $this->email->attach($attachment, 'attachment', $fileName, 'application/pdf');
        }
        
        if ($this->email->send()) {
            
            //	print_r($this->email->print_debugger());
            return true;
        } else {
            // print_r($this->email->print_debugger());
            // echo 856;
            // exit;
            return false;
        }
        
    }
    
    function sendpdfattachment($to, $from = '', $subject, $body_content, $fileatt, $fileName)
    {
        
        $from          = 'noreply@greencrosstraining.com'; //$_SESSION['companyEmail'];
        $from_mailname = 'No Reply'; //$_SESSION['CompanyName'];
        
        
        $this->load->library('email');
        $this->email->from($from, $from_mailname);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body_content);
        //$this->email->attach($attachment);
        $this->email->attach($fileatt, 'attachment', $fileName, 'application/pdf');
        if ($this->email->send()) {
            
            return true;
        } else {
            //	print_r($this->email->print_debugger());
            //echo 856;
            return true;
        }
    }
    
    function sendSMS($message, $selectednums)
    {
        $uname = 'graeme.law@greencrosstraining.co.uk';
        $pword = 'Gingus33$3';
        //$uname = '88HxWF';
        //$pword = 'laJWDQ';
        $test  = '0';
        
        $from    = 'GCT';
        $content = $message;
        $message = urlencode($message);
        $info    = "";
        $data    = "uname=" . $uname . "&pword=" . $pword . "&message=" . $message . "&from=" . $from . "&selectednums=" . $selectednums . "&info=" . $info . "&test=" . $test;
        
        $ch = curl_init('http://www.txtlocal.com/sendsmspost.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $recipient     = $selectednums;
        $referencetype = 'NA';
        $reference     = '0';
        $pendingreply  = '0';
        $insertarray   = array(
            'recipient' => $recipient,
            'content' => $content,
            'ReferenceType' => $referencetype,
            'Reference' => $reference,
            'PendingReply' => $pendingreply
        );
        //$this->save('SMS_Outbound',$insertarray);
        
    }
    function save_data($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    
    // Common save
    function save($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    // Update
    function update($table, $data, $where)
    {
        
        if (!empty($data)) {
            $this->db->where($where, "", false);
            $this->db->set($data);
            // $this->db->update ($table);
            return $this->db->update($table);
            if ($this->db->update($table)) {
                //echo $this->db->last_query();
                return true;
            } else {
                return false;
            }
        }
    }
    
    // Common save CRM
    function update_re($table, $data, $where)
    {
        if (!empty($data)) {
            
            $this->db->where($where, "", false);
            
            $this->db->set($data);
            
            $this->db->update($table);
            // echo $this->db->last_query();
            if ($this->db->affected_rows() > 0) {
                
                return true;
                
            } else {
                
                return false;
                
            }
            
        }
    }
    
    // Common Delete function
    function delete($table, $where = array())
    {
        if (!empty($table)) {
            if ($this->db->delete($table, $where)) {
                if ($this->db->affected_rows() > 0) {
                    
                    return true;
                    
                } else {
                    
                    return false;
                    
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function get_Certificate($CourseNumber, $delegateID)
    {
        $this->db->select('C_ID,PassFail');
        $this->db->from('certificates');
        $this->db->where('DelegateID', $delegateID);
        $this->db->where('CourseNumber', $CourseNumber);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
        
    }
    
    function saveaudit($data)
    {
        $data['Username'] = $_SESSION['Username'];
        $data['IP']       = $this->get_ipaddress();
        $this->save('audit', $data);
    }
    
    function savemail_record($data)
    {
        $data['User'] = (!empty($_SESSION['Username'])) ? $_SESSION['Username'] : 'Web';
        $this->save('mail_record', $data);
        
    }
    
    function get_travelling_distance($origin, $destination)
    {
        $origin      = str_replace(' ', '%20', $origin);
        $destination = str_replace(' ', '%20', $destination);
        $url1        = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origin['Lat'] . "," . $origin['Lng'] . "&destinations=" . $destination['Lat'] . "," . $destination['Lng'] . "&mode=driving&language=en-EN&sensor=false&units=imperial&key=" . get_google_api();
        
        //request the directions
        $api_return = json_decode(file_get_contents($url1));
        
        $status = $api_return->status;
        $routes = $api_return->rows;
        if ($status == 'OK') {
            
            if ($routes[0]->elements[0]->status != 'ZERO_RESULTS') {
                $dist  = $routes[0]->elements[0]->distance->text;
                $miles = substr($dist, 0, -3);
                ;
                if (strpos($dist, 'ft') !== false) {
                    $miles = $miles / 5280;
                    $miles = number_format($miles, 2, '.', ',');
                }
            } else {
                return 'ZERO_RESULTS';
            }
            return $miles; //returns 9.0 km
            
        } else {
            //print the shortest distance
            return false;
        }
        
        return $res;
    }
    
    function get_geolocation($Postcode)
    {
        
        $Postcode = str_replace(' ', '', $Postcode);
        $data     = array();
        $deleteq  = "DELETE FROM `locationlist` WHERE (`Lng`='' or `Lat`='')";
        $this->db->query($deleteq);
        
        $query = "SELECT Lng,Lat from locationlist where SearchKey = '$Postcode' LIMIT 1";
        
        $sql = $this->db->query($query);
        if ($sql->num_rows() > 0) {
            return $sql->row_array();
            
        } else {
            
            $url1 = "https://maps.google.com/maps/api/geocode/json?address=" . $Postcode . "&key=" . get_google_api();
            
            //AIzaSyCWU3sZ4otvsoRYLBrUJoFHVjcCPKAd9TQ";
            //AIzaSyD80tIX41Hiaxv0TDT8yszQaqcU1sihi6s
            //AIzaSyC1AC5IJqZ_lvEvtl5Fe0tqPEBLIYzvfHI
            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, $url1);
            curl_setopt($ch1, CURLOPT_POST, 1);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/json'
            ));
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
                'Content-Length: 0'
            ));
            $response = curl_exec($ch1);
            
            $aResponse = json_decode($response, true);
            
            if (!empty($aResponse['results'])) {
                
                $resp_res = $aResponse['results'][0]['geometry']['location'];
                
                $data['Lat'] = $resp_res['lat'];
                $data['Lng'] = $resp_res['lng'];
                
                return $data;
            } else {
                
                return false;
            }
        }
    }
    
    function get_ipaddress()
    {
        return getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
    }
    
    function get_usl($usl)
    {
        
        $query = $this->db->query("SELECT USL FROM usl WHERE type = '$usl'");
        if ($query->num_rows() > 0) {
            
            return $query->row();
        } else {
            return false;
        }
    }
    
    function aasort(&$array, $key)
    {
        
        $sorter = array();
        
        $ret = array();
        
        reset($array);
        
        foreach ($array as $ii => $va) {
            
            $sorter[$ii] = $va[$key];
            
        }
        
        asort($sorter);
        
        foreach ($sorter as $ii => $va) {
            
            $ret[$ii] = $array[$ii];
            
        }
        
        $array = $ret;
        
    }
    
    function insertaudit($Username, $Description, $EntityID, $Entity, $url, $Section = '')
    {
        
        $data = array(
            'Username' => $Username,
            'Description' => $Description,
            'EntityID' => $EntityID,
            'Entity' => $Entity,
            'Section' => $Section,
            'URL' => $url
        );
        
        $this->save('audit', $data);
        
    }
    public function guaco_crypt($string, $action = 'e')
    {
        // you may change these values to your own
        $secret_key = 'bs8523697415corty';
        $secret_iv  = 'as8523697415cortys';
        
        //$secret_key = 'b5435n';
        //$secret_iv = 'a5435s';
        $output         = false;
        $encrypt_method = "AES-256-CBC";
        $key            = hash('sha256', $secret_key);
        $iv             = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        
        return $output;
        
    }
    
    public function get_row_data($table, $where = '', $selectparm = '*', $join_table = NULL, $join = NULL, $join_by = NULL, $order_by_field = NULL, $order_by = NULL)
    {
        
        $this->db->select($selectparm);
        if (!empty($where)) {
            $this->db->where($where, "", false);
        }
        if ($join_table && $join && $join_by) {
            $this->db->join($join_table, $join, $join_by);
        }
        if ($order_by && $order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
        
    }
    
    public function get_array_data($table, $where = '', $selectparm = '*', $join_table = NULL, $join = NULL, $join_by = NULL, $order_by_field = NULL, $order_by = NULL)
    {
        $this->db->select($selectparm);
        if (!empty($where)) {
            $this->db->where($where, "", false);
        }
        if ($join_table && $join && $join_by) {
            $this->db->join($join_table, $join, $join_by);
        }
        if ($order_by && $order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }
        $this->db->distinct();
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }
    
    public function get_row_data_order($table, $where = '', $selectparm = '*', $order_by_field = NULL, $order_by = NULL)
    {
        
        $this->db->select($selectparm);
        if (!empty($where)) {
            $this->db->where($where, "", false);
        }
        
        if ($order_by && $order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
        
    }
    
    public function get_array_data_order($table, $where = '', $selectparm = '*', $order_by_field = NULL, $order_by = NULL)
    {
        
        $this->db->select($selectparm);
        if (!empty($where)) {
            $this->db->where($where, "", false);
        }
        
        if ($order_by && $order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }
        $this->db->distinct();
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }
    
    public function get_data($table)
    {
        
        $this->db->select('*');
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
        
    }
    
    function get_data1($table, $fields = '*', $where = array(), $order_by = '')
    {
        if ((is_array($where) && count($where) > 0) or (!is_array($where) && trim($where) != ''))
            $this->db->where($where);
        if ($order_by)
            $this->db->order_by($order_by);
        $this->db->select($fields);
        $query = $this->db->get($table);
        return $query->row();
    }
    
    public function get_row_count($table, $where)
    {
        
        $this->db->select('*');
        if (!empty($where)) {
            $this->db->where($where, "", false);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
        
    }
    
    public function get_sum_data($table, $where, $selectpara)
    {
        
        $this->db->select($selectpara);
        if (!empty($where)) {
            $this->db->where($where, "", false);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->row()->value_sum;
        } else {
            return 0;
        }
        
    }
    
}
