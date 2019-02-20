<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    // fetching all the user as contacts here
    public function getContactList()
    {
        $contacts = User::all();

        return response()->json($contacts);
    }

    // fetching all the messages from database for messages feed section
    public function getMessagesFor ($id) {

        $messages = Message::where('user_id_from', $id)->orWhere('user_id_to', $id)->get();

        return response()->json($messages);

    }
}
