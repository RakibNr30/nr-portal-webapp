<?php

namespace Modules\Cms\DataTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

        // apply joins
        $project->join('user_basic_infos as author_basic_info', 'projects.author_id', 'author_basic_info.user_id');

        // select queries
        $project->select([
            'projects.id',
            'projects.title',
            'projects.project_id',
            'projects.deadline',
            DB::raw('CONCAT(author_basic_info.first_name, if(author_basic_info.last_name is not null, CONCAT(" ", author_basic_info.last_name), "")) as author_name'),
        ])
        ->where('projects.status', 0)
        ->orderBy('projects.created_at', 'desc');

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
            $customerName = "Customer Name";
            $title = "Title";
            $action = "Action";
            $serial = "ID";
        } else {
            $customerName = "Klantnaam";
            $title = "Titel";
            $action = "Actie";
            $serial = "ID";
        }
        return [
            Column::computed('DT_RowIndex')
                ->title($serial),
            Column::make('author_name')->name('author_basic_info.first_name')->title($customerName),
            Column::make('title')->title($title),
            //Column::make('deadline'),
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
        return 'PendingProject_' . date('YmdHis');
    }
}
