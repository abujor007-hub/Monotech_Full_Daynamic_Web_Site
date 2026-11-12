<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{

 public function index()
    {
        $messages = ContactMessage::all();

        return view('pages.dashboard.admin-dashboard.message.index', compact('messages'));
    }
   
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:5000',
    ]);

    $validated['email'] = strtolower(trim($validated['email']));

    ContactMessage::updateOrCreate(
        [
            'email' => $validated['email'],
        ],
        [
            'name' => $validated['name'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]
    );

    return redirect()->back()->with(
        'success',
        'Your message has been sent successfully!'
    );
}

public function destroy($id)
{
    $message = ContactMessage::findOrFail($id);

    $message->delete();

    return redirect()
        ->route('admin.messages')
        ->with('success', 'Message deleted successfully!');
}

public function show($id)
{
    $message = ContactMessage::findOrFail($id);

    return view('pages.dashboard.admin-dashboard.message.show', compact('message'));
}

}
