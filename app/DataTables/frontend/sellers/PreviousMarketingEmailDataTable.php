<?php

namespace App\DataTables\frontend\sellers;

use App\models\frontend\sellers\EmailCampaign;
use Yajra\DataTables\Services\DataTable;
use Auth;
use DateTime;
class PreviousMarketingEmailDataTable extends DataTable
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
            ->addColumn('recipients', function ($query)
            {

                $recipants         = json_decode($query->recipients);
                if(count($recipants)>1){
                	return "All Buyers & All Buyers who didn't go through with purchase";
                }
                else{
                	foreach ($recipants as $value) {

                		if($value==1){
                			return "All Buyers";
                		}
                		if($value==2){
                			return "All Buyers who didn't go through with purchase";
                		}
                	}

                }
               
            })
            ->rawColumns(['campaign_id','subject','recipients','sent_on'])
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
        $query = EmailCampaign::where(['seller_id'=>Auth::user()->id,'sent_status'=>'success'])->select();
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
            ->addColumn(['data' => 'campaign_id', 'name' => 'campaign_id', 'title' => 'Campaign Id'])
            ->addColumn(['data' => 'subject', 'name' => 'subject', 'title' => 'Subject'])
            ->addColumn(['data' => 'recipients', 'name' => 'recipients', 'title' => 'Recipients'])
            ->addColumn(['data' => 'sent_on', 'name' => 'sent_on', 'title' => 'Sent On'])
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
        return 'frontend\sellers\PreviousMarketingEmail_' . date('YmdHis');
    }
}
