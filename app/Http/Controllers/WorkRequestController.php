<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequestRequest;
use App\Models\WorkRequest;
use Illuminate\Http\Request;

class WorkRequestController extends Controller
{
    public function index()
    {
        $workRequests = WorkRequest::with('requester')->latest()->get();
        return view('work-requests.index', compact('workRequests'));
    }

    public function create()
    {
        return view('work-requests.create');
    }  

    public function store(StoreWorkRequestRequest $request)
    {
        $data = array_merge($request->validated(), [
            'requester_id' => auth()->id(),
        ]);

        $workRequest = WorkRequest::create($data);

        return redirect()
            ->route('work-requests.show', $workRequest)
            ->with('success', 'Work request berhasil dibuat!');
    }

    public function show(WorkRequest $workRequest)
    {
        return view('work-requests.show', compact('workRequest'));
    }
}
