@extends('header')
@section('content')
<input type="hidden" name="current_folder" id="current_folder" value="{{ $folder }}">
<input type="hidden" name="msg_id" id="msg_id" value="{{ $id }}">
 <div class="mail-box">
    <aside class="sm-side">
        <div class="user-head">
            <a class="inbox-avatar" href="javascript:;">
                <img  width="64" height="64" src="{{ asset('assets/images/avatar.jpg') }}">
            </a>
            <div class="user-name" id="user-info">

            </div>
            <a class="mail-dropdown pull-right" href="javascript:;">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
        <div class="inbox-body">
            <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
                Compose
            </a>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close mail-maadi" id="draft" type="button">×</button>
                            <h4 class="modal-title">Compose</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">To</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="" id="to" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Cc</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="" id="cc" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Bcc</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="" id="bcc" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Subject</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="" id="subject" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Message</label>
                                    <div class="col-lg-10">
                                        <textarea rows="10" cols="30" class="form-control" id="body" name=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <span class="btn green fileinput-button">
                                          <i class="fa fa-plus fa fa-white"></i>
                                          <span>Attachment</span>
                                          <input type="file" name="files[]" multiple="">
                                        </span>
                                        <button id="send" class="btn btn-send mail-maadi" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

        <ul class="inbox-nav inbox-divider" id="placeHolders">

        </ul>

        <ul id="buddy-list" class="nav nav-pills nav-stacked labels-info ">

        </ul>


    </aside>
    <aside class="lg-side">
        <div class="inbox-head">
            <h3>Inbox</h3>
            <form action="#" class="pull-right position">
                <div class="input-append">

                    <button class="btn sr-btn" type="button" id="sign-out"><i class="fa fa-sign-out"></i></button>
                </div>
            </form>
        </div>
        <div class="inbox-body">
           <div class="mail-option">
               <div class="chk-all">
                   <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                   <div class="btn-group">
                       <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                           All
                           <i class="fa fa-angle-down "></i>
                       </a>
                       <ul class="dropdown-menu">
                           <li><a href="#"> None</a></li>
                           <li><a href="#"> Read</a></li>
                           <li><a href="#"> Unread</a></li>
                       </ul>
                   </div>
               </div>

               <div class="btn-group">
                   <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                       <i class=" fa fa-refresh"></i>
                   </a>
               </div>
               <div class="btn-group hidden-phone">
                   <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                       More
                       <i class="fa fa-angle-down "></i>
                   </a>
                   <ul class="dropdown-menu">
                       <li><a href="#"><i class="fa fa-pencil"></i> Reply</a></li>
                       <li class="divider"></li>
                       <li><a href="#"><i class="fa fa-ban"></i> Forward</a></li>
                   </ul>
               </div>
               <div class="btn-group">
                   <a data-toggle="dropdown" href="#" class="btn mini blue">
                       Move to
                       <i class="fa fa-angle-down "></i>
                   </a>
                   <ul class="dropdown-menu">
                       <li class="email-action" data-action="unread"><a href="#"><i class="fa fa-pencil"></i> Mark as UnRead</a></li>
                       <li class="divider"></li>
                       <li class="email-action" data-action="spam"><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                       <li class="divider"></li>
                       <li class="email-action" data-action="trash"><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                   </ul>
               </div>

               <ul class="unstyled inbox-pagination">
                   <li><span>1-50 of 234</span></li>
                   <li>
                       <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                   </li>
                   <li>
                       <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                   </li>
               </ul>
           </div>
           <div id="smail" class="smail">

           </div>
        </div>
    </aside>
</div>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@stop