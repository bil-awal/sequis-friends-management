<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\v1\V1Friendship;
use Illuminate\Http\Request;

class V1FriendshipController extends Controller
{
    public function friend(Request $request)
    {
        // 0. Try to get the friend list
        try {
            // 1. Validate the request
            $request = self::emailValidation($request);

            // 2. Get the friend list
            $getFriends = V1Friendship::where('requestor', $request['email'])
                ->where('status', 'accepted')
                ->get();

            // 3. Return the friend list
            $friends = [];
            foreach ($getFriends as $friendship) {
                $friends[] = $friendship->to;
            }

            // 4. Return success
            return response()->json([
                'friends' => $friends
            ], 200);
        }

        // 5. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    public function request(Request $request)
    {
        // 0. Try to create a friendship
        try {
            // 1. Validate the request
            $request = self::requestValidation($request);

            // 2. Filter from bloked users
            $is_bloked = self::isBlocked($request['requestor'], $request['to']);

            // 3. If the user is blocked, return error
            if ($is_bloked) {
                return self::responseFailed('The user is blocked', 400);
            }

            // 4. If the user is not blocked, create the friendship
            else {
                V1Friendship::firstOrCreate([
                    'requestor' => $request['requestor'],
                    'to' => $request['to'],
                ]);

                // 5. Return success
                return self::responseSuccess();
            }
        }

        // 6. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    public function accept(Request $request)
    {
        // 0. Try to accept the friendship
        try {
            // 1. Validate the request
            $request = self::requestValidation($request);

            // 2. Find the pending request
            $friendship = self::findPendingRequest($request['requestor'], $request['to']);

            // 3. If the friendship is not found, return error
            if (!$friendship) {
                return self::responseFailed('The friendship request is not found', 400);
            }

            // 4. If the friendship is found, update the status
            else {
                $friendship->status = 'accepted';
                $friendship->save();

                // 5. Return success
                return self::responseSuccess();
            }
        }

        // 6. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    public function reject(Request $request)
    {
        // 0. Try to reject the friendship
        try {
            // 1. Validate the request
            $request = self::requestValidation($request);

            // 2. Find the friendship
            $friendship = self::findPendingRequest($request['requestor'], $request['to']);

            // 3. If the friendship is not found, return error
            if (!$friendship) {
                return self::responseFailed('The friendship request is not found', 400);
            }

            // 4. If the friendship is found, update the status
            else {
                $friendship->status = 'rejected';
                $friendship->save();

                // 5. Return success
                return self::responseSuccess();
            }
        }

        // 6. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    public function pending(Request $request)
    {
        // 0. Try to get the pending requests
        try {
            // 1. Validate the request
            $request = self::requestValidation($request);

            // 2. Find friends
            $is_friend = self::isFriend($request['requestor'], $request['to']);

            // 3. If the users are friends, update the status to 'pending'
            if ($is_friend) {
                $friendship = V1Friendship::where('requestor', $request['requestor'])
                    ->where('to', $request['to'])
                    ->first();

                $friendship->status = 'pending';
                $friendship->save();

                // 4. Return success
                return self::responseSuccess();
            }

            // 5. If the users are not friends, return error
            else {
                return self::responseFailed('The users are not friends', 400);
            }
        }

        // 4. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    public function requestList(Request $request) {
        // 0. Try to get the request list
        try {
            // 1. Validate the request
            $request = self::emailValidation($request);

            // 2. Get the request list
            $getFriends = V1Friendship::where('to', $request['email'])->get();

            // 3. Return the request list
            $friends = [];
            foreach ($getFriends as $friendship) {
                $friends[] = [
                    'requestor' => $friendship->requestor,
                    'status' => $friendship->status
                ];
            }

            // 4. Return success
            return response()->json([
                'requests' => $friends
            ], 201);

        }

        // 5. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    public function requestBlock(Request $request)
    {
        // 0. Try to block the friendship
        try {
            // 1. Validate the request
            $request = self::requestValidation($request);

            // 2. Filter from already friendship
            $is_friend = self::isFriend($request['requestor'], $request['block']);

            // 3. If the user is already friend, update the friendship
            if ($is_friend) {
                $is_friend->status = 'blocked';
                $is_friend->save();
            }

            // 4. If the user is not friend, create the friendship and block
            else {
                V1Friendship::firstOrCreate([
                    'requestor' => $request['requestor'],
                    'to' => $request['block'],
                    'status' => 'blocked',
                ]);
            }

            // 5. Return success
            return self::responseSuccess();

        }

        // 6. Catch all exceptions
        catch (\Exception $e) {
            return self::responseFailed($e->getMessage(), 500);
        }
    }

    private static function requestValidation($request) {
        return $request->validate([
            'requestor' => 'required|string',
            'to' => 'nullable|string',
            'block' => 'nullable|string',
        ]);
    }

    private static function emailValidation($request) {
        return $request->validate([
            'email' => 'required|string'
        ]);
    }

    private static function isBlocked($requestor, $to) {
        return V1Friendship::where('requestor', $to)
        ->where('to', $requestor)
        ->where('status', 'blocked')
        ->first();
    }

    private static function isFriend($requestor, $to) {
        return V1Friendship::where('requestor', $requestor)
        ->where('to', $to)
        ->where('status', 'accepted')
        ->first();
    }

    private static function findPendingRequest($requestor, $to) {
        return V1Friendship::where('requestor', $requestor)
        ->where('to', $to)
        ->where('status', 'pending')
        ->first();
    }

    private static function responseSuccess() {
        return response()->json([
            'success' => true
        ], 201);
    }

    private static function responseFailed($message, $error_code) {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $error_code);
    }
}
