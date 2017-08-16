<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use Validator;

use App\Http\Requests;

use stdClass;
use DateTime;
use Carbon\Carbon;
use MyFuncs;

class ContactController extends Controller
{

    public function getMyBuddies(Request $request)
    {
        $user_id       =   $request->input('user_id', 0);

        $output               =   new stdClass();
        $output->status       =   'fail';
        $output->message      =   'Welcome to XYZ email';
        $output->data         =   [];

        try {

            $query = DB::table('users')
                        ->select('online_status', 'fname', 'lname')
                        ->get();

            if(count($query)){
                $output->status         =   'success';
                foreach ($query as $r) {
                    $r->full_name = $r->fname.' '.$r->lname;
                    unset($r->fname);
                    unset($r->lname);
                    $output->data[]  =   $r;
                }
            }

            return response()->json($output);

        } catch (\Exception $e) {

            return response()->json(['status' => 'fail', 'error' => [
                    'type' => 'database_exception',
                    'details' => $e->getMessage()
                ]
            ]);
        }
    }
}
