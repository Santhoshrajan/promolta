<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use Validator;
use Response;
use Storage;

use stdClass;
use DateTime;
use Carbon\Carbon;
use MyFuncs;

use JWTAuth;
use Config;

use App\User as AuthUser;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;

// use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class UsersControllers extends Controller
{

    public function checkUser(Request $request){ // Check if New user or Existing User - OK

        $uname              =   MyFuncs::cleanUserName($request->input('uname'));

        $fields = ['uname' => $uname];

        $rules  = ['uname' => 'required|string'];

        $output             = new stdClass();
        $output->status     = 'error';
        $output->message    = 'Please check the login details';

        $v = Validator::make($fields, $rules);

        if ($v->fails()){
            $output->message    = 'Oops! Please check the input!';
            $output->errors     = $v->errors();
        }
        else{
            $user     = MyFuncs::getUserProfile(['uname' => $uname]);

            if(isset($user->uname) && $user->uname==$uname){
                $output->status     = 'success';
                $output->message    = 'Please continue to login';
                $output->uname      = $uname;
            }
            else{
                $output->message    = 'Oops! Please check your username!';
            }

        }

        return response()->json($output, 200, [], JSON_NUMERIC_CHECK);
    }

    public function signIn(Request $request){

        $uname          =   MyFuncs::cleanUserName($request->input('uname'));
        $password       =   $request->input('password');

        $output             = new stdClass();
        $output->status     = 'error';
        $output->message    = 'Please check the login details';

        $rules = [
            'uname' => 'required|string',
            'password' => 'required|string'
        ];

        $v = Validator::make($request->all(), $rules);

        if ($v->fails()){
            $output->message    = 'Oops! Please check the input!';
            $output->errors     = $v->errors();
            return response()->json($output);
        }
        $validate = NULL;
        $output->message = 'Please check your login credentials!';

        $user = DB::table('users')
                  ->where('uname','=',$uname)
                  ->select('id AS user_id', 'uname', 'fname', 'lname', 'psswd AS password', 'status' )
                  ->first();

        if(isset($user->uname) && $user->uname==$uname){

            $password = substr(substr(sha1($password.'Santhosh'), 5), 0, -5);

           if($user->password==$password){
                $validate = 1;
                $output->message = 'User logged in successfully';
            }
            else{
                $output->message = 'Please check your login credentials!';
            }

            if($validate){
                $output->status     = 'success';
                $output->data       = MyFuncs::getUserProfile(['id' => $user->user_id]);
                $user_details       = AuthUser::where('id', '=', $user->user_id)->first();

                $customClaims       = MyFuncs::customClaims();
                $output->data->auth_token = JWTAuth::fromUser($user_details, $customClaims);

                $update = DB::table('users')->where('id','=',$user->user_id)->update( [ 'iat' => $customClaims['iat'] ] );
            }

        }
        else{   $output->message = 'Oops! Please check your username!';   }

        return response()->json($output, 200, [], JSON_NUMERIC_CHECK);
    }

}