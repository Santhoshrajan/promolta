$(document).ready(function() {

	var auth_token = 'Bearer ' + localStorage.getItem('auth_token');
	var full_name  = localStorage.getItem('full_name');
	var uname  	   = localStorage.getItem('uname');

	var PlaceHolders = '';
	var unread = '';
	var mails = '';
	var smail = '';
	var contact_list = '';
	var use_this_key = '';
	var current_class = '';

	var mail_read = '';
	var mail_star = '';
	var mail_label = '';
	var mail_attach = '';

	// Start of Email Check
	window.onload = function () {

		var current_folder 		= 	$('#current_folder').val();
		var msg_id 				= 	Number($('#msg_id').val());
		var login_data 			= 	{ 'folder_key' : current_folder, 'msg_id' : msg_id };

		if(msg_id){
			$.ajax({
			type: 'POST',
			url: APP_URL+'/api/v1/mail/check',
			data: login_data,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Authorization', auth_token);
			},
			dataType: 'html',
		    timeout: 10000,
		    async: false,
				success: function (data) {
					var xhr_data = jQuery.parseJSON(data);

						if(xhr_data.status<0){
							window.location='login';
						}
						else{
							xhr_data.data.placeHolders.forEach(function(p_holder) {
								if(current_folder==p_holder.name_key){
									use_this_key = p_holder.name;
									current_class = " class='active' ";
								}
								if(p_holder.label_num && p_holder.mail_read){
									unread = " <span class='label " + p_holder.label_num + " pull-right'> " + p_holder.mail_read + "</span> ";
								}

								PlaceHolders += " <li " + current_class + "> <a href='" + APP_URL+'/'+p_holder.name_key + "'><i class='fa " + p_holder.fa + "'></i> " + p_holder.name + unread + "</a></li> ";

								unread = ''; current_class = '';
							});

							xhr_data.data.mail[use_this_key].forEach(function(s_mail) {

								smail += " <div class='sub'><h3> " + s_mail.subject + " </h3></div> <div class='details'><span class='detail-name'> " + s_mail.full_name + "</span><span class='detail-email'> " + s_mail.uname + "  </span> <span class='detail-time'> " + s_mail.mail_date + " </span> </div> <div class='email-body'>  " + s_mail.body + "  </div> ";
							});

							$('#user-info').html(" <h5><a href='#'>" + full_name + "</a></h5><span>" + uname + "</span> ");
							$('#placeHolders').html(PlaceHolders);
							$('#smail').html(smail);
						}

					},
			    error: function(jqXHR, textStatus, errorThrown) {
			        if(textStatus==="timeout") {
			        	$('.response-msg').html('Sorry! Network timeout').css({'color':'red'});
			        } else {

			        }
			   	}
			});
		}
		else{
			$.ajax({
			type: 'POST',
			url: APP_URL+'/api/v1/mail/check',
			data: login_data,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Authorization', auth_token);
			},
			dataType: 'html',
		    timeout: 10000,
		    async: false,
				success: function (data) {
					var xhr_data = jQuery.parseJSON(data);

						if(xhr_data.status<0){
							window.location='login';
						}
						else{
							xhr_data.data.placeHolders.forEach(function(p_holder) {
								if(current_folder==p_holder.name_key){
									use_this_key = p_holder.name;
									current_class = " class='active' ";
								}
								if(p_holder.label_num && p_holder.mail_read){
									unread = " <span class='label " + p_holder.label_num + " pull-right'> " + p_holder.mail_read + "</span> ";
								}

								PlaceHolders += " <li " + current_class + "> <a href='" + APP_URL+'/'+p_holder.name_key + "'><i class='fa " + p_holder.fa + "'></i> " + p_holder.name + unread + "</a></li> ";

								unread = ''; current_class = '';
							});

							xhr_data.data.mail[use_this_key].forEach(function(s_mail) {

								mail_read = s_mail.mail_read ?  " class='unread open-single-mail' " : " class='open-single-mail' ";
								mail_star = s_mail.mail_star ?  " <i class='fa fa-star inbox-started'></i></td> " : " <i class='fa fa-star'></i> ";
								mail_label = s_mail.mail_label ? " <span class='label label-danger pull-right'>urgent</span> " : '';
								mail_attach = s_mail.mail_attach ? " <i class='fa fa-paperclip'></i> " : '';

								mails += " <tr "+ mail_read +" data-link='"+ s_mail.name_key+"/"+s_mail.msg_id+"'> <td class='inbox-small-cells'> <input type='checkbox' class='mail-checkbox'> </td> <td class='inbox-small-cells'>" + mail_star + "</td> <td class='view-message dont-show'>" + s_mail.full_name + mail_label + "</td> <td class='view-message'>" + s_mail.subject + "</td> <td class='view-message inbox-small-cells'>" + mail_attach + "</td> <td class='view-message text-right'>" + s_mail.mail_date + "</td></tr> ";
							});

							$('#user-info').html(" <h5><a href='#'>" + full_name + "</a></h5><span>" + uname + "</span> ");
							$('#placeHolders').html(PlaceHolders);
							$('#mails').html(mails);
						}

					},
			    error: function(jqXHR, textStatus, errorThrown) {
			        if(textStatus==="timeout") {
			        	$('.response-msg').html('Sorry! Network timeout').css({'color':'red'});
			        } else {

			        }
			   	}
			});
		}

		var statusArray = ['text-success', 'text-danger', 'text-muted'];

		$.ajax({
			type: 'POST',
			url: APP_URL+'/api/v1/contact/fetch',
			data: login_data,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Authorization', auth_token);
			},
			dataType: 'html',
		    timeout: 10000,
		    async: false,
				success: function (data) {
					var xhr_data = jQuery.parseJSON(data);

						if(xhr_data.status<0){
							window.location='login';
						}
						else{
							contact_list += " <li> <h4>Frequently Contacted</h4> </li> ";

							xhr_data.data.forEach(function(buddy) {
								var randstatus = statusArray[Math.floor(Math.random() * statusArray.length)];
								contact_list += " <li> <a href='#'> <i class=' fa fa-circle " + randstatus + "'></i>" + buddy.full_name + "<p>" + buddy.online_status + "</p></a>  </li> ";
							}); console.log(contact_list);
							$('#buddy-list').html(contact_list);
						}

					},
			    error: function(jqXHR, textStatus, errorThrown) {
			        if(textStatus==="timeout") {
			        	$('.response-msg').html('Sorry! Network timeout').css({'color':'red'});
			        } else {

			        }
			   	}
			});

	}
	// End of Email Check

	// Start of Email Sending....
	$(document).on('click', '.mail-maadi', function(){

		var action 	= 	$(this).attr('id');
		var to 		= 	$('#to').val();
		var cc 		= 	$('#cc').val();
		var bcc 	= 	$('#bcc').val();
		var subject = 	$('#subject').val();
		var body 	= 	$('#body').val();

		var post_data = { 'action' : action, 'to' : to, 'cc' : cc, 'bcc' : bcc, 'subject' : subject, 'body' : body } ;

		if(1){
			$.ajax({
			type: 'POST',
			url: APP_URL+'/api/v1/mail/send',
			data: post_data,
			beforeSend: function (xhr) {
				xhr.setRequestHeader('Authorization', auth_token);
			},
			dataType: 'html',
		    timeout: 10000,
		    async: false,
				success: function (data) {
					var xhr_data = jQuery.parseJSON(data);
						if(action=='draft'){
							window.location='drafts';
						}
						else{
							window.location='sent';
						}
					},
			    error: function(jqXHR, textStatus, errorThrown) {
			        if(textStatus==="timeout") {
			        	$('.response-msg').html('Sorry! Network timeout').css({'color':'red'});
			        } else {

			        }
			   	}
			});
		}
		else{
			$('.response-msg').html('Please check the input!!').css({'color':'red'});
		}
	});
	// End of Email Sending....

	// Start of opening Single Email....
	$(document).on('click', '.open-single-mail', function(){
		var open_link = APP_URL+'/'+$(this).attr('data-link');
		window.location=open_link;
	});
	// End of opening Single Email....

	$(document).on('click', '#sign-out', function(){
		localStorage.removeItem('auth_token');
		localStorage.removeItem('full_name');
		localStorage.removeItem('uname');
		window.location='login';
	});
});