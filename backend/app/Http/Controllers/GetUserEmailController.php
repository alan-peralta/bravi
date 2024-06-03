<?php

namespace App\Http\Controllers;

use App\Models\UserEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserEmailController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $emails = UserEmail::query()
            ->where('user_id', $request->input('user_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($emails);
    }
}
