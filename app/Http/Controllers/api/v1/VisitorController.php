<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Carbon;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ip_address' => 'required|string|max:45',
            'user_agent' => 'nullable|string',
            'geolocation' => 'nullable|json',
            'city' => 'nullable|string',
            'provider' => 'nullable|string',
            'referrer' => 'nullable|string',
            'page_url' => 'required|url',
            'page_title' => 'required|string',
            'screen_resolution' => 'required|string',
            'language' => 'required|string|max:10',
            'timezone' => 'nullable|string',
            'device_type' => 'required|string|max:20',
            'browser' => 'required|string|max:20',
            'os' => 'required|string|max:20',
            'session_id' => 'required|string'
        ]);
        if (!$validatedData) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request data'
            ]);
        }
        $ipAddress = $validatedData['ip_address'];
        $currentDateTime = Carbon::now();
        $oneHourAgo = $currentDateTime->copy()->subHours(1);

        $existingVisitor = Visitor::where('ip_address', $ipAddress)
            ->where('visited_at', '>=', $oneHourAgo)
            ->first();

        if ($existingVisitor) {
            $existingVisitor->update([
                'last_visit' => $currentDateTime,
                'referrer' => $validatedData['referrer'] ?? null,
            ]);
            return response()->json([
                'success' => true
            ]);
        }

        Visitor::create(array_merge($validatedData,[
            'visited_at' => $currentDateTime,
            'last_visit' => $currentDateTime,
        ]));
        return response()->json([
            'success' => true,
//            'message' => 'Visitor created successfully'
        ]);
    }
}
