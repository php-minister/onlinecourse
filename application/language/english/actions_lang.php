<?php
    $lang['teacher_actions_edit']='<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit teacher" href="teachers/edit/%s"><i class="icon-edit"></i></a>&nbsp;<a class="btn btn-mini" title="Scheduling" href="teachers/scheduling/%s"><i class="icon-calendar"></i></a>';
    $lang['teacher_actions_delete']='&nbsp;<button onclick="delete_teacher(%s)" title="Delete teacher" class="btn btn-mini"><i class="icon-remove"></i></button>';
    
    $lang['student_actions_edit']='<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit student" href="students/edit/%s"><i class="icon-edit"></i></a>';
	$lang['student_actions_edit_class_url']='<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit student" href="students/edit_class_url/%s"><i class="icon-plus"></i></a>';
	
	
    $lang['student_actions_delete']='&nbsp;<button onclick="delete_student(%s)" title="Delete student" class="btn btn-mini"><i class="icon-remove"></i></button>';
    
    
    $lang['parents_actions_edit']='<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit parent" href="parents/edit/%s"><i class="icon-edit"></i></a>';
    $lang['parents_actions_delete']='&nbsp;<button onclick="delete_parent(%s)" title="Delete parent" class="btn btn-mini"><i class="icon-remove"></i></button>';
    
    $lang['donors_actions_edit']='
        <a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit donor" href="donors/edit/%s"><i class="icon-edit"></i></a>&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Make donation" href="donors/donate/%s"><i class="icon-plus-sign"></i></a>';
    $lang['donors_actions_delete']='&nbsp;<button onclick="delete_donor(%s)" title="Delete donor" class="btn btn-mini"><i class="icon-remove"></i></button>';
    
    $lang['donors_actions_download']='<a target="_blank" class="btn btn-mini" title="Download Reports" href="donors/donor_pdf_report/%s"><i class="icon-download"></i></a>';
	$lang['donors_actions_donations']='<a target="_blank" class="btn btn-mini" title="Download payments Reports" href="donors/donate_reports/%s"><i class="icon-download"></i></a>';
	
    $lang['incident_actions_edit']='<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit incident" href="incidents/edit/%s"><i class="icon-edit"></i></a>';
    $lang['incident_actions_delete']='&nbsp;<button onclick="delete_incident(%s)" title="Delete incident" class="btn btn-mini"><i class="icon-remove"></i></button>';
	
	$lang['incidents_view'] = '<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="View incident" href="incidents/view/%s"><i class="icon-info-sign"></i></a>';
	
	$lang['view_donor'] = '<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="View incident" href="donors/view/%s"><i class="icon-info-sign"></i></a>';
	
	$lang['view_payment'] = '<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Edit student" href="students/payment_history/%s"><i class="icon-usd"></i> Payment History</a>';
?>