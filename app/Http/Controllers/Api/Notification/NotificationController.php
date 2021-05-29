<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use Exception;
use App\Services\NotificationService\Implement\PatientNotificationService;

class NotificationController extends Controller
{

    protected $notificationService;

    public function __construct(PatientNotificationService $service)
    {
        $this->notificationService = $service;
    }

    public function sendTokenNotification()
    {
    }

    public function sendTopicNotification()
    {
    }

    public function sendNotification()
    {

        try {
            $recipients = [
                'eAm6tFtDR4mQCmn2YT7MMR:APA91bG9LFxfYrYeojJ0dYmrXRuZFE9vFctBtriQb0tg-0c6ofzrW4-a9UzIffm9xeS9DDcbcaRZzmbH3CMi1sJjgbVeEBSspvZuAboWbzrOQma8Md-ItRX0WtaHA_PwTcWLTcocqyjC'
            ];

            fcm()
                ->toTopic('news')
                ->priority('normal')
                ->timeToLive(0)
                ->notification([
                    'title' => 'News Notification',
                    'body' => 'This is a test of New Notification',
                    'image' => 'https://i.ibb.co/ssb5mKk/amado.png'
                ])
                ->send();

            return response()->json([
                'message' => 'notification send'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e
            ]);
        }
    }
}
