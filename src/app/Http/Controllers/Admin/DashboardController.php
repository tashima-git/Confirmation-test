<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->name}%")
                  ->orWhere('first_name', 'like', "%{$request->name}%");
            });
        }

        if($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->paginate(7); // ←ここを修正
        $categories = Category::all();

        return view('admin.dashboard', compact('contacts', 'categories'));
    }
}
