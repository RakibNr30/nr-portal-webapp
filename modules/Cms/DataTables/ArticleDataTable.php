<?php

namespace Modules\Cms\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Cms\Entities\Article;

class ArticleDataTable extends DataTable
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
                return view('cms::article.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model)
    {
        // article model instance
        $article = $model->newQuery();
        // apply joins
        $article->join('users as approvers', 'articles.approved_by', 'approvers.id')
            ->join('user_personal_infos as approver_infos', 'articles.approved_by', 'approver_infos.id');

        $article->join('users as authors', 'articles.author_id', 'authors.id')
            ->join('user_personal_infos as author_infos', 'articles.author_id', 'author_infos.id');

        // select queries
        $article->select([
            'articles.id',
            'articles.title',
            'authors.username as author_username',
            'approvers.username as approver_username',
            DB::raw('CONCAT(author_infos.first_name," ",author_infos.last_name) as author_name'),
            DB::raw('CONCAT(approver_infos.first_name," ",approver_infos.last_name) as approver_name'),
            'articles.approve_status',
            'articles.approved_at',
            'articles.updated_at'
        ]);

        // return data
        return $article;
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
            Column::make('title'),
            Column::make('author_username')->name('authors.username')->hidden(), // alias used
            Column::make('author_name')->name('author_infos.first_name'), // alias used
            Column::make('author_name')->name('author_infos.last_name')->hidden(), // alias used
            Column::make('approver_username')->name('approvers.username')->hidden(), // alias used
            Column::make('approver_name')->name('approver_infos.first_name'), // alias used
            Column::make('approver_name')->name('approver_infos.last_name')->hidden(), // alias used
            Column::make('approve_status'),
            Column::make('approved_at'),
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
        return 'Article_' . date('YmdHis');
    }
}
