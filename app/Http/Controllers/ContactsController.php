<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;
use DB;

class ContactsController extends Controller
{
    public function get()
    {
        // get all users except the authenticated one
        //$contacts = User::where('id', '!=', auth()->id())->get();
        $senders = Message::select(\DB::raw('`from` as sender_id'))
                ->where('to', auth()->id())
                ->groupBy('from')
                ->get();

        foreach($senders as $sender){
            $contacts[] = DB::table('user_basic_infos')->where('user_id', '!=', auth()->id())->where('user_id', $sender->sender_id)->first();            
        }

        $contacts = collect($contacts);

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });


        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to'   => $request->contact_id,
            'message' => $request->text
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }

    public function search()
    {
        if ($search = \Request::get('q')) {
            // get all users except the authenticated one
            //$contacts = User::where('id', '!=', auth()->id())->get();
            $senders = Message::select(\DB::raw('`from` as sender_id'))
                    ->where('to', auth()->id())
                    ->groupBy('from')
                    ->get();

            foreach($senders as $sender){
                $contacts[] = DB::table('user_basic_infos')->where(function($query) use ($search){
                        $query->where('first_name','LIKE',"%$search%")
                              ->orWhere('last_name','LIKE',"%$search%");
                    })->where('user_id', '!=', auth()->id())->where('user_id', $sender->sender_id)->first();            
            }

            $t_contacts = array_filter($contacts);

                if(empty($t_contacts)){
                    return "no";
                }

            $contacts = collect($contacts);
                    
            } else {

                // get all users except the authenticated one
                //$contacts = User::where('id', '!=', auth()->id())->get();
                $senders = Message::select(\DB::raw('`from` as sender_id'))
                        ->where('to', auth()->id())
                        ->groupBy('from')
                        ->get();

                foreach($senders as $sender){
                    $contacts[] = DB::table('user_basic_infos')->where('user_id', '!=', auth()->id())->where('user_id', $sender->sender_id)->first();            
                }

                $contacts = collect($contacts);
            }


        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            if($contact){
                $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

                return $contact;
            }
        });

        return $contacts;
    }
}