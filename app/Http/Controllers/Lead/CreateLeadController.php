<?php
/**
 * Summary of namespace App\Repositories
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-15
 * 
 */
namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\CreateLeadRequest;
use App\Http\Resources\Lead\ShowLeadResource;
use App\Repositories\LeadRepository;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


class CreateLeadController extends Controller
{
    protected $leadRepository;
    /**
     * Handle the incoming request.
     */
    public function __construct(LeadRepository $leadRepository) {
        $this->middleware('auth:api');
        
        $this->leadRepository = $leadRepository;

    }
    public function __invoke(CreateLeadRequest $request)
    {
        //
        // try {
            $data = $request->toArray();
            
            $data['created_by'] = JWTAuth::user()->id;

            $lead = $this->leadRepository->create($data);

            return response()->json(data: [
                'meta' => [
                    'success' => true
                    , 'errors' => []
                ], 'data' => new ShowLeadResource(
                    resource: $lead
                )
            ], status: 201);


        // } catch (\Error $e) {
        //     return response()->json(data: [
        //         'meta' => [
        //             'success' => false
        //             , 'errors' => ['Token expired']
        //         ]
        //     ], status: 401);
        // }

    }
}
