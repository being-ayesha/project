<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\Product;
use App\models\frontend\affiliates\AffiliateProduct;
use Yajra\DataTables\Services\DataTable;
use App\models\frontend\User;
use App\models\frontend\sellers\Order;
use Auth;
class AffiliateProductsDataTable extends DataTable
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

               return '<a target="_blank" href="'.url('sellers/'.$affiliate->affiliateUser->username).'">'.$affiliate->affiliateUser->username.'</a>';
            })

            ->editColumn('stock', function ($affiliate)
            {
                $order = $affiliate->totalAffiliateOrder($affiliate->affiliate_id);
                   
                $number_of_sale=0;
                for ($i=0; $i <count($order); $i++) { 
                    $number_of_sale = $number_of_sale+(float)$order[$i]->product_quantity;
                }
               return '<p>'.$number_of_sale.'</p>';

             })

            ->editColumn('commission', function ($affiliate)
            {

                $order = $affiliate->totalAffiliateOrder($affiliate->affiliate_id);

                $commission=0;
                for ($i=0; $i <count($order); $i++) { 
                    $commission = $commission+(float)$order[$i]->affiliate_amount;
               }

                return '<p>$'.$commission.'</p>';
            })

            ->editColumn('amount_owed', function ($affiliate)
            {

                $order = $affiliate->totalAffiliateOrder($affiliate->affiliate_id);

                $commission=0;
                for ($i=0; $i <count($order); $i++) { 
                    $commission = $commission+(float)$order[$i]->affiliate_amount;
               }

               $total= $affiliate->affiliatePayout($affiliate->affiliate_id);
                $total_amount=0;
                for ($i=0; $i <count($total); $i++) { 
                    $total_amount = $total_amount+(float)$total[$i]->amount;
               }

                return '<p>$'.($commission-$total_amount).'</p>';
            })



            ->editColumn('amount_paid', function ($affiliate)
            {
                $total= $affiliate->affiliatePayout($affiliate->affiliate_id);
                $total_amount=0;
                for ($i=0; $i <count($total); $i++) { 
                    $total_amount = $total_amount+(float)$total[$i]->amount;
               }

                return '<p>$'.$total_amount.'</p>';

             })
            
            ->rawColumns(['seller_id','stock','commission','amount_owed','amount_paid'])
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
        $query = AffiliateProduct::where(['seller_id'=>Auth::user()->id])->with('affiliateUser');
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
            ->addColumn(['data' => 'seller_id', 'name' => 'product_id', 'title' => 'Affiliate Username'])
            ->addColumn(['data' => 'commission', 'name' => 'commission', 'title' => 'Total Commossion'])
            ->addColumn(['data' => 'stock', 'name' => 'stock', 'title' => 'Number Of Order'])
            ->addColumn(['data' => 'amount_owed', 'name' => 'amount', 'title' => 'Amount Owed'])
            ->addColumn(['data' => 'amount_paid', 'name' => 'amount', 'title' => 'Amount Paid'])
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
