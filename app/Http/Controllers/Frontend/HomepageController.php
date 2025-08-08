<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function Homepage()
    {
        $userTech = DB::table('users')
            ->where('is_active', 'active')
            ->where('is_delete', 0)
            ->where('group_role', 'User')
            ->limit(3)->get();

        $testimonials = Testimonial::query()
            ->where('rating', 5)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('frontend.pages.homepage', compact('userTech', 'testimonials'));
    }

}
