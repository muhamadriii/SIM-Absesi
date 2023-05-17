<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Major;
use DataTables;
use View;
use Storage;
use Hash;


class StudentController extends Controller
{
    protected $view;
    protected $route;

    public function __construct(Student $model){
        $this->model = $model;
        $this->route = 'student.';
        $this->majors = Major::whereNotNull('parent_id')->get();
        $this->rayons = Rayon::get();
        $this->view = 'pages.student.';

        View::share('route', $this->route);
        View::share('majors', $this->majors);
        View::share('rayons', $this->rayons);
        View::share('view', $this->view);
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = $this->model->orderBy('name')->with('major', 'rayon')->get();
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('major', function ($row) {
                    $majorname = !empty($row->major->name) ? $row->major->name : '-';
                    return $majorname;
                })
                ->editColumn('rayon', function ($row) {
                    $rayonname = !empty($row->rayon->name) ? $row->rayon->name : '-';
                    return $rayonname;
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
                'nis' => 'required|numeric|max_digits:8|min_digits:8',
                'rayon_id' => 'required',
                'major_id' => 'required',
                'jk' => 'required',
                'dob' => 'required',
                'telp' => 'required',
            ]);

            $payload = $request->all();
            $payload['telp'] = Str_replace([ '(', ')', '_', '-' ], '', $request->telp);
            if($request->file('image')) {
                $filename = $request->name.'-'.Str::random(5).'-'.$request->file('image')->getClientOriginalName();
                Storage::putFileAs(
                    'public/images/student',
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
                'nis' => 'required|numeric|max_digits:8|min_digits:8',
                'rayon_id' => 'required',
                'major_id' => 'required',
                'jk' => 'required',
                'dob' => 'required',
                'telp' => 'required',
            ]);

            $payload = $request->all();
            $payload['telp'] = Str_replace([ '(', ')', '_', '-' ], '', $request->telp);
            $payload['password'] = Hash::make($request->password);
            if($request->file('image')) {
                $filename = $request->name.'-'.Str::random(5).'-'.$request->file('image')->getClientOriginalName();
                Storage::putFileAs(
                    'public/images/student',
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
            $student = $this->model->find($id);
            $data = $student->delete();

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