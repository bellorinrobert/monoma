<?php
/**
 * Summary of namespace App\Repositories
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-15
 * 
 */
namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lead\ShowLeadResource;
use App\Repositories\LeadRepository;
use Illuminate\Http\Request;

class IndexLeadController extends Controller
{
    /**
     * Summary of leadRespository
     * @var 
     */
    protected $leadRespository;
    /**
     * Summary of __construct
     * @param \App\Repositories\LeadRepository $leadRepository
     */
    public function __construct(LeadRepository $leadRepository) {
        $this->middleware('auth:api');
        
        $this->leadRespository = $leadRepository;

    }
    /**
     * Handle the incoming request.
     * Summary of __invoke
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)    {
        //
        $leads = $this->leadRespository->getAll();
        
        return response()->json(data: [
            'meta' => [
                'success' => true
                , 'errors' => []
            ], 'data' => ShowLeadResource::collection(resource: $leads)
        ]);
    }
}
