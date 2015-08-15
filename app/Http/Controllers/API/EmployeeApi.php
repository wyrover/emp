<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Estar\Excel\TableExport;
use App\Office;
use App\Position;
use App\Company;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estar\Eloquent\RepoEmployee;
use App\VisaHandle;
use App\VisaType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeApi extends Controller
{
    private  $employeeRepo;
    public function __construct(RepoEmployee $employeeRepo)
    {
        $this->middleware('auth');
        $this->employeeRepo = $employeeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //js文件传递一个含&perpage=xx的地址,用来传递每页所显示记录数

        if (isset($_GET['perpage']) && !empty($_GET['perpage']))
        {
            $perpage = $_GET['perpage'];
        }else{
            $perpage = 15;
        }

        if($perpage == 'all')
        {
            $query = $this->employeeRepo->allWithRelation(['position','company','office','visaType','visaHandle']);
            $data = \Response::json([
                'total' => $query->count(),
                'per_page'=>$query->count(),
                'current_page'=>1,
                'last_page'=>1,
                'from'=>1,
                'to'=>$query->count(),
                'data'=> $query->toArray()
            ]);
        }else
            $data = $this->employeeRepo->allWithRelationPaginate(['position','company','office','visaType','visaHandle'],$per_page = $perpage );

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $peopleOnPosition = Position::get(['id','name']);
        $peopleOnOffice = Office::get(['id','name']);
        $peopleOnCompany = Company::get(['id','name']);
        $visatype = VisaType::get(['id','type']);
        $visahandle = VisaHandle::get(['id','method']);

        $data = \Response::json([
            'position'=>$peopleOnPosition
                ->map(function($item){
                    return [
                        'text'=>$item->name,
                        'value'=>$item->id
                    ];
                }),
            'office'=>$peopleOnOffice
                ->map(function($item){
                    return [
                        'text'=>$item->name,
                        'value'=>$item->id
                    ];
                }),
            'company'=>$peopleOnCompany
                ->map(function($item){
                    return [
                        'text'=>$item->name,
                        'value'=>$item->id
                    ];
                }),
            'visatype'=>$visatype
                ->map(function($item){
                    return [
                        'text'=>$item->type,
                        'value'=>$item->id
                    ];
                }),
            'visahandle'=>$visahandle
                ->map(function($item){
                    return [
                        'text'=>$item->method,
                        'value'=>$item->id
                    ];
                }),
        ],200);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(Auth::user()->level()<2){
            return '权限不够';
        }
        $input = \Request::all();
        $data = $this->employeeRepo->create($input);
        return $data->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $employee = $this->employeeRepo->find($id);
        $passport_deadline = $employee->passport_deadline;
        $visa_deadline = $employee->visa_deadline;
        $land_deadline = $employee->land_deadline;

        $data = \Response::json([
            'name'=>$employee->name,
            'id'=>$employee->id,
            'memo'=>$employee->memo,
            'company'=>$employee->company,
            'position'=>$employee->position,
            'office'=>$employee->office,
            'passport'=>$employee->passport,
            'reached_at'=>$employee->reached_at,
            'pinyin'=>$employee->pinyin,
            'visa_type'=>$employee->visaType,
            'passport_date'=>$employee->passport_date,
            'passport_deadline'=>$passport_deadline,
            'passport_deadline_diff'=>$this->getDiffDays($passport_deadline),
            'visa_deadline'=>$visa_deadline,
            'visa_deadline_diff'=>$this->getDiffDays($visa_deadline),
            'land_deadline'=>$land_deadline,
            'land_deadline_diff'=>$this->getDiffDays($land_deadline),
            'visa_handle'=>$employee->visaHandle,
        ],200);

        return $data;
    }

    public function export()
    {
        $query =  $this->employeeRepo->allWithRelation(['position','company','office','visaType','visaHandle']);
        $data = $query->map(function($item){
            return[
                '姓名'=>$item->name,
                '岗位'=>$item->position['name'],
                '人员归属'=>$item->company['name'],
                '所在地'=>$item->office['name'],
                '护照号'=>$item->passport,
                '发照日期'=>$item->passport_date,
                '护照有效期'=>$item->passport_deadline,
                '签证类型'=>$item->visaType['type'],
                '签证期限'=>$item->visa_deadline,
                '落地签期限'=>$item->land_deadline,
                '签证或落地签办理预案'=>$item->visaHandle['method'],
                '赴哈时间'=>$item->reached_at,
            ];
        });

        \Excel::create('EstarTable',function($excel) use($data){
            $excel->setTitle("iStar Office")
                        ->setCreator('iStar Office');
            $excel->sheet('人员统计表',function($sheet) use($data){
                $sheet->setAutoSize(true);
                $sheet->fromArray($data);
            });
        })->download('xls');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        if(Auth::user()->level()<2){
            return '权限不够';
        }
        $input = \Request::all();
        $this->employeeRepo->update($input,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $data
     * @return Response
     */
    public function destroy($data)
    {
        if(Auth::user()->level()<2){
            return '权限不够';
        }
        $ids = explode(',',$data);
        foreach ($ids as $id) {
            $this->employeeRepo->delete($id);
        }

    }

    private function getDiffDays($time)
    {
        $now = new \DateTime('now');
        $t = new \DateTime($time);
        return $now->diff($t)->days;
    }
}
