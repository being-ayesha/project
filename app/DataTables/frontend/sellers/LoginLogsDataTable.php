<?php

namespace App\DataTables\frontend\sellers;
use Request;
use Yajra\DataTables\Services\DataTable;
use Auth;
use App\models\frontend\UserLogs;
class LoginLogsDataTable extends DataTable
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

             ->addColumn('last_login_at',function($logs){
                $yesterday=date("Y-m-d", time()-86400);
                $today=date("Y-m-d");
                if($yesterday==date('Y-m-d',strtotime($logs->last_login_at))){
                    $last_login= "Yesterday at ".date('H:i:s A',strtotime($logs->last_login_at));
                }else if($today==date('Y-m-d',strtotime($logs->last_login_at))){
                     $last_login= "Today at ".date('H:i:s A',strtotime($logs->last_login_at));
                }else{
                     $last_login= date("F d Y H:i A", strtotime($logs->last_login_at));
                }
                return  $last_login;
            })
            
            ->rawColumns(['last_login_ip','last_login_browser','last_login_country','last_login_at','last_login_status','last_login_details','action'])
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
        
        $query = UserLogs::where(['user_id'=>Auth::user()->id])->orderby('id','DESC')->select();
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
            ->addColumn(['data' => 'last_login_ip', 'name' => 'last_login_ip', 'title' => 'IP'])
            ->addColumn(['data' => 'last_login_browser', 'name' => 'last_login_browser', 'title' => 'Browser'])
            ->addColumn(['data' => 'last_login_country', 'name' => 'last_login_country', 'title' => 'Country'])
            ->addColumn(['data' => 'last_login_at', 'name' => 'last_login_at', 'title' => 'Date'])
            ->addColumn(['data' => 'last_login_status', 'name' => 'last_login_status', 'title' => 'Result'])
            ->addColumn(['data' => 'last_login_details', 'name' => 'last_login_details', 'title' => 'Details'])
            ->parameters([
            'dom'     => 'lBfrtip',
            'buttons' => ['csv'],
            'order'   => [0,'desc'],
            ]);
    }

        /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'frontend\sellers\LoginLogs_' . date('YmdHis');
    }
}
