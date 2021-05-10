<?php

namespace Modules\Ums\DataTables;

use Illuminate\Support\Facades\DB;
use Modules\Ums\Entities\ClientRequest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

// models...
use Modules\Ums\Entities\User;

class ClientRequestDataTable extends DataTable
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
                return view('ums::client.request.action', compact('data'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClientRequest $model)
    {
        // user model instance
        $user = $model->newQuery();

        // return data
        return $user;
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
            $fullName = "Full Name";
            $companyName = "Company Name";
            $phone = "Phone";
            $email = "E-mail";
            $createdAt = "Created At";
            $action = "Action";
            $serial = "ID";
        } else {
            $fullName = "Volledige naam";
            $companyName = "Bedrijfsnaam";
            $phone = "Telefoon";
            $email = "E-mail";
            $createdAt = "Gemaakt bij";
            $action = "Actie";
            $serial = "ID";
        }

        return [
            Column::computed('DT_RowIndex')
                ->title($serial),
            Column::make('full_name')->title($fullName),
            Column::make('phone')->title($phone),
            Column::make('email')->title($email),
            Column::make('company_name')->title($companyName),
            Column::make('created_at')->title($createdAt),
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
        return 'ClientRequest_' . date('YmdHis');
    }
}
