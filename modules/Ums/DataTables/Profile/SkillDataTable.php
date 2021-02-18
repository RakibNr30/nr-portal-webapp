<?php

namespace Modules\Ums\DataTables\Profile;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserSkill;

class SkillDataTable extends DataTable
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
                return view('ums::profile.skill.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserSkill $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserSkill $model)
    {
        // user_content model instance
        $user_skill = $model->newQuery();

        // apply joins
        $user_skill->join('user_personal_infos', 'user_skills.user_id', 'user_personal_infos.id')
            ->join('users', 'user_skills.user_id', 'users.id');

        // select queries
        $user_skill->select([
            'user_skills.id',
            'users.username as username',
            DB::raw('CONCAT(user_personal_infos.first_name," ",user_personal_infos.last_name) as name'),
            'user_skills.name as skill',
            'user_skills.proficiency',
            'user_skills.updated_at'
        ]);

        // other condition
        $user_skill->where('user_skills.user_id', auth()->user()->id);

        // return data
        return $user_skill;
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
            Column::make('skill')->name('user_skills.name'), // alias used
            Column::make('proficiency'),
            Column::make('updated_at')->hidden(),
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
        return 'UserSkill_' . date('YmdHis');
    }
}
