<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;

class NotificationController extends BaseController
{
    /**
     * Get notifications by user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotificationsByUser(User $user)
    {
        $user->load(['notifications' => function ($query) {
            $query->latest()->get();
        }]);
        return response()->json($user->notifications);
    }

    public function markNotificationAsRead(Notification $notification)
    {
        $notification->vue = true;
        $notification->save();
        return $this->sendResponse('', "Notification marquée comme lue");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|min:20|max:3000',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $notification = Notification::create($request->all());

        $this->sendResponse($notification, "Notification envoyée");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Notification $notification)
    {
        $notification->lue = true;
        $notification->save();
        $this->sendResponse($notification, "Notification marquée comme lue", 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
