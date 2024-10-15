<?php

namespace Modules\ContactMessage\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CustomRecaptcha;
use App\Traits\GlobalMailTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\ContactMessage\app\Models\ContactMessage;

class ContactMessageController extends Controller {
    use GlobalMailTrait;
    public function store(Request $request) {
        $setting = Cache::get('setting');

        $request->validate([
            'name'                 => 'required',
            'email'                => 'required',
            'subject'              => 'required',
            'message'              => 'required',
            'g-recaptcha-response' => $setting->recaptcha_status == 'active' ? ['required', new CustomRecaptcha()] : '',
        ], [
            'name.required'                 => __('Name is required'),
            'email.required'                => __('Email is required'),
            'subject.required'              => __('Subject is required'),
            'message.required'              => __('Message is required'),
            'g-recaptcha-response.required' => __('Please complete the recaptcha to submit the form'),
        ]);

        $new_message = new ContactMessage();
        $new_message->name = $request->name;
        $new_message->email = $request->email;
        $new_message->subject = $request->subject;
        $new_message->message = $request->message;
        $new_message->phone = $request->phone;
        $new_message->save();

        //mail send
        $str_replace = [
            'name'    => $new_message->name,
            'email'   => $new_message->email,
            'phone'   => $new_message->phone,
            'subject' => $new_message->subject,
            'message' => $new_message->message,
        ];
        [$subject, $message] = $this->fetchEmailTemplate('contact_mail', $str_replace);
        $this->sendMail($setting->contact_message_receiver_mail, $subject, $message);

        return response()->json(['message' => __('Message Sent Successfully')]);
    }
}
