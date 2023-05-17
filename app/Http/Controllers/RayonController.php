<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rayon;
use App\Models\Teacher;
use DataTables;
use View;


class RayonController extends Controller
{
    protected $view;
    protected $route;

    public function __construct(Rayon $model){
        $this->model = $model;
        $this->teacher = Teacher::orderBy('name')->get();
        $this->route = 'rayon.';
        $this->view = 'pages.rayon.';

        View::share('teachers', $this->teacher);
        View::share('route', $this->route);
        View::share('view', $this->view);
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = $this->model->orderBy('name')->with('teacher')->get();
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('teacher', function ($row) { // cheking relation
                    $fname = !empty($row->teacher->name) ? $row->teacher->name : '-';
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
            $data = $this->model->find($id);
            $data = $data->delete();

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