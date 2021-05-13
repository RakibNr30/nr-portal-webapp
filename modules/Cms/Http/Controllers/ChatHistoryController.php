<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use App\Message;
use Modules\Cms\DataTables\ChatHistoryDataTable;

class ChatHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:chat_history']);
    }

    /**
     * Page list
     *
     * @param ChatHistoryDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ChatHistoryDataTable $datatable)
    {
        return $datatable->render('cms::chat_history.index');
    }

    /**
     * Show page.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get chats
        $message = Message::find($id);
        // check if page doesn't exists
        if (empty($message)) {
            // flash notification
            notifier()->error('Message not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::chat_history.show', compact('message'));
    }
}
