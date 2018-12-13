<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\Coupon;
use Yajra\DataTables\Services\DataTable;
use Auth;
use DateTime;
class CouponsDataTable extends DataTable
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
            ->addColumn('product_ids',function($coupon){
                return $coupon->couponProducts($coupon->product_ids);
            })
            ->addColumn('amount_off',function($coupon){
                $amount= ($coupon->discount_structure=='percent')?$coupon->amount_off."%":"$".$coupon->amount_off;
                return $amount;  
            })

             ->addColumn('stock',function($coupon){
                $stock=($coupon->stock==-1)?"Unlimited":$coupon->stock;
                return $stock;  
            })
            ->addColumn('expiry_date',function($coupon){
                $start_date     = new DateTime($coupon->start_date);
                $end_date       =  new DateTime($coupon->expiry_date);
                
                $date_interval  = $start_date->diff($end_date);
                
                $datetime       =$end_date->format('m/d h:i a');
                $time           =$end_date->format('h:i a');
                $today_date     = new DateTime(date('Y-m-d h:m:i'));

                $checktodayInterval= $end_date->diff($today_date);

                if($coupon->deleted_at==1){
                    return "<p class='badge bg-danger'>Deleted</p>";
                }

                if($checktodayInterval->days<=0){
                    return "<p class='badge badge-dark'>Expired</p>";
                }
               
                if($date_interval->days >= 7){
                    $difference =($date_interval->days/7==1)?"In".' '.floor($date_interval->days/7).' '."Week on".' '.$datetime:"In".' '.floor($date_interval->days/7).' '."Weeks on".' '.$datetime;
                }else{
                    $difference=($date_interval->days==1)?"In".' '.floor($date_interval->days).' '."Day at".' '.$time:"In".' '.floor($date_interval->days).' '."Days at".' '.$time;;
                }

                return $difference;
            })
           
            ->addColumn('action', function ($coupon)
            {
                $edit = '';
                $delete = '';

                $edit = '<a href="'. url('seller/edit-coupon/'.$coupon->id) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>&nbsp;';

                if($coupon->deleted_at!=1){
                 $delete ='<a class="btn btn-sm btn-outline-danger deleteProductCoupon" data-rel="'.$coupon->id.'"><i class="fa fa-trash"></i></a>';
                }else{
                    $delete='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }

                return $edit.$delete;
            })
            ->rawColumns(['coupon_code','product_ids','amount_off','stock','expiry_date','action'])
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
        $query = Coupon::where(['seller_id'=>Auth::user()->id])->select();
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
            ->addColumn(['data' => 'coupon_code', 'name' => 'coupons.coupon_code', 'title' => 'Coupon Code'])
            ->addColumn(['data' => 'product_ids', 'name' => 'coupons.product_ids', 'title' => 'Product Title'])
            ->addColumn(['data' => 'amount_off', 'name' => 'coupons.amount_off', 'title' => 'Amount Off'])
            ->addColumn(['data' => 'number_of_uses', 'name' => 'coupons.number_of_uses', 'title' => 'Number of Uses'])
            ->addColumn(['data' => 'stock', 'name' => 'coupons.stock', 'title' => 'Uses Left'])
            ->addColumn(['data' => 'expiry_date', 'name' => 'coupons.expiry_date', 'title' => 'Expiration Date'])
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
