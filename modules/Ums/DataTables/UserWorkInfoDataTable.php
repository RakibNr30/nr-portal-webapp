<?php

namespace Modules\Ums\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserWorkInfo;

class UserWorkInfoDataTable extends DataTable
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
                return view('ums::user_work_info.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserWorkInfo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserWorkInfo $model)
    {
        // user_work_info model instance
        $user_work_info = $model->newQuery();

        // apply joins
        $user_work_info->join('user_personal_infos', 'user_work_infos.user_id', 'user_personal_infos.id')
            ->join('users', 'user_work_infos.user_id', 'users.id');

        // select queries
        $user_work_info->select([
            'user_work_infos.id',
            'users.username as username',
            DB::raw('CONCAT(user_personal_infos.first_name," ",user_personal_infos.last_name) as name'),
            'user_work_infos.company_name',
            'user_work_infos.department',
            'user_work_infos.designation',
            'user_work_infos.start_date',
            'user_work_infos.end_date',
            'user_work_infos.updated_at'
        ]);

        // return data
        return $user_work_info;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('data_table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bflrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reload')
            )
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
        return [
            Column::computed('DT_RowIndex')
                ->title('Sl'),
            Column::make('username')->name('users.username')->hidden(), // alias used
            Column::make('name')->name('user_personal_infos.first_name'), // alias used
            Column::make('name')->name('user_personal_infos.last_name')->hidden(), // alias used
            Column::make('company_name'),
            Column::make('department'),
            Column::make('designation'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('updated_at'),
            Column::computed('action')
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
        return 'UserWorkInfo_' . date('YmdHis');
    }
}
