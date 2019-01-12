<?php

namespace App\DataTables\frontend\sellers;
use Yajra\DataTables\Services\DataTable;
use App\models\frontend\ProductReview;
use Auth;
class FeedbackDataTable extends DataTable
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
             ->addColumn('product_id', function ($feedback)
            {
                return @$feedback->orderDetails->product->product_title;
            })

            ->addColumn('order_id', function ($feedback)
            {
                return @$feedback->orderDetails->order_uuid;
            })

            ->addColumn('action', function ($feedback)
            {
               $send='<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_default" data-popup="tooltip" title="Send Your Response" data-placement="bottom" data-order="'.$feedback->order_id.'" id="reply"><i class="fa fa-mail-reply"></i></button>';
                return $send;
            })

            ->rawColumns(['review_count','comment','response','update_at','action'])
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
        $query = ProductReview::where(['seller_id'=>Auth::user()->id,])->select()->with('orderDetails');
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
            ->addColumn(['data' => 'review_count', 'name' => 'review_count', 'title' => 'Rating'])
            ->addColumn(['data' => 'comment', 'name' => 'comment', 'title' => 'Comment'])
            ->addColumn(['data' => 'response', 'name' => 'response', 'title' => 'Your Response'])
            ->addColumn(['data' => 'product_id', 'name' => '', 'title' => 'Product Title' ,'searchable' => false,])
            ->addColumn(['data' => 'order_id', 'name' => 'order_id', 'title' => 'Order Id'])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Last Update'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Options', 'orderable' => false, 'searchable' => false,'width'=>'100px'])
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
