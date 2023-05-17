<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use DataTables;
use View;


class MajorController extends Controller
{
    protected $view;
    protected $route;

    public function __construct(Major $model){
        $this->model = $model;
        $this->route = 'major.';
        $this->major = Major::whereNull('parent_id')->orderBy('name')->get();
        $this->view = 'pages.major.';

        View::share('route', $this->route);
        View::share('major', $this->major);
        View::share('view', $this->view);
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = $this->model->orderBy('name')->with('parent')->get();
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('parent', function ($row) {  //this example  for edit your columns if colums is empty 
                    $fname = !empty($row->parent->name) ? $row->parent->name : '-';
                    return $fname;
                })
                ->addColumn('action', function($row){
                    $btn = '                        
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-ver"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a type="button" class="btn btn-light-primary btn-icon btn-sm ml-3 edit-btn" data-id="'.$row->id.'"  data-toggle="tooltip" title="Edit" data-placement="left">
                                    <i class="flaticon-edit-1"></i>
                                </a>
                                <a type="button" class="btn btn-light-danger btn-icon btn-sm delete-btn" data-id="'.$row->id.'"  data-toggle="tooltip" title="Delete" data-placement="left">
                                    <i class="flaticon-delete-1"></i>
                                </a>
                            </div>
                        </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($this->view.'index');
    }

    public function store(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $payload = $request->all();
            $data = $this->model->create($payload);
           
            $response = [
                'success' => true,
                'message' => 'Success save data',
                'data' => $data
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Server Error',
                'data' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }

    }


    public function show($id)
    {
        try {
            $data = $this->model->find($id);

            $response = [
                'success' => true,
                'message' => 'Success retrieve data',
                'data' => $data
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Server Error',
                'data' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $payload = $request->all();
            $data = $this->model->find($id);

            if($request->file('image'))
            $payload['image'] = FileHelper::saveImage($request->file('image'),500, public_path("categories"));

            $data = $data->update($payload);

            $response = [
                'success' => true,
                'message' => 'Success save data',
                'data' => $data
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
            return response()->json($response, 500);
        }
    }


    public function destroy($id){
        try {
            $major = $this->model->find($id);
            $data = $major->delete();

            $response = [
                'success' => true,
                'message' => 'Success delete data',
                'data' => $data
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
            return response()->json($response, 500);
        }
    }


}