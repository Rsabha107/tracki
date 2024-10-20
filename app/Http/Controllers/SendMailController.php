<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;
use App\Mail\TaskAssignmentMail;
use App\Models\Employee;
use App\Models\User;

use Illuminate\Support\Facades\Notification;

use App\Notifications\AnnouncementCenter;

class SendMailController extends Controller
{
    //
    public function index()
    {
        $content = [
            'name' => 'Raafat',
            'subject' => 'Trak: Event monitoring reminder',
            'body' => 'You have an event/task that needs your attention.  Ya walad!!!'
        ];

        // t.rajendran@sc.qa
        Mail::to('rsabha@gmail.com')->cc('r.sabha@sc.qa')->send(new SampleMail($content));

        return "Email has been sent.";
    }

    public function sendTaskAssignmentEmail($details, $emails)
    {
        foreach($emails as $key1 => $item1){

            $content = [
                'name' => $item1->assigned_to_name .',',
                'start_date' =>  \Carbon\Carbon::parse($details->start_date)->format('d-M-Y'),
                'due_date' => \Carbon\Carbon::parse($details->due_date)->format('d-M-Y'),
                'subject' => 'Tracki: Task "'. $details->name .'" has been assigned to you',
                'body' => 'task "'.$details->name. '" has been assigned to you and ready for some action. chop chop start churning',
                'description' => $details->description,
            ];

            Mail::to($item1->email_address)->cc('rsabha@gmail.com')->send(new TaskAssignmentMail($content));
        }

        return "Email has been sent.";
    } // sendTaskAssignmentEmail

    public function sendTaskAssignmentNotifcation(){

        $user = User::findOrFail(4);

        $details = [
            'greeting' => 'Hi laravel developer',
            'subject' => 'This is a subject',
            'body' => 'this is the email body',
            'startdate' => '',
            'duedate' => '',
            'description' => 'describe what you like',
            'actiontext' => 'Go to Tracki',
            'actionurl' => '/',
            'lastline' => 'this is the last line',
        ];
        // Notification::send($user, new AnnouncementCenter($details));

        $user->notify(new AnnouncementCenter($details));

        dd('done');
    }
}
