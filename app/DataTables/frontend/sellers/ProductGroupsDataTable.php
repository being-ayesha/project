<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\ProductGroups;
use Yajra\DataTables\Services\DataTable;
use Auth;
class ProductGroupsDataTable extends DataTable
{
   /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('product_group_title', function ($productGroups)
            {
                return '<a href="' . url('seller/edit-product-groups/' . @$productGroups->id) . '">'.@$productGroups->product_group_title.'</a>';
            })
            ->addColumn('product_id',function($productGroups){
                return $productGroups->groupProducts($productGroups->product_group_title);
            })
            ->addColumn('action', function ($productGroups)
            {
                $edit = $delete = '';
                $edit = '<a href="' . url('seller/edit-product-groups/' . @$productGroups->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>&nbsp;';
                $delete ='<a class="btn btn-sm btn-outline-danger deleteProductGroup" data-rel="'.$productGroups->id.'"><i class="fa fa-trash"></i></a>';
                return $edit . $delete;
            })
            ->setRowId(function($productGroups){
                return 'tr_'.$productGroups->id;
            })
            ->rawColumns(['product_group_title','product_id','action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = ProductGroups::where(['seller_id'=>Auth::user()->id])->select();
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'product_group_title', 'name' => 'product_groups.product_group_title', 'title' => 'Title'])
            ->addColumn(['data' => 'product_id', 'name' => 'product_groups.product_id', 'title' => 'Products'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Options', 'orderable' => false, 'searchable' => false])
            ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => ['csv'],
            ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'frontend\sellers\ProductGroups_' . date('YmdHis');
    }
}
