<?php

namespace App\Repositories\NotificationRepository\Implement;

use App\Repositories\NotificationRepository\NotificationTokenRepository;
use App\Repositories\NotificationRepository\NotificationTopicRepository;
use App\Models\Patient\Patient;

class PatientNotificationRepository implements NotificationTokenRepository, NotificationTopicRepository
{

    protected $patientModel;

    public function __construct(Patient $model)
    {
        $this->patientModel = $model;
    }

    public function saveToken($patient_id, $token): Patient
    {
        $this->patientModel::where('id', $patient_id)->update(['firebase_api_token' => $token]);

        return $this->patientModel::find($patient_id);
    }

    public function deleteToken($patient_id, $token)
    {
    }

    public function updateToken($patient_id, $token)
    {
    }

    public function getToken($patient_id)
    {
    }

    public function saveTopic($patient_id, $topic)
    {
    }

    public function deleteTopic($patient_id, $topic)
    {
    }

    public function updateTopic($patient_id, $topic)
    {
    }

    public function getTopic($patient_id, $topic)
    {
    }

    public function getPatient($patient_id)
    {
    }

    public function getPhoto($patient_id)
    {
    }
}
