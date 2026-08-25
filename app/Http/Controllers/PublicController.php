<?php
namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Setting;

class PublicController extends Controller
{
    public function home(){
        return view('pages.home', [
            'programs'=>Program::where('is_active',1)->orderBy('sort_order')->take(6)->get(),
            'faqs'=>Faq::where('is_active',1)->orderBy('sort_order')->take(5)->get(),
            'settings'=>Setting::pluck('value','key'),
        ]);
    }
    public function profile(){ return view('pages.profile'); }
    public function programs(){ return view('pages.programs',['programs'=>Program::where('is_active',1)->orderBy('sort_order')->get()]); }
    public function programDetail(Program $program){ abort_unless($program->is_active,404); return view('pages.program-detail',compact('program')); }
    public function legal(){ return view('pages.legal'); }
    public function gallery(){ return view('pages.gallery',['items'=>Gallery::where('is_active',1)->orderBy('sort_order')->get()]); }
    public function news(){ return view('pages.news',['posts'=>Post::where('is_active',1)->orderByDesc('published_at')->orderByDesc('id')->get()]); }
    public function newsDetail(Post $post){ abort_unless($post->is_active,404); return view('pages.news-detail',compact('post')); }
    public function faq(){ return view('pages.faq',['faqs'=>Faq::where('is_active',1)->orderBy('sort_order')->get()]); }
    public function contact(){ return view('pages.contact'); }
}
