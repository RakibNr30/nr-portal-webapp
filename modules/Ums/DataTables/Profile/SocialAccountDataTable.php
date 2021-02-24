<?php

namespace Modules\Ums\DataTables\Profile;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\UserSocialAccount;

class SocialAccountDataTable extends DataTable
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
                return view('ums::profile.social-account.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param UserSocialAccount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserSocialAccount $model)
    {
        // user_social_account model instance
        $user_social_account = $model->newQuery();

        // apply joins
        $user_social_account->join('social_sites', 'social_sites.id', 'user_social_accounts.social_site_id');

        // select queries
        $user_social_account->select([
            'user_social_accounts.id',
            'social_sites.title as site_name',
            'user_social_accounts.username as site_username',
            'user_social_accounts.updated_at'
        ]);

        // get user accounts
        $user_social_account->where('user_social_accounts.user_id', auth()->user()->id);

        // return data
        return $user_social_account;
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
            Column::make('site_name')->name('social_sites.title'),
            Column::make('site_username')->name('user_social_accounts.username'),
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
        return 'UserSocialAccount_' . date('YmdHis');
    }
}
