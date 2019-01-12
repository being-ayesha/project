<?php

namespace App\DataTables\frontend\merchants;

use Yajra\DataTables\Services\DataTable;
use App\models\frontend\merchants\MerchantApp;
use App\models\frontend\merchants\MerchantOrder;
use Auth;
class MerchantsPaymentDataTable extends DataTable
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

            ->addColumn('payment_method_id',function($merchants){
                return $merchants->paymentMethod->name;
            })

            ->addColumn('action',function($merchants){

            	$view ='<a href='.url('merchants/payments-details/'.$merchants->order_uid).' class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>&nbsp;';
                return $view;

            })
            ->rawColumns(['order_id','buyer_email','amount','payment_method_id','status','created_at','action'])
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
        $query = MerchantOrder::where(['merchant_id'=>Auth::user()->id]);
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
            ->addColumn(['data' => 'order_uid', 'name' => 'order_uid', 'title' => 'Order Id'])
            ->addColumn(['data' => 'buyer_email', 'name' => 'buyer_email', 'title' => 'Buyer Email'])
            ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'])
            ->addColumn(['data' => 'payment_method_id', 'name' => 'payment_method_id', 'title' => 'Payment Method'])
            ->addColumn(['data' => 'order_status', 'name' => 'order_status', 'title' => 'Status'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Option', 'orderable' => false, 'searchable' => false,'printable' => false,'exportable' => false])
            ->parameters([
            'dom' => 'lBfrtip',
            'processing' => true,
            'buttons' => ['excel', 'csv', 'print'],
            ]);
    }

        /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Merchant Payments _' . date('YmdHis');
    }
}
