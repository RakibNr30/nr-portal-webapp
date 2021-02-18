<?php

namespace Modules\Ums\DataTables\Profile;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserEducationalInfo;

class EducationalInfoDataTable extends DataTable
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
                return view('ums::profile.educational_info.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserEducationalInfo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserEducationalInfo $model)
    {
        // user_educational_info model instance
        $user_educational_info = $model->newQuery();

        // apply joins
        $user_educational_info->join('user_personal_infos', 'user_educational_infos.user_id', 'user_personal_infos.id')
            ->join('users', 'user_educational_infos.user_id', 'users.id');

        // select queries
        $user_educational_info->select([
            'user_educational_infos.id',
            'users.username as username',
            DB::raw('CONCAT(user_personal_infos.first_name," ",user_personal_infos.last_name) as name'),
            'user_educational_infos.institute_name',
            'user_educational_infos.course_name',
            'user_educational_infos.degree_name',
            'user_educational_infos.start_date',
            'user_educational_infos.end_date',
            'user_educational_infos.institute_website',
            'user_educational_infos.updated_at',
        ]);

        // other condition
        $user_educational_info->where('user_personal_infos.user_id', auth()->user()->id);

        // return data
        return $user_educational_info;
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
            Column::make('name')->name('user_personal_infos.first_name')->hidden(), // alias used
            Column::make('name')->name('user_personal_infos.last_name')->hidden(), // alias used
            Column::make('institute_name'),
            Column::make('course_name')->hidden(),
            Column::make('degree_name')->hidden(),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('institute_website')->hidden(),
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
        return 'UserEducationalInfo_' . date('YmdHis');
    }
}
