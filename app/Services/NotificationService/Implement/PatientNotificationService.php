<?php

namespace App\Services\NotificationService\Implement;

use App\Repositories\NotificationRepository\Implement\PatientNotificationRepository;
use App\Services\NotificationService\NotificationTokenService;
use App\Services\NotificationService\NotificationTopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

const FIREBASE_API_TOKEN_REQUIRED = 0;

class PatientNotificationService implements NotificationTokenService, NotificationTopicService
{

    protected $notificationRepository;


    public function __construct(PatientNotificationRepository $repo)
    {
        $this->notificationRepository = $repo;
    }

    public function sendTokenNotification()
    {
    }

    public function saveToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firebaseApiToken' => 'required'
        ]);

        if ($validator->fails()) {
            return FIREBASE_API_TOKEN_REQUIRED;
        }

        $patientHasBeenAuthenticated = Auth::guard('patientapi')->user();
        $firebaseToken = $request->firebaseApiToken;

        $result = $this->notificationRepository->saveToken($patientHasBeenAuthenticated->id, $firebaseToken);

        return $result;
    }

    public function updateToken(Request $request)
    {
    }

    public function deleteToken(Request $request)
    {
    }

    public function sendTopicNotification($topic, $message, $patient_id)
    {
    }

    public function saveTopic($patient_id, $topic)
    {
    }

    public function updateTopic($patient_id, $topic)
    {
    }

    public function deleteTopic($patient_id, $topic)
    {
    }

    public function getTopic($patient_id, $topic)
    {
    }
}
