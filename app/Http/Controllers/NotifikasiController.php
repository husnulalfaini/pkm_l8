<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotifikasiController extends Controller
{
    public function fcm()
    {
        return view ('fcm');
        // dd('dd');
    }
    public function sendNotification()
    {
        $token = "cdsdMTpXxKg:APA91bHCAWHMbIWjStiZ8mONVMpJEKVa0YDN8a1_0Q_kiNj9h-nT7hPlLNNPk5yCDL9iX7tHmzaBNnHafxXNotFFZW9q7bsDXZ0Z3KKMwncWF_Gnz2XaeIzS4gM7FOkWHfHPrMJacpE3";  
        $from = "AAAA7i1UQyM:APA91bFXoaDWBxfemCCEST6qMYzebypF9BbmTbjK0RENfOsSCQpnAnruCZnqUuq08sQ7PfTTMHfB6LI5gGj_hj-GNouiQQ4Ssi8SQrGxXwgxtqIPv32tKbPYm3jq-MeMD7FQiWoIZ6yK";
        $msg = array
              (
                'body'  => "Testing Testing",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    }
}
