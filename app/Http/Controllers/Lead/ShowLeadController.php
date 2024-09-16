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

class ShowLeadController extends Controller
{
    /**
     * Summary of leadRepository
     * @var 
     */
    protected $leadRepository;
    /**
     * Summary of __construct
     * @param \App\Repositories\LeadRepository $leadRepository
     */
    public function __construct(LeadRepository $leadRepository){

        $this->middleware('auth:api');

        $this->leadRepository = $leadRepository;

    }
    /**
     * Handle the incoming id.
     * Summary of __invoke
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke($id)
    {
        //
        $lead = $this->leadRepository->getById($id);

        if($lead) {

            return response()->json(data: [
                'meta' => [
                    'success' => true
                    , 'errors' => []
                ], 'data' => new ShowLeadResource(
                    resource: $lead
                )
            ], status: 200);

        }

        return response()->json(data: [
            'meta' => [
                'success' => false
                , 'errors' => [
                    'No lead found'
                ]
            ]
        ], status: 404);

    }
}
