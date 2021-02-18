<?php

namespace Modules\Ums\DataTables\Profile;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserContent;

class ContentDataTable extends DataTable
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
                return view('ums::profile.content.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserContent $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserContent $model)
    {
        // user_content model instance
        $user_content = $model->newQuery();

        // content category wise filter
        $user_content->when(request()->get('category'), function ($query) {
            $query->where('content_category_id', request()->get('category'));
        });

        // return data
        return $user_content;
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
                Button::make('create')->action("window.location = '".route('backend.ums.profile-content.create', ['category' => request()->get('category')])."';"),
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
            Column::make('name'),
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
        return 'UserContent_' . date('YmdHis');
    }
}
