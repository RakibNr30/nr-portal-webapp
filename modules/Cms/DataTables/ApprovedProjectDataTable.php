<?php

namespace Modules\Cms\DataTables;

use Illuminate\Support\Facades\DB;
use Modules\Cms\Entities\Project;
use Modules\Ums\Entities\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ApprovedProjectDataTable extends DataTable
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
                return view('cms::project.approved.action', compact('data'))->render();
            })
            ->addColumn('file_status', function ($data) {
                return view('cms::project.approved.file-status', compact('data'))->render();
            })->rawColumns(['action', 'file_status']);
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
        $project->join('user_basic_infos as approver_basic_info', 'projects.approved_by', 'approver_basic_info.user_id');

        // select queries
        $project->select([
            'projects.id',
            'projects.title',
            'projects.project_id',
            'projects.approved_at',
            'projects.deadline',
            DB::raw('CONCAT(approver_basic_info.first_name, if(approver_basic_info.last_name is not null, CONCAT(" ", approver_basic_info.last_name), "")) as approver_name'),
        ])
            ->where('projects.status', 1)
            ->orderBy('projects.created_at', 'desc');

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('client')) {
            $project->where('projects.author_id', $user->id);
        }

        if ($user->hasRole('company')) {
            $project->whereJsonContains('projects.company_id', $user->id);
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
            $title = "Title";
            $projectId = "Project Id";
            $action = "Action";
            $serial = "ID";
            $approvedAt = "Approved At";
            $fileStatus = "File Status";
        } else {
            $title = "Titel";
            $projectId = "Project Id";
            $action = "Actie";
            $serial = "ID";
            $approvedAt = "Goedgekeurd op";
            $fileStatus = "Bestandsstatus";
        }

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('super_admin') || $user->hasRole('admin')) {
            return [
                Column::computed('DT_RowIndex')
                    ->title($serial),
                Column::make('project_id')->title($projectId),
                Column::make('title')->title($title),
                Column::make('approved_at')->title($approvedAt),
                //Column::make('deadline'),
                Column::computed('file_status')->title($fileStatus)
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
                Column::make('approved_at')->title($approvedAt),
                //Column::make('deadline'),
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
        return 'ApprovedProject_' . date('YmdHis');
    }
}
