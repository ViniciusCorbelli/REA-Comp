<?php

namespace App\DataTables;

use App\Models\Topic;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TopicDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($query) {
                return date('Y/m/d', strtotime($query->created_at));
            })
            ->addColumn('action', 'topics.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Topic $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        $model = Topic::query();
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html() {
        return $this->builder()
            ->setTableId('dataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')

            ->parameters([
                "processing" => true,
                "autoWidth" => false,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns() {
        return [
            ['data' => 'name', 'name' => 'name', 'title' => __('topics.datatable.name'), 'orderable' => false],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => __('topics.datatable.create_date')],
            Column::computed('action', __('topics.datatable.action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center hide-search'),
        ];
    }
}
