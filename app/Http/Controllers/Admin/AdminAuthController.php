<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller{
    private function generateAdminId(){
        $randomSuffix = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return '210' . $randomSuffix;
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name'     => 'required|string',
            'admin_id' => 'required|integer',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('name', $credentials['name'])
            ->where('admin_id', $credentials['admin_id'])
            ->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['admin_id' => 'Invalid name, Admin ID or password.'])
            ->onlyInput('name', 'admin_id');
    }

    public function updateAdminId(Request $request, $id){
        $admin = Admin::findOrFail($id);

        $request->validate([
            'admin_id' => ['required', 'string', 'max:10', 'unique:admins,admin_id,' . $admin->id],
        ]);

        $admin->admin_id = $request->admin_id;
        $admin->save();

        return redirect()->route('admin.management')
            ->with('success', 'Admin ID updated successfully!');
    }

    public function editAdminId($id){
        $admin = Admin::findOrFail($id);
        return view('admin.edit-id', compact('admin'));
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }

    public function showManagement(){
        $admins = Admin::all();
        return view('admin.management', compact('admins'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $adminId = $this->generateAdminId();
        while (Admin::where('admin_id', $adminId)->exists()) {
            $adminId = $this->generateAdminId();
        }

        $admin = Admin::create([
            'admin_id' => $adminId,
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.management')
            ->with('success', "Admin '{$admin->name}' created successfully! ID: {$admin->admin_id}");
    }

    public function edit($id){
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id){
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if ($validated['password']) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.management')
                       ->with('success', "Admin '{$admin->name}' updated successfully!");
    }

    public function destroy($id){
        $admin = Admin::findOrFail($id);
        if ($admin->id === 1) {
            return back()->with('error', 'Cannot delete the super admin account!');
        }

        // Prevent admin from deleting themselves
        if (Auth::guard('admin')->id() === $admin->id) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $name = $admin->name;
        $admin->delete();

        return redirect()->route('admin.management')
                       ->with('success', "Admin '{$name}' deleted successfully!");
    }

    public function getAdmins(){
        $admins = Admin::all()->map(function ($admin) {
            return [
                'id' => $admin->id,
                'admin_id' => $admin->admin_id,
                'name' => $admin->name,
                'email' => $admin->email,
                'created_at' => $admin->created_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $admins,
        ]);
    }

    public function storeApi(Request $request){
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $adminId = $this->generateAdminId();
        while (Admin::where('admin_id', $adminId)->exists()) {
            $adminId = $this->generateAdminId();
        }

        $admin = Admin::create([
            'admin_id' => $adminId,
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Admin created successfully!",
            'data' => [
                'id' => $admin->id,
                'admin_id' => $admin->admin_id,
                'name' => $admin->name,
                'email' => $admin->email,
                'created_at' => $admin->created_at,
            ],
        ], 201);
    }

    public function destroyApi($id){
        $admin = Admin::findOrFail($id);
        if ($admin->id === 1) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the super admin account!',
            ], 403);
        }

        // Prevent admin from deleting themselves
        if (Auth::guard('admin')->id() === $admin->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account!',
            ], 403);
        }

        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin deleted successfully!',
        ]);
    }
}