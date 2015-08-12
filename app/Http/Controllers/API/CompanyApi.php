<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Estar\Eloquent\RepoCompany;
use App\Estar\Eloquent\RepoOffice;
use App\Estar\Eloquent\RepoPosition;
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

class CompanyApi extends Controller
{
    private  $employeeRepo;
    private  $companyRepo;
    public function __construct(RepoEmployee $employeeRepo,RepoOffice $officeRepo,RepoPosition $positionRepo,RepoCompany $companyRepo)
    {
        $this->middleware('auth');
        $this->employeeRepo = $employeeRepo;
        $this->officeRepo = $officeRepo;
        $this->positionRepo = $positionRepo;
        $this->companyRepo = $companyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        /**
         * 获取公司数据,并构建json
         */
        $companies = $this->companyRepo->all(['id','name']);
        $company_list = $companies->map(function($item){
            return [
                'id' => $item->id,
                'name'=>$item->name,
                'employee_counts' => $this->employeeRepo->countBy('company_id',$item->id),
            ];
        });

        /**
         * 初始情况读取office数据表中的第一条ID记录
         */
        $init_id = $companies->lists('id')->first();
        /**
         * 获取从客户端传过来的request
         */
        if (isset($_GET['company']) && !empty($_GET['company']))
        {
            $company_id= $_GET['company'];
        }else{
            $company_id= $init_id;
        }
        if (isset($_GET['perpage']) && !empty($_GET['perpage']))
        {
            $per_page = $_GET['perpage'];
        }
        else{
            $per_page = 15;
        }


        $query_all = $this->employeeRepo->findByWithRelation('company_id',$company_id,['position','office']);
        $positions = collect($query_all)->map(function($item){
            return $item['position']['name'];
        });
        $position_statistic = array_count_values($positions->toArray());


        if($per_page == 'all') {

            $data = \Response::json([
                'total' => $query_all->count(),
                'per_page'=>$query_all->count(),
                'current_page'=>1,
                'last_page'=>1,
                'from'=>1,
                'to'=>$query_all->count(),
                'companies' => $company_list,
                'positions' => $position_statistic,
                'data' => $query_all->toArray()
            ], 200);

        }
        else
        {
            $query = $this->employeeRepo->findByWithRelationPaginate('company_id',$company_id,['position','office'],$per_page);
            $data = \Response::json([
                'total' => $query->total(),
                'per_page' => $query->perPage(),
                'current_page' => $query->currentPage(),
                'last_page' => $query->lastPage(),
                'next_page_url' => $query->nextPageUrl(),
                'prev_page_url' => $query->previousPageUrl(),
                'from' => $query->firstItem(),
                'to' => $query->lastItem(),
                'companies' => $company_list,
                'positions' => $position_statistic,
                'data' => $query->items()
            ], 200);
        }
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
        $data = $this->companyRepo->create($input);
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
        $this->companyRepo->update($input,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $data
     * @return Response
     */
    public function destroy($id)
    {
        if(Auth::user()->level()<2){
            return '权限不够';
        }

            $this->officeRepo->delete($id);


    }

    private function getDiffDays($time)
    {
        $now = new \DateTime('now');
        $t = new \DateTime($time);
        return $now->diff($t)->days;
    }
}
