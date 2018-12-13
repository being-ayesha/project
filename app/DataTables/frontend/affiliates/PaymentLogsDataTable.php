<?php

namespace App\DataTables\frontend\affiliates;

;
use Yajra\DataTables\Services\DataTable;
use App\models\frontend\User;
use App\models\frontend\sellers\Order;
use App\models\frontend\sellers\Product;
use App\models\frontend\affiliates\AffiliatePayout;
use Auth;
class PaymentLogsDataTable extends DataTable
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

            ->editColumn('seller_id', function ($affiliate)
            {
               return '<a target="_blank" href="'.url('sellers/'.$affiliate->user->username).'">'.$affiliate->user->username.'</a>';
            })

            ->editColumn('payment_method_id', function ($affiliate)
            {
               return $affiliate->paymentMethod->name;
            })

            ->editColumn('amount', function ($affiliate)
            {
            return '<p>$'.$affiliate->amount.'</p>';
            })

            ->rawColumns(['seller_id','amount','payment_method','transaction_id','notes','date'])
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
        $query = AffiliatePayout::where(['affiliate_user_id'=>Auth::user()->id])->with('paymentMethod');
        //dd($query->get());
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
            ->addColumn(['data' => 'seller_id', 'name' => 'seller_id', 'title' => 'Seller Username'])
            ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'])
            ->addColumn(['data' => 'payment_method_id', 'name' => 'payment_method_id', 'title' => 'Payment Method'])
            ->addColumn(['data' => 'transaction_id', 'name' => 'transaction_id', 'title' => 'Transaction ID'])
            ->addColumn(['data' => 'notes', 'name' => 'notes', 'title' => 'Notes'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date'])
            // ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Options', 'orderable' => false, 'searchable' => false])
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
