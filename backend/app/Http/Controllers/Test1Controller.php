<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Test1Controller extends Controller
{
    public function __invoke(Request $request): false|JsonResponse
    {
        $query = (string)$request->input('query');

        $matchingBrackets = [
            ')' => '(',
            '}' => '{',
            ']' => '['
        ];

        $stack = [];

        for ($i = 0; $i < strlen($query); $i++) {
            $char = $query[$i];

            if (array_key_exists($char, $matchingBrackets)) {
                $topElement = empty($stack) ? '#' : array_pop($stack);

                if ($topElement != $matchingBrackets[$char]) {
                    return false;
                }
            } else {
                array_push($stack, $char);
            }
        }

        return response()->json(['valid' => empty($stack)]);
    }
}
