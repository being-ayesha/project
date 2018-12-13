<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\Product;
use Yajra\DataTables\Services\DataTable;
use Auth;
use DateTime;
class LastOrderListDataTable extends DataTable
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
             ->addColumn('id', function ($order)
            {
                return $order->id;
            })
             ->addColumn('product_id', function ($order)
            {
                return "<a href=".url('buy/'.base64_encode(Auth::user()->username).'/'.$order->product->product_uuid).">".$order->product->product_title."</a>";
            })
           
            ->addColumn('action', function ($coupon)
            {
                $view='<a href="'. url('seller/view-order/'.$coupon->order_uuid) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>&nbsp;';
                return $view;
            })
            ->addColumn('payment_method_id', function ($order)
            {
                return "<a href=".url($order->payment->id).">".$order->payment->name."</a>";
            })

            ->rawColumns(['id','order_uuid','product_id','buyer_email','delivery_status','order_date','payment_method_id','action'])

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
        
        $query = Order::where(['seller_id'=>Auth::user()->id])->orderBy('id', 'desc')->take(10);
      
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
            ->addColumn(['data' => 'id', 'name' => 'orders.id', 'title' => 'Order Id','orderable' => true,'searchable'=> true,'visible' => false])
            ->addColumn(['data' => 'order_uuid', 'name' => 'orders.order_uuid', 'title' => 'Order Id'])
            ->addColumn(['data' => 'product_id', 'name' => 'orders.product_id', 'title' => 'Product Title'])
            ->addColumn(['data' => 'buyer_email', 'name' => 'orders.buyer_email', 'title' => 'Buyer E-mail'])
            ->addColumn(['data' => 'amount', 'name' => 'orders.amount', 'title' => 'Amount'])
            ->addColumn(['data' => 'payment_method_id', 'name' => 'orders.payment_method_id', 'title' => 'Payment Method'])
            ->addColumn(['data' => 'payment_status', 'name' => 'orders.payment_status', 'title' => 'Status'])
            ->addColumn(['data' => 'order_date', 'name' => 'orders.order_date', 'title' => 'Date'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Options', 'orderable' => false, 'searchable' => false])
            ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => ['csv'],
            "iDisplayLength"=> 10,
            "bPaginate"=> false,
            "bFilter"=>false,
            "bInfo"> false,
            ]);
    }

        /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'frontend\sellers\Coupons_' . date('YmdHis');
    }
}
