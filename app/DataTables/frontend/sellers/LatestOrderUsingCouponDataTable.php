<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\Product;
use Yajra\DataTables\Services\DataTable;
use Auth;
use DateTime;
class LatestOrderUsingCouponDataTable extends DataTable
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
             ->addColumn('product_id', function ($order)
            {
                return "<a href=".url($order->product->product_uuid).">".$order->product->product_title."</a>";
            })
           
            ->addColumn('action', function ($coupon)
            {
                $view='<a href="'. url('seller/view-order/'.$coupon->order_uuid) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>&nbsp;';
                return $view;
            })

            ->rawColumns(['order_uuid','product_id','buyer_email','delivery_status','order_date','payment_method_id','action'])

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
        $coupon_id = $this->coupon_id;
        $query = Order::where(['seller_id'=>Auth::user()->id,'coupon_code'=>$coupon_id])->select();
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
            ->addColumn(['data' => 'order_uuid', 'name' => 'orders.order_uuid', 'title' => 'Order Id'])
            ->addColumn(['data' => 'product_id', 'name' => 'orders.product_id', 'title' => 'Product Title'])
            ->addColumn(['data' => 'buyer_email', 'name' => 'orders.buyer_email', 'title' => 'Buyer Email'])
            ->addColumn(['data' => 'delivery_status', 'name' => 'orders.delivery_status', 'title' => 'Status'])
            ->addColumn(['data' => 'order_date', 'name' => 'orders.order_date', 'title' => 'Date'])
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
        return 'frontend\sellers\Coupons_' . date('YmdHis');
    }
}
