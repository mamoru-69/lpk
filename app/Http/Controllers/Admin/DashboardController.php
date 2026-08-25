<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Program;
class DashboardController extends Controller {
    public function __invoke(){
        return view('admin.dashboard.index',[
            'registrations'=>Registration::latest()->take(8)->get(),
            'totalRegistrations'=>Registration::count(),
            'totalPrograms'=>Program::where('is_active',1)->count(),
            'statusCounts'=>Registration::query()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total','status'),
        ]);
    }
}
