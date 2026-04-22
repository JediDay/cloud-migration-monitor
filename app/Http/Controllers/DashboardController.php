<?php

namespace App\Http\Controllers;

use App\Services\AwsMigrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected AwsMigrationService $awsService;

    public function __construct(AwsMigrationService $awsService)
    {
        $this->awsService = $awsService;
    }

    public function index(): View
    {
        $migrations = $this->awsService->getMigrationStatuses();
        return view('dashboard', compact('migrations'));
    }

    public function stats(): JsonResponse
    {
        return response()->json([
            'migrations' => $this->awsService->getMigrationStatuses(),
        ]);
    }
}
