<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use View;

class AttendanceController extends Controller
{
    protected $view;
    protected $route;

    public function __construct(Attendance $model){
        $this->model = $model;
        $this->route = 'attendance.';
        $this->view = 'pages.attendance.';

        View::share('route', $this->route);
        // View::share('attendance', $this->attendance);
        View::share('view', $this->view);
    }

    public function index(){
        return view($this->view.'index');
    }

    public function getData(){
        try {
            $students = Student::get();
            $datas = [];
            foreach ($students as $k=>$student){
                $datas[$k]['student'] = $student;
                for ($i=1;$i<=31;$i++){
                    $year   = date('Y');
                    $month  = date('m');
                    $date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i));
                    $datas[$k]['date'][$year . '-' . $month . '-' . $i] = Attendance::whereNis($student->nis)->where('date', $date)->first();
                }
            }
            $response = [
                'success' => true,
                'message' => 'Success save data',
                'data' => $datas
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => NUll
            ];
            return response()->json($response, 500);
        }

    }

    public function presence(Request $request){
        try {
            $request->validate([
                'nis'=> 'required',
                'status'=> 'required',
                'date'=> 'required',
            ]);
            $payload = $request->all();
            $payload['teacher_id'] = 1;
            $datas = Attendance::whereNis($payload['nis'])->whereDate('date',$payload['date'])->first();
            $datas ? $datas->update($payload) : $datas = Attendance::create($payload);
            $response = [
                'success' => true,
                'message' => 'Success save data',
                'data' => $datas
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => NUll
            ];
            return response()->json($response, 500);
        }
    }
}
