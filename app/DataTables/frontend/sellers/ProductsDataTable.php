<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\Product;
use Yajra\DataTables\Services\DataTable;
use Auth;
class ProductsDataTable extends DataTable
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
            ->addColumn('product_uuid',function($product)
            {
                return $product->product_uuid;
            })
            ->editColumn('product_title', function ($product)
            {
                return '<a href="' . url('seller/edit-product/' . @$product->product_uuid) . '">'.@$product->product_title.'</a>';
            })
            ->editColumn('product_photo',function($product){
                //$img = $product->product_photo;
                 return '<img src="'.url('public/uploads/sellers/products/'.$product->product_photo).'" alt="Product Photo" height="42" width="42" style="border-radius:5px">';

            })
            ->addColumn('product_type_id',function($product)
            {
                if($product->productType->name=='file'){ 
                    $file = 'file Download';
                    return '<span class="badge badge-primary">'.ucfirst($file).'</span>';
                }else if($product->productType->name=='code'){
                    return '<span class="badge badge-info">'.ucfirst($product->productType->name).'</span>';
                }else{
                    return '<span class="badge badge-dark">'.ucfirst($product->productType->name).'</span>';
                }
            })
            ->addColumn('payment_method',function($product){
                return $product->paymentMethod->name;
            })
            ->addColumn('stock',function($product)
            {
                if($product->stock=='-1'){
                    return '<span class="badge badge-info">'.'Unlimited'.'</span>';
                }else{
                    return $product->stock;
                }
            })
            ->addColumn('action', function ($product)
            {
                $edit = '';

                $edit = '<a href="' . url('seller/edit-product/' . @$product->product_uuid) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>&nbsp;';

                return $edit;
            })
            ->rawColumns(['product_uuid','product_title','product_photo','product_type_id','payment_method','stock','action'])
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
        // $query = User::orderBy('id', 'desc');
        //d(Auth::user(),1);
        $query = Product::where(['seller_id'=>Auth::user()->id])->select();
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
            ->addColumn(['data' => 'product_uuid', 'name' => 'products.product_uuid', 'title' => 'Id'])
            ->addColumn(['data' => 'product_title', 'name' => 'products.product_title', 'title' => 'Title'])
            ->addColumn(['data' => 'product_photo', 'name' => 'products.product_photo', 'title' => 'Photo'])
            ->addColumn(['data' => 'product_type_id', 'name' => 'products.product_type_id', 'title' => 'Type'])
            ->addColumn(['data' => 'payment_method', 'name' => 'products.payment_method', 'title' => 'Payment method'])
            ->addColumn(['data' => 'stock', 'name' => 'products.stock', 'title' => 'Stock'])
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
        return 'frontend\Products_' . date('YmdHis');
    }
}
