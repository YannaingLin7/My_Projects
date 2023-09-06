<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactForm() {
        return view('user.contact.contact');
    }

    public function showMessage() {
        $messages = Contact::get();
        return view('admin.contact.message',compact('messages'));
    }

    public function messageDetail($id) {
        $message = Contact::where('id', $id)->first();
        return view('admin.contact.messageDetail', compact('message'));
    }
}
