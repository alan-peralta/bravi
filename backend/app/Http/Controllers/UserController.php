<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->filled('_limit') ? $request->input('_limit') : 10;
        $page = $request->filled('_page') ? $request->input('_page') : 1;
        $sort = $request->filled('_sort') ? $request->input('_sort') : 'updated_at';
        $order = $request->filled('_order') ? $request->input('_order') : 'desc';

        $users = User::query()
            ->select('id', 'name', 'updated_at')
            ->orderBy($sort, $order)
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($users);
    }
    public function store(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = User::create(['name' => $request->name]);

            foreach ($request->phones as $phone) {
                $user->phones()->create(['number' => $phone['phone']]);
            }

            foreach ($request->emails as $email) {
                $user->emails()->create(['email' => $email['email']]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($user, 201);
    }

    public function show(string $id): JsonResponse
    {
        $user = User::query()
            ->with('phones', 'emails')
            ->findOrFail($id);

        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $user = User::query()->findOrFail($id);
            $user->update(['name' => $request->name]);

            $user->phones()->delete();
            foreach ($request->phones as $phone) {
                $user->phones()->create(['number' => $phone['phone']]);
            }

            $user->emails()->delete();
            foreach ($request->emails as $email) {
                $user->emails()->create(['email' => $email['email']]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
