<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function Laravel\Prompts\error;


class ContactController extends Controller
{
    public function contact(){
        return view('pages.main.contact');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'message' => 'required|string',
            ]);

            $ipAddress = $request->ip();

            Message::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'message' => $validatedData['message'],
                'ip_address' => $ipAddress,
            ]);
            return redirect()->back()->with('success', 'Message successfully sent!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
