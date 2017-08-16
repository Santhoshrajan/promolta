<?php

namespace App\Helpers;
use DB;
use stdClass;
use DateTime;

use Carbon\Carbon;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MyFuncs {

  public static function getUserProfile($udata) {

    $condition = [];

    if(isset($udata['id']) && $udata['id']){
      $condition['id'] = $udata['id'];
    }
    else if(isset($udata['uname']) && !empty($udata['uname'])){
      $condition['uname'] = $udata['uname'];
    }
    else{
      return false;
    }

    $user_details = DB::table('users')
          ->select('id AS user_id', 'uname', 'fname', 'lname', 'status' )
          ->where($condition)
          ->first();

    $user_details->full_name = $user_details->fname.' '.$user_details->lname;

    return $user_details;
  }


  public static function updateUserProfile($input) {

    if(isset($input['where']) && is_array($input['where']) && isset($input['update']) && is_array($input['update'])){
      $user_update = DB::table('users')->where( $input['where'] )->update( $input['update'] );
      return $user_update;
    }
    else{
      return false;
    }
  }


  public static function customClaims() {

      $now        =   Carbon::now();
      $current    =   $now->copy()->toDateTimeString();
      $later      =   $now->copy()->addMonths(2)->toDateTimeString();

      $iat_obj    =   new DateTime($current);
      $exp_obj    =   new DateTime($later);

      $iat        =   $iat_obj->getTimestamp();
      $exp        =   $exp_obj->getTimestamp();

      $output =  [ 'exp' => $exp, 'iat' => $iat ];

      return $output;
  }

  public static function cleanEmailCsv($email_csv) {

      $email_arr = explode(',', $email_csv);

      $cleaned_email_csv = '';

      foreach ($email_arr as $email) {
        $email   =   strtolower(preg_replace('/[^._@0-9A-Za-z-]/', '', trim($email)));
        $cleaned_email_csv .= $email.',';
      }

      $cleaned_email_csv = rtrim($cleaned_email_csv, ',');

      if(empty($cleaned_email_csv)){
        $cleaned_email_csv = NULL;
      }

      return $cleaned_email_csv;
  }

  public static function cleanUserName($email) {

    $full_email = explode("@", $email);

    $email = strtolower(preg_replace('/[^0-9A-Za-z]/', '', trim($full_email[0])));

    return $email;
  }

  public static function getUserIdFromEmails($msg_data) {

    $uname_arr = [];

    if(is_array($msg_data)){
      foreach ($msg_data as $email_csv) {
        if(!empty($email_csv)){
          $tmp = explode(',', $email_csv);

          foreach ($tmp as $email_single) {
            $uname_arr[] = self::cleanUserName($email_single);
          }

        }
      }

      if(count($uname_arr)){
        $uid_arr = DB::table('users')
                        ->whereIn('uname',$uname_arr)
                        ->pluck('id');

        return $uid_arr;
      }
    }
    else{
      return false;
    }
  }

}