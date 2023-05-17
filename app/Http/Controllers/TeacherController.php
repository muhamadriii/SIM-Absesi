<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Teacher;
use DataTables;
use View;
use Storage;
use Hash;


class TeacherController extends Controller
{
    protected $view;
    protected $route;

    public function __construct(Teacher $model){
        $this->model = $model;
        $this->route = 'teacher.';
        $this->view = 'pages.teacher.';

        View::share('route', $this->route);
        View::share('view', $this->view);
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = $this->model->orderBy('name')->get();
            return Datatables::of($data)->addIndexColumn()
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
                'role' => 'required',
                'nip' => 'required|numeric|max_digits:18|min_digits:18',
                'jk' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'telp' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            $payload = $request->all();
            $payload['telp'] = Str_replace([ '(', ')', '_', '-' ], '', $request->telp);
            $payload['password'] = Hash::make($request->password);
            if($request->file('image')) {
                $filename = $request->name.'-'.Str::random(5).'-'.$request->file('image')->getClientOriginalName();
                Storage::putFileAs(
                    'public/images/teacher',
                    $request->file('image'),
                    $filename
                );
                $payload['image'] = $filename;
            }
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
                'role' => 'required',
                'nip' => 'required|numeric|max_digits:18|min_digits:18',
                'jk' => 'required',
                'dob' => 'required',
                'address' => 'required',
                'telp' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $payload = $request->all();
            $payload['telp'] = Str_replace([ '(', ')', '_', '-' ], '', $request->telp);
            $payload['password'] = Hash::make($request->password);
            if($request->file('image')) {
                $filename = $request->name.'-'.Str::random(5).'-'.$request->file('image')->getClientOriginalName();
                Storage::putFileAs(
                    'public/images/teacher',
                    $request->file('image'),
                    $filename
                );
                $payload['image'] = $filename;
            }
            $data = $this->model->find($id);
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
            $teacher = $this->model->find($id);
            $data = $teacher->delete();

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