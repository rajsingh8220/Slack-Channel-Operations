<?php
namespace App\Slack;
class Slack
{
    
    private $access_token = "access-token";
    private $channel = "#channel-name";
    
    public function getAccessTOken(){
        return $this->access_token;
    }
    public function getChannel(){
        return $this->channel;
    }
    public function setChannel($channel){
        return $this->channel=$channel;
    }
    public function __construct($access_token=null,$channel=null) {
        if(isset($access_token)&&$access_token!=null){
            $this->access_token = $access_token;
        }
        if(isset($channel)&&$channel!=null){
            $this->channel = $channel;
        }
    }
    
    public function postNewThread($message){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://slack.com/api/chat.postMessage");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "token=".$this->access_token."&channel=".$this->channel."&text=".$message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    
    public function postReplyThread($msg,$ts){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://slack.com/api/chat.postMessage");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "token=".$this->access_token."&channel=".$this->channel."&text=".$msg."&ts=".$ts."&thread_ts=".$ts);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    
    public function sendArrayPayload($data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://slack.com/api/chat.postMessage");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    
    
    
    public function changeStatusByProfile($user_id,$profile){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://slack.com/api/users.profile.set");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "token=".$this->access_token."&profile=".$profile."&user=".$user_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    
    
    
}