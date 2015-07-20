<?php

namespace App\Http\Controllers\API;

use App\Estar\Eloquent\RepoCompany;
use App\Estar\Eloquent\RepoEmployee;
use App\Estar\Eloquent\RepoOffice;
use App\Estar\Eloquent\RepoPosition;
use App\Office;
use App\Position;
use App\Company;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeApi extends Controller
{
    private  $employeeRepo;
    public function __construct(RepoEmployee $repoEmployee,RepoPosition $repoPosition,RepoOffice $repoOffice,RepoCompany $repoCompany)
    {
        $this->employeeRepo = $repoEmployee;
        $this->positionRepo = $repoPosition;
        $this->officeRepo = $repoOffice;
        $this->companyRepo = $repoCompany;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employeeCount = $this->employeeRepo->count();
        $positionCount = $this->positionRepo->count();
        $officeCount = $this->officeRepo->count();
        $companyCount = $this->companyRepo->count();
        $latestPassport = $this->employeeRepo->latest(['passport_deadline','name'],'passport_deadline','asc',3);
        $latestVisa = $this->employeeRepo->latest(['visa_deadline','name'],'visa_deadline','asc',3);

        $peopleOnPosition = Position::leftJoin('employees', 'employees.position_id', '=', 'positions.id')
        ->groupBy('positions.id')
        ->get(['positions.id','positions.name', \DB::raw('count(employees.id) as counts')]);

        $peopleOnOffice = Office::leftJoin('employees', 'employees.office_id', '=', 'offices.id')
        ->groupBy('offices.id')
        ->get(['offices.id','offices.name', \DB::raw('count(employees.id) as counts')]);

        $peopleOnCompany = Company::leftJoin('employees', 'employees.company_id', '=', 'companies.id')
        ->groupBy('companies.id')
        ->get(['companies.id','companies.name', \DB::raw('count(employees.id) as counts')]);


        //全局默认company id=1 为本公司
        $ourEmployees = $this->employeeRepo->countBy('company_id',1);


        $data = \Response::json([
            'employeeCount' => $employeeCount,
            'ourEmployees' => $ourEmployees,
            'officeCount'=>$officeCount,
            'companyCount'=>$companyCount,
            'positionCount'=>$positionCount,
            'latestPassport' => $latestPassport,
            'latestVisa'=>$latestVisa,
            'position'=>$peopleOnPosition,
            'office'=>$peopleOnOffice,
            'company'=>$peopleOnCompany
            ],200);

        return $data;
    }

 }
