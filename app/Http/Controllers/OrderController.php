<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Request as OrderRequest;
use App\Models\DutySchedule;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $managers = Manager::active()->ordered()->get();
        return view('order.index', compact('managers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $currentDuty = DutySchedule::byDate(today())->first();
        $managerId = $currentDuty ? $currentDuty->manager_id : null;

        OrderRequest::create([
            'client_id' => 0,
            'product_id' => $request->product_id,
            'offer' => $request->name . ' - ' . $request->phone . ($request->email ? ' (' . $request->email . ')' : ''),
            'status' => 'new',
            'manager_id' => $managerId,
            'comment' => 'Заявка с сайта: ' . $request->name . ', тел: ' . $request->phone . ($request->email ? ', email: ' . $request->email : ''),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Заявка успешно отправлена'
        ]);
    }
}
