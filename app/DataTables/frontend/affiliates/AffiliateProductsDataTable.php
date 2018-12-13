<?php

namespace App\DataTables\frontend\affiliates;

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

            ->editColumn('product_title', function ($affiliate)
            {
                return '<a target="_blank" href="'.url('buy/'.base64_encode($affiliate->sellerUser->username).'/'.$affiliate->affiliateProduct->product_uuid).'">'.@$affiliate->affiliateProduct->product_title.'</a>';
            })

            ->editColumn('affiliate_product_url', function ($affiliate)
            {
                return '<a target="_blank" href="'.$affiliate->affiliate_product_url.'">'.@$affiliate->affiliate_product_url.'</a>';
            })
            ->editColumn('price', function ($affiliate)
            {
                return '<p>$'.$affiliate->affiliateProduct->price.'</p>';
            })
            ->editColumn('affiliate_rate', function ($affiliate)
            {
                return '<p>'.(float)$affiliate->affiliateProduct->affiliate_rate.'%</p>';
            })

            ->editColumn('stock', function ($affiliate)
            {

                $order = $affiliate->affiliateOrder($affiliate->product_id);
                   
                $number_of_sale=0;
                for ($i=0; $i <count($order); $i++) { 
                    $number_of_sale = $number_of_sale+(float)$order[$i]->product_quantity;
                }

               return '<p>'.$number_of_sale.'</p>';

            })

            ->editColumn('commission', function ($affiliate)
            {

                $order = $affiliate->affiliateOrder($affiliate->product_id);

                $commission=0;
                for ($i=0; $i <count($order); $i++) { 
                    $commission = $commission+(float)$order[$i]->affiliate_amount;
               }

                return '<p>$'.$commission.'</p>';
            })
            ->rawColumns(['product_title','affiliate_product_url','price','affiliate_rate','stock','commission'])
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
        $query = AffiliateProduct::where(['affiliate_id'=>Auth::user()->id])->with('affiliateProduct');
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
            ->addColumn(['data' => 'product_title', 'name' => 'product_id', 'title' => 'Product Title'])
            ->addColumn(['data' => 'affiliate_product_url', 'name' => 'affiliate_product_url', 'title' => 'Affiliate Product Url'])
            ->addColumn(['data' => 'price', 'name' => 'price', 'title' => 'Product Price'])
            ->addColumn(['data' => 'affiliate_rate', 'name' => 'affiliate_rate', 'title' => 'Product Affiliate Percent'])
            ->addColumn(['data' => 'stock', 'name' => 'stock', 'title' => 'Number Of Sale'])
            ->addColumn(['data' => 'commission', 'name' => 'commission', 'title' => 'Total Commossion'])
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
