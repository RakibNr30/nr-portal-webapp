<?php

namespace Modules\Cms\DataTables;

use App\Message;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ChatHistoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                //return view('cms::chat_history.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Message $model)
    {
        // Message model instance
        $message = $model->newQuery();

        // apply joins
        $message->join('user_basic_infos as sender_basic_info', 'messages.from', 'sender_basic_info.user_id')
            ->join('user_basic_infos as receiver_basic_info', 'messages.to', 'receiver_basic_info.user_id');

        // select queries
        $message->select([
            'messages.*',
            DB::raw('CONCAT(sender_basic_info.first_name, if(sender_basic_info.last_name is not null, CONCAT(" ", sender_basic_info.last_name), "")) as sender_name'),
            DB::raw('CONCAT(receiver_basic_info.first_name, if(receiver_basic_info.last_name is not null, CONCAT(" ", receiver_basic_info.last_name), "")) as receiver_name'),
        ])
        ->orderByDesc('messages.created_at');

        // return data
        return $message;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        if(\Illuminate\Support\Facades\App::getLocale() == 'en') {
            $export = "Export";
            $print = "Print";
            $reload = "Reload";
            $langUrl = "";
        } else {
            $export = "Exporteren";
            $print = "Afdrukken";
            $reload = "Herlaad";
            $langUrl = asset('admin/json/dt-dutch.json');
        }

        return $this->builder()
            ->setTableId('data_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bflrtip')
            ->orderBy(1)
            ->buttons(
            //Button::make('create'),
                Button::make('export')->text($export),
                Button::make('print')->text($print),
                Button::make('reload')->text($reload)
            )
            ->language([
                'url' => $langUrl
            ])
            ->parameters([
                'pageLength' => 10
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if(\Illuminate\Support\Facades\App::getLocale() == 'en') {
            $serial = "ID";
            $sender = "Sender";
            $receiver = "Receiver";
            $message = "Message";
            $action = "Action";
            $deliveredtAt = "Delivered At";
        } else {
            $serial = "ID";
            $sender = "Afzender";
            $receiver = "Ontvanger";
            $message = "Bericht";
            $action = "Actie";
            $deliveredtAt = "Geleverd aan";
        }

        return [
            Column::computed('DT_RowIndex')
                ->title($serial),
            Column::make('sender_name')->name('sender_basic_info.first_name')->title($sender),
            Column::make('receiver_name')->name('receiver_basic_info.first_name')->title($receiver),
            Column::make('message')->title($message),
            Column::make('created_at')->title($deliveredtAt)
            //Column::computed('action')->title($action)
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AcceptedProject_' . date('YmdHis');
    }
}
