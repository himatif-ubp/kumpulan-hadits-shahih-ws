<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;

class NotifCT extends Controller
{
    public function sentNotif(){
    	$notificationBuilder = new PayloadNotificationBuilder('my title');
		$notificationBuilder->setBody('Hello world')
		->setSound('default');

		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData(['data' =>  ]);

		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();

		$topic = new Topics();
		$topic->topic('news');

		$topicResponse = FCM::sendToTopic($topic, null, null, $data);
		// $topicResponse = FCM::sendTo($topic, $option, $notification, $data);

		// return "$topicResponse";
		$topicResponse->isSuccess();
		$topicResponse->shouldRetry();
		$topicResponse->error();
		return json_encode($topicResponse->isSuccess());
    }
}
