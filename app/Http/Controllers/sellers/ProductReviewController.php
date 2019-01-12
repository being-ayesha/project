<?php

namespace App\Http\Controllers\sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\frontend\ProductReview;
Use App\models\frontend\sellers\Order;
use App\DataTables\frontend\sellers\FeedbackDataTable;
use App\Http\Controllers\EmailController;
use App\models\frontend\sellers\ProductView;
use Common;
use Validator;
use Auth;
class ProductReviewController extends Controller
{

	// Get Feedback list
	public function index(FeedbackDataTable $dataTable){
		$opts['siteName']  = getenv('APP_NAME');
        $opts['pageTitle'] = 'Feedback';
        return $dataTable->render('frontend.sellers.pages.review.feedback',$opts);
	}

   // Insert Reviews From customer
    public function newReview(Request $request){

            $rules=[
                'review_score'   =>'required',
                'comment'        =>'required',
            ];

            $niceNames = [
                'review_score' =>'Review',
                'comment'      =>'Comment',

            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->setAttributeNames($niceNames);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{

                $productReview = new ProductReview();
                $productReview->seller_id     = $request->seller_id;
                $productReview->order_id      = $request->order_id;
                $productReview->review_count  = $request->review_score;
                $productReview->comment       = $request->comment;
                $productReview->save();
                Common::one_time_message('success','Thanks For Review !! Your Order Successfully Completed .');
                return redirect('sellers/'.$request->username);
        }      
    }

    // Cancel Review
    public function cancelReview($username){
        Common::one_time_message('success','Your Order Successfully Completed');
        return redirect('sellers/'.$username);
    }

    public function sendFeedback(Request $request){
        $productReview =  ProductReview::where(['seller_id'=>Auth::user()->id,'order_id'=>$request->order_id])->first();
        $productReview->response       = $response =$request->feedback;
        $productReview->save();
        $order= Order::where('id',$request->order_id)->first();
        EmailController::feedback($order,$response);
        return response()->json(['status'=>1]);
        
    }

    public function productView(Request $request){
        
        $product_id = base64_decode($request->product_id);
        $seller_id  = base64_decode($request->seller_id);

        $productView       = new ProductView();
        $productView->product_id            = $product_id;
        $productView->seller_id             = $seller_id;
        $productView->browser               = $request->header('User-Agent');
        $productView->product_views_date    = date('Y-m-d');
        $productView->save();
    }


}
