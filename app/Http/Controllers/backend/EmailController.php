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

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function sendMail(Request $request)
    {
        $v = Validator::make($request->all(), [
            'to' => 'required|string'
        ]);

        $output = new stdClass();

        if ($v->fails()){
            $output->message    =   'Oops! Please check the input!';
            $output->errors     =   $v->errors();
            return response()->json($output);
        }

        $user_id     =   $request->input('user_id', 0);
        $to          =   MyFuncs::cleanEmailCsv($request->input('to'));
        $cc          =   MyFuncs::cleanEmailCsv($request->input('cc'));
        $bcc         =   MyFuncs::cleanEmailCsv($request->input('bcc'));
        $subject     =   $request->input('subject');
        $body        =   $request->input('body');
        $action      =   $request->input('action');

        $msg_data    = [ 'to' => $to , 'cc' => $cc , 'bcc' => $bcc ];

        if($action=='send'){
            $receiver_ids     =   MyFuncs::getUserIdFromEmails($msg_data);
            $author_folder_id = 2;
        }
        else{
            $author_folder_id = 3;
            $receiver_ids = [];
        }

        $individual_data = [];

        try {

            DB::beginTransaction();

            $msg_id = DB::table('messages')->insertGetId(
                ['author_id' => $user_id, 'subject' => $subject, 'body' => $body]
            );

            DB::table('messages')
                ->where('id', $msg_id)
                ->update([
                    'parent_msg_id' => $msg_id
                ]);

            $msg_data['msg_id'] = $msg_id;

            DB::table('msg_address')->insert( $msg_data );

            $individual_data[] = [ 'msg_id' => $msg_id, 'user_id' => $user_id, 'folder_id' => $author_folder_id];

            foreach ($receiver_ids as $single_user_id) {
                $ind_data = [ 'msg_id' => $msg_id, 'user_id' => $single_user_id, 'folder_id' => 1];
                $individual_data[] = $ind_data;
            }

            DB::table('user_msg_map')->insert( $individual_data );

            DB::commit();

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {

            return response()->json(['status' => 'fail', 'error' => [
                    'type' => 'database_exception',
                    'details' => $e->getMessage()
                ]
            ]);
        }
    }


    public function getAllMails(Request $request)
    {
        $user_id       =   $request->input('user_id', 0);
        $folder_id     =   $request->input('folder_id', 0);
        $folder_key    =   $request->input('folder_key', 0);
        $msg_id        =   $request->input('msg_id', 0);

        $output                         =   new stdClass();
        $output->status                 =   'success';
        $output->message                =   'Welcome to XYZ email';
        $output->data                   =   new stdClass();
        $output->data->placeHolders     =   NULL;
        $output->data->mail             =   new stdClass();

        $v = Validator::make($request->all(), [
            'folder_id' => 'integer',
            'folder_key' => 'string'
        ]);

        if ($v->fails()){
            $output->message    =   'Oops! Please check the input!';
            $output->errors     =   $v->errors();
            return response()->json($output);
        }

        $cond = ['umm.user_id' => $user_id];

        $select = ['f.name as folder_name', 'm.subject', 'u.uname', 'u.fname', 'u.lname', 'mad.to', 'mad.cc', 'mad.bcc', 'umm.is_unread AS mail_read', 'umm.is_starred AS mail_star', 'm.attachment AS mail_attach', 'f.name_key', 'm.id AS msg_id'];

        if($folder_id>0){
            $cond['umm.folder_id'] = $folder_id;
        }
        if($msg_id>0){
            $cond['umm.msg_id'] = $msg_id;
            $select[] = DB::raw('DATE_FORMAT(umm.created_at, "%a, %b %c, %Y at %l:%i %p") AS mail_date');
            $select[] = 'm.body';
        }
        else{
            $select[] = DB::raw('DATE_FORMAT(umm.created_at, "%d %b") AS mail_date');
        }

        try {

            $output->data->placeHolders = DB::table('folders AS f')
                                                ->leftJoin('user_msg_map AS umm', function($join) use ($user_id) {
                                                    $join->on('f.id','=','umm.folder_id')
                                                    ->where([ 'umm.user_id' => $user_id, 'umm.is_unread' => 1 ])
                                                    ->whereIn('umm.folder_id',[1,3,4]);
                                                })
                                                ->where('visibility', '=', 1)
                                                ->select('f.id AS fid', 'f.name', 'f.fa', 'f.label_num', DB::raw('SUM(umm.is_unread) AS mail_read'), 'f.name_key')
                                                ->groupBy('f.id')
                                                ->orderBy('f.id', 'asc')
                                                ->get();

            foreach ($output->data->placeHolders as $p) {
                if($folder_key==$p->name_key){
                    $cond['umm.folder_id'] = $p->fid;
                }
                $output->data->mail->{$p->name} = [];
            }

            $query = DB::table('user_msg_map AS umm')
                    ->join('folders AS f','f.id','=','umm.folder_id')
                    ->join('messages AS m', 'm.id','=','umm.msg_id')
                    ->leftJoin('users AS u','u.id','=','m.author_id')
                    ->leftJoin('msg_address AS mad', function($join) use ($user_id) {
                        $join->on('mad.msg_id','=','m.id')->where('m.author_id', $user_id);
                    })
                    ->where($cond)
                    ->whereBetween('umm.folder_id', [1,5])
                    ->select($select)
                    ->get();

            foreach ($query as $r) {
                $r->uname .= '@xyz.com';
                $r->mail_label = 0;
                $folder_name = $r->folder_name;
                $r->full_name = $r->fname.' '.$r->lname;
                $output->data->mail->{$folder_name}[] = $r;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
