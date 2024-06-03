<?php

namespace App\Http\Controllers;

use App\Models\UserPhone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserPhoneController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $emails = UserPhone::query()
            ->where('user_id', $request->input('user_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($emails);
    }
}
