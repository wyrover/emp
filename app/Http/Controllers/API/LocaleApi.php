<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Estar\Eloquent\RepoOffice;
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

class LocaleApi extends Controller
{
    private  $employeeRepo;
    private  $officeRepo;
    public function __construct(RepoEmployee $employeeRepo,RepoOffice $officeRepo)
    {
        $this->middleware('auth');
        $this->employeeRepo = $employeeRepo;
        $this->officeRepo = $officeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        /**
         * 获取办公地点数据,并构建json
         */
        $offices = $this->officeRepo->all(['id','name']);
        $office_ids = $offices->map(function($item){
            return [
                'id' => $item->id,
                'name'=>$item->name,
                'employee_counts' => $this->employeeRepo->countBy('office_id',$item->id),
            ];
        });

        /**
         * 初始情况读取office数据表中的第一条ID记录
         */
        $init_id = $offices->lists('id')->first();
        /**
         * 获取从客户端传过来的request
         */
//        if (isset($_GET['locale']) && !empty($_GET['locale']))
//        {
//            $office_id = $_GET['locale'];
//        }else{
//            $office_id = $init_id;
//        }
//        if (isset($_GET['perpage']) && !empty($_GET['perpage']))
//        {
//            $per_page = $_GET['perpage'];
//        }
//        else{
//            $per_page = 15;
//        }
//
//        if($per_page == 'all') {
//            $query = $this->employeeRepo->findByWithRelation('office_id',$office_id,['position','company']);
//            $data = \Response::json([
//                'total' => $query->count(),
//                'per_page'=>$query->count(),
//                'current_page'=>1,
//                'last_page'=>1,
//                'from'=>1,
//                'to'=>$query->count(),
//                'data' => $query->toArray()
//            ], 200);
//
//        }
//        else
//        {
//            $query = $this->employeeRepo->findByWithRelationPaginate('office_id',$office_id,['position','company'],$per_page);
//            $data = \Response::json([
//                'total' => $query->total(),
//                'per_page' => $query->perPage(),
//                'current_page' => $query->currentPage(),
//                'last_page' => $query->lastPage(),
//                'next_page_url' => $query->nextPageUrl(),
//                'prev_page_url' => $query->previousPageUrl(),
//                'from' => $query->firstItem(),
//                'to' => $query->lastItem(),
//                'offices' => $office_ids,
//                'data' => $query->items()
//            ], 200);
//        }
//        return $data;
        $query = $this->employeeRepo->findByWithRelation('office_id',1,['position','company']);

        $position = $query->map(function($item){
            return [
                'counts'=> $item['position']
            ];
        });

//        $data = $position->unique()->values()->all();

        return $position;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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