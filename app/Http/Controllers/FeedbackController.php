<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function saveFeedback(FeedbackRequest $request) {

        $data = $request->validated();
        $feedback = Feedback::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::id(),
            'category_id' => $data['category'],
        ]);

        if ($feedback->id > 0)
        {
            return response()->json([
                'message' => 'Feedback has been saved',
            ], 200);
        }else{
            return response()->json([
                'error' => 'Bad Request',
            ], 400);
        }

    }

    public function getAllFeedback()
    {

        $data = Feedback::with(['users', 'categories'])->paginate(10);
        if($data->isEmpty()) {
            return response()->json(['message' => 'No feedback records found'], 404);
        }

        // Map each feedback record to a resource
        $feedbackResources = $data->map(function ($feedback) {
            return new FeedbackResource($feedback);
        });

        return response()->json([
            'data' => $feedbackResources,
        ], 200);

    }
}
