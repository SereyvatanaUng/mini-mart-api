<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WelcomeMail;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CashierController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService = null)
    {
        $this->emailService = $emailService ?: new EmailService();
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $cashiers = User::cashiers()
            ->where('shop_owner_id', $user->id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cashiers
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'send_welcome_email' => 'nullable|boolean',
        ]);

        $cashier = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'cashier',
            'shop_owner_id' => $user->id,
        ]);

        // Send welcome email if requested
        if ($request->get('send_welcome_email', true)) {
            try {
                Mail::to($cashier->email)->send(new WelcomeMail($cashier, $request->password));
            } catch (\Exception $e) {
                // Log error but don't fail the entire request
                \Log::error('Failed to send welcome email: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Cashier created successfully',
            'data' => $cashier
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        if (!$user->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $cashier = User::cashiers()
            ->where('shop_owner_id', $user->id)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $cashier
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();

        if (!$user->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $cashier = User::cashiers()
            ->where('shop_owner_id', $user->id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $cashier->id,
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $cashier->update($request->only(['name', 'email', 'phone', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Cashier updated successfully',
            'data' => $cashier
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        if (!$user->isShopOwner()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $cashier = User::cashiers()
            ->where('shop_owner_id', $user->id)
            ->findOrFail($id);

        $cashier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cashier deleted successfully'
        ]);
    }
}
