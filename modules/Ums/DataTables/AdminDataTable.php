<?php

namespace Modules\Ums\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\User;

class AdminDataTable extends DataTable
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
                return view('ums::admin.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        // user model instance
        $user = $model->newQuery();

        // apply joins
        $user->join('user_basic_infos as user_basic_info', 'users.id', 'user_basic_info.user_id')
            ->join('user_basic_infos as approver_basic_info', 'users.approved_by', 'approver_basic_info.user_id');

        // select queries
        $user->select([
            'users.id',
            'users.phone',
            'users.email',
            DB::raw('CONCAT(user_basic_info.first_name, if(user_basic_info.last_name is not null, CONCAT(" ", user_basic_info.last_name), "")) as name'),
            DB::raw('CONCAT(approver_basic_info.first_name, if(approver_basic_info.last_name is not null, CONCAT(" ", approver_basic_info.last_name), "")) as approver_name'),
            'users.created_at'
        ]);

        // filter admin
        $user->where('users.role', 'admin');

        // return data
        return $user;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        if(\Illuminate\Support\Facades\App::getLocale() == 'en') {
            $create = "Create";
            $export = "Export";
            $print = "Print";
            $reload = "Reload";
            $langUrl = "";
        } else {
            $create = "Creëer";
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
                Button::make('create')->text($create),
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
            $name = "Name";
            $phone = "Phone";
            $email = "E-mail";
            $registeredBy = "Registered By";
            $registeredAt = "Registered At";
            $email = "E-mail";
            $action = "Action";
            $serial = "ID";
        } else {
            $name = "Naam";
            $phone = "Telefoon";
            $email = "E-mail";
            $registeredBy = "Geregistreerd door";
            $registeredAt = "Geregistreerd bij";
            $action = "Actie";
            $serial = "ID";
        }

        return [
            Column::computed('DT_RowIndex')
                ->title($serial),
            Column::make('name')->name('user_basic_info.first_name')->title($name), // alias used,
            Column::make('name')->name('user_basic_info.last_name')->hidden()->title($name), // alias used,
            Column::make('phone')->title($phone),
            Column::make('email')->title($email),
            Column::make('approver_name')->name('approver_basic_info.first_name')->title($registeredBy), // alias used
            Column::make('approver_name')->name('approver_basic_info.last_name')->hidden()->title($registeredBy), // alias used
            Column::make('created_at')->title($registeredAt),
            Column::computed('action')->title($action)
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
        return 'User_' . date('YmdHis');
    }
}
