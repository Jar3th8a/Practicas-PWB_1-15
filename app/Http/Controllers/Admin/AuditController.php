<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\View\View;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(): View
    {
        $audits = Audit::latest()->paginate(20);

        return view('admin.audits.index', compact('audits'));
    }

    public function show(Audit $audit): View
    {
        return view('admin.audits.show', compact('audit'));
    }
}
