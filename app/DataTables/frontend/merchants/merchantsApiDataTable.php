<?php

namespace App\DataTables\frontend\merchants;

use Yajra\DataTables\Services\DataTable;
use App\models\frontend\merchants\MerchantApp;
use Auth;
class merchantsApiDataTable extends DataTable
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
            
            ->editColumn('scope', function ($merchants)
            {
            	$scope =json_decode($merchants->scope);
            	$newScope='';
            	foreach ($scope as $key => $value) {
            		$newScope .= $value.'*'.'<br>';
            	}
               return $newScope;
            })
            ->editColumn('action',function($merchants){

            	$view = '';
                $delete = '';

                $view ='<button type="button" class="btn btn-primary btn-sm" id="secrect_key_modal" data-secrect="'.$merchants->app_secrect.'" data-appId="'.$merchants->app_id.'"><i class="fa fa-eye"></i></button>&nbsp;';

                $delete ='<a class="btn btn-sm btn-outline-danger deleteApi" data-rel="'.$merchants->app_id.'"><i class="fa fa-trash"></i></a>';
                
                return $view.$delete;

            })
            
            ->setRowId(function ($merchants) {
                return 'tr_'.$merchants->app_id;
            })
            ->rawColumns(['app_name','app_description','scope','action'])
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
        $query = MerchantApp::where(['merchant_id'=>Auth::user()->id]);
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
            ->addColumn(['data' => 'app_name', 'name' => 'app_name', 'title' => 'Application Name'])
            ->addColumn(['data' => 'app_description', 'name' => 'app_description', 'title' => 'Application Description'])
            ->addColumn(['data' => 'scope', 'name' => 'scope', 'title' => 'Scops'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Credentials', 'orderable' => false, 'searchable' => false])
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
        return 'frontend\affiliates\AffiliateProducts_' . date('YmdHis');
    }
}
