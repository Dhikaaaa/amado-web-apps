<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NotificationService\Implement\PatientNotificationService;

class NotificationPatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientNotificationService $service)
    {
        $this->patientService = $service;
    }

    public function saveApiToken(Request $request)
    {
        $result = $this->patientService->saveToken($request);
        if ($result) {
            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'message' => 'token berhasil disimpan'
            ]);
        }

        return response()->json([
            'code' => 400,
            'status' => 'gagal',
            'message' => 'token gagal disimpan'
        ]);
    }

    public function updateApiToken()
    {
    }

    public function deleteApiToken()
    {
    }

    public function getApiToken()
    {
    }

    public function saveTopic()
    {
    }

    public function updateTopic()
    {
    }

    public function deleteTopic()
    {
    }

    public function getTopic()
    {
    }
}
