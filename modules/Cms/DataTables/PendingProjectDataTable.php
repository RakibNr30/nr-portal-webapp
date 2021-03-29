<?php

namespace Modules\Cms\DataTables;

use Illuminate\Support\Facades\DB;
use Modules\Cms\Entities\Project;
use Modules\Ums\Entities\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PendingProjectDataTable extends DataTable
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
                return view('cms::project.pending.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        // Project model instance
        $project = $model->newQuery();

        // select queries
        $project->select([
            'projects.id',
            'projects.title',
            'projects.project_id',
            'projects.deadline'
        ])
        ->where('projects.status', 0)
        ->orderBy('created_at', 'desc');

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('client')) {
            $project->where('projects.author_id', $user->id);
        }

        // return data
        return $project;
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
                //Button::make('create'),
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
            Column::make('project_id'),
            Column::make('title'),
            //Column::make('deadline'),
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
        return 'PendingProject_' . date('YmdHis');
    }
}
