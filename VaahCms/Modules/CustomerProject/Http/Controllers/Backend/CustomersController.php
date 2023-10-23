<?php namespace VaahCms\Modules\CustomerProject\Http\Controllers\Backend;

use App\Jobs\FillItemJob;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use VaahCms\Modules\CustomerProject\Models\Customer;
use WebReinvent\VaahCms\Models\Media;
use WebReinvent\VaahCms\Models\Notification;
use WebReinvent\VaahCms\Models\Permission;
use WebReinvent\VaahCms\Models\User;


class CustomersController extends Controller
{


    //----------------------------------------------------------
    public function __construct()
    {

    }

    //----------------------------------------------------------

    public function getAssets(Request $request)
    {

        try{

            $data = [];

//            $data['permission'] = [];
            Permission::syncPermissionsWithRoles();

            $data['permission'] = [];
            $data['permission'] = \Auth::user()->permissions(true);

//            $data['active_permissions'] = Permission::getActiveItems();

            $data['rows'] = config('vaahcms.per_page');
            $image_data = Media::getList($request);
            $data['images']=$image_data['data']['list'];

            $data['fillable']['columns'] = Customer::getFillableColumns();
            $data['fillable']['except'] = Customer::getUnFillableColumns();
            $data['empty_item'] = Customer::getEmptyItem();
            $data['product_count'] = Customer::getCustomersWithProductCounts();
            $data['country_data'] = Customer::getTaxonomyCountry();
            $data['state_data'] = Customer::getTaxonomyState();



            $data['actions'] = [];

            $response['success'] = true;
            $response['data'] = $data;

        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
        }

        return $response;
    }

    //----------------------------------------------------------
    public function getList(Request $request)
    {
        try{
            return Customer::getList($request);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function updateList(Request $request)
    {
        try{
            return Customer::updateList($request);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';

            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function listAction(Request $request, $type)
    {


        try{
            return Customer::listAction($request, $type);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;

        }
    }

//    public function listAction(Request $request, $type)
//    {
//        try {
//            // Call the listAction method from the Customer model
//            $response = Customer::listAction($request, $type);
//
//            // Check if the action was successful
//            if ($response['success']) {
//                // Dispatch the FillItemJob when the action is successful
//                if ($type == 'create-100-records' || $type == 'create-1000-records' || $type == 'create-5000-records' || $type == 'create-10000-records') {
//                    $is_response_return = true; // Set this based on your requirements
//                    Queue::push(new FillItemJob($is_response_return));
//                }
//
//                return response()->json([
//                    'success' => true,
//                    'data' => $response['data'],
//                    'messages' => ['Action was successful.'],
//                ]);
//            } else {
//                return response()->json([
//                    'success' => false,
//                    'errors' => $response['errors'],
//                ], 400);
//            }
//        } catch (\Exception $e) {
//            $response = [];
//            $response['success'] = false;
//
//            if (env('APP_DEBUG')) {
//                $response['errors'][] = $e->getMessage();
//                $response['hint'] = $e->getTrace();
//            } else {
//                $response['errors'][] = 'Something went wrong.';
//            }
//
//            return response()->json($response, 500);
//        }
//    }

    //----------------------------------------------------------
    public function deleteList(Request $request)
    {
        try{
            return Customer::deleteList($request);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function fillItem(Request $request)
    {
        try{
            return Customer::fillItem($request);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function createItem(Request $request)
    {
        try{
            return Customer::createItem($request);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function getItem(Request $request, $id)
    {
        try{
            return Customer::getItem($id);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function updateItem(Request $request,$id)
    {
        try{
            return Customer::updateItem($request,$id);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function deleteItem(Request $request,$id)
    {
        try{
            return Customer::deleteItem($request,$id);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }
    //----------------------------------------------------------
    public function itemAction(Request $request,$id,$action)
    {
        try{
            return Customer::itemAction($request,$id,$action);
        }catch (\Exception $e){
            $response = [];
            $response['success'] = false;
            if(env('APP_DEBUG')){
                $response['errors'][] = $e->getMessage();
                $response['hint'] = $e->getTrace();
            } else{
                $response['errors'][] = 'Something went wrong.';
            }
            return $response;
        }
    }

    //----------------------------------------------------------

public function sendNotification(Request $request): array
{
    try {
        $id = $request->input('data');
        $notify = Customer::notify($id);

        $response['success'] = true;
        $response['message'] = $notify;
        return $response;

    } catch (\Exception $e) {
        $response = [];
        $response['success'] = false;
        if (env('APP_DEBUG')) {
            $response['errors'][] = $e->getMessage();
            $response['hint'] = $e->getTrace();
        } else {
            $response['errors'][] = 'Something went wrong.';
        }
        return $response;
    }
}

    public function uploadImage(Request $request): array
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $file = $request->file('file');

        $path = $file->store('public/media');

        $url = Storage::url($path);

        $response['success'] = true;
        $response['data'] = $url;
        $response['messages'][] = 'Image uploaded successfully';
        return $response;
    }

}
