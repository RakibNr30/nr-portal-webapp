<?php

namespace Modules\Cms\DataTables;

use Illuminate\Support\Facades\DB;
use Modules\Cms\Entities\Project;
use Modules\Ums\Entities\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AllProjectDataTable extends DataTable
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
                return view('cms::project.all.action', compact('data'))->render();
            })
            ->addColumn('status', function ($data) {
                return view('cms::project.all.status', compact('data'))->render();
            })->rawColumns(['action', 'status']);
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
        $project->join('user_basic_infos as author_basic_info', 'projects.author_id', 'author_basic_info.user_id')
            ->join('user_residential_infos as author_residential_info', 'projects.author_id', 'author_residential_info.user_id');

        // select queries
        $project->select([
            'projects.id',
            'projects.title',
            'projects.project_id',
            'projects.approved_at',
            'projects.deadline',
            'projects.status',
            'author_residential_info.present_address_line_1 as author_address',
            DB::raw('CONCAT(author_basic_info.first_name, if(author_basic_info.last_name is not null, CONCAT(" ", author_basic_info.last_name), "")) as author_name'),
        ])
        ->orderBy('projects.created_at', 'desc');

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('client')) {
            $project->where('projects.author_id', $user->id);
        }

        if ($user->hasRole('company')) {
            $project->whereJsonContains('projects.company_id', $user->id)
            ->where('projects.status', '!=', 0);
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
            $customerAddress = "Customer Address";
            $title = "Title";
            $projectId = "Project Id";
            $status = "Status";
            $action = "Action";
            $serial = "ID";
        } else {
            $customerName = "Klantnaam";
            $customerAddress = "Klant adres";
            $title = "Titel";
            $projectId = "Project Id";
            $status = "Status";
            $action = "Actie";
            $serial = "ID";
        }

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('company')) {
            return [
                Column::computed('DT_RowIndex')
                    ->title($serial),
                Column::make('project_id')->title($projectId),
                Column::make('title')->title($title),
                Column::make('author_name')->name('author_basic_info.first_name')->title($customerName),
                Column::make('author_address')->name('author_residential_info.present_address_line_1')->title($customerAddress),
                Column::computed('status')->title($status)
                    ->addClass('text-center'),
                Column::computed('action')->title($action)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        }
        else {
            return [
                Column::computed('DT_RowIndex')
                    ->title($serial),
                Column::make('project_id')->title($projectId),
                Column::make('title')->title($title),
                Column::computed('status')->title($status)
                    ->addClass('text-center'),
                Column::computed('action')->title($action)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        }
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AllProject_' . date('YmdHis');
    }
}
