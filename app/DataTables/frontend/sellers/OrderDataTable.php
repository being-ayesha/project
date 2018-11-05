<?php

namespace App\DataTables\frontend\sellers;
use Request;
use App\models\frontend\sellers\Order;
use Yajra\DataTables\Services\DataTable;
use App\models\frontend\sellers\Product;
use App\models\frontend\PaymentMethod;
use Auth;
class OrderDataTable extends DataTable
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

            ->addColumn('order_uuid', function ($order)
            {
                return "<a href=". url('seller/view-order/'.$order->order_uuid).">".$order->order_uuid."</a>";
            })

            ->addColumn('product_id', function ($order)
            {
                return "<a href=".url($order->product->product_uuid).">".$order->product->product_title."</a>";
            })

            ->addColumn('buyer_email', function ($order)
            {
                return "<a href=".url($order->buyer_email).">".$order->buyer_email."</a>";
            })

            ->addColumn('payment_method_id', function ($order)
            {
                return "<a href=".url($order->payment->id).">".$order->payment->name."</a>";
            })

            ->addColumn('payment_status', function ($order)
            {
                return ($order->payment_status=='paid')?"<p class='badge bg-success'>PAID</p>":"<p class='badge bg-purple'>UNPAID</p>";
            })

            ->addColumn('action', function ($order)
            {

                $view = '';
                $delete = '';

                $view ='<a href='. url('seller/view-order/'.$order->order_uuid) . ' class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>&nbsp;';

                $delete ='<a class="btn btn-sm btn-outline-danger deleteOrder" data-rel="'.$order->order_uuid.'"><i class="fa fa-trash"></i></a>';
                
                return $view.$delete;
            })
            ->addColumn('order_date',function($order){
                $yesterday=date("Y-m-d", time()-86400);
                $today=date("Y-m-d");
                if($yesterday==date('Y-m-d',strtotime($order->order_date))){
                    $order_date= "Yesterday at ".date('H:i:s A',strtotime($order->order_date));
                }else if($today==date('Y-m-d',strtotime($order->order_date))){
                     $order_date= "Today at ".date('H:i:s A',strtotime($order->order_date));
                }else{
                     $order_date= date("F d Y H:i A", strtotime($order->order_date));
                }
                return  $order_date;
            })

            ->setRowId(function ($order) {
                return 'tr_'.$order->order_uuid;
            })

            ->rawColumns(['order_uuid','product_id','buyer_email','amount','payment_method_id','payment_status','order_date','action'])
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
        $status    = Request::segment(3);
 
        if($status){
            $query = Order::with('product','payment')->where(['seller_id'=>Auth::user()->id,'payment_status'=>$status])->select();
        }else{
            $query = Order::with('product','payment')->where(['seller_id'=>Auth::user()->id,'payment_status'=>'paid'])->select();
        }
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
            ->addColumn(['data' => 'buyer_email', 'name' => 'orders.buyer_email', 'title' => 'Buyer E-mail'])
            ->addColumn(['data' => 'amount', 'name' => 'orders.amount', 'title' => 'Amount'])
            ->addColumn(['data' => 'payment_method_id', 'name' => 'orders.payment_method_id', 'title' => 'Payment Method'])
            ->addColumn(['data' => 'payment_status', 'name' => 'orders.payment_status', 'title' => 'Status'])
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
        return 'frontend\sellers\Order_' . date('YmdHis');
    }
}
