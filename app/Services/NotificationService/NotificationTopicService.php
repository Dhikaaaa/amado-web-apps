<?php

namespace App\Services\NotificationService;

interface NotificationTopicService
{
    function sendTopicNotification($topic, $message, $patient_id);
    function saveTopic($patient_id, $topic);
    function updateTopic($patient_id, $topic);
    function deleteTopic($patient_id, $topic);
    function getTopic($patient_id, $topic);
}
