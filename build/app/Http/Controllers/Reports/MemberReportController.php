<?php

namespace App\Http\Controllers\Reports;

use App\Enums\MembershipStatus;
use App\Enums\MembershipType;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\EducationalLevel;
use App\Enums\Boolean;
use App\Enums\Month;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Reports\MemberReportCreateRequest;
use App\Models\Member;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class MemberReportController extends Controller
{
    public function index(): Response
    {
        $this->authorize('members_report.index');

        $options = [
            'membership_status_options' => MembershipStatus::options(),
            'membership_type_options' => MembershipType::options(),
            'gender_options' => Gender::options(),
            'marital_status_options' => MaritalStatus::options(),
            'educational_level_options' => EducationalLevel::options(),
            'is_under_discipline_options' => Boolean::options(),
            'is_baptized_options' => Boolean::options(),
            'has_professed_faith_options' => Boolean::options(),
            'birth_month_options' => Month::options(),
        ];

        return Inertia::render('reports/members_report/index', [
            'options' => $options,
            'csrfToken' => csrf_token(),
        ]);
    }

    public function generate(MemberReportCreateRequest $request): HttpResponse
    {
        $members = Member::with('currentAdmission')
            ->whereHas('currentAdmission', function ($q) use ($request) {
                $q
                    ->when($request->filled('membership_status'), fn($q) => $q->where('membership_status', $request->membership_status))
                    ->when($request->filled('membership_type'), fn($q) => $q->where('membership_type', $request->membership_type));
            })
            ->when($request->filled('gender'), fn($q) => $q->where('gender', $request->gender))
            ->when($request->filled('marital_status'), fn($q) => $q->where('marital_status', $request->marital_status))
            ->when($request->filled('educational_level'), fn($q) => $q->where('educational_level', $request->educational_level))
            ->when($request->filled('is_under_discipline'), fn($q) => $q->where('is_under_discipline', $request->is_under_discipline))
            ->when($request->filled('is_baptized'), fn($q) => $q->where('is_baptized', $request->is_baptized))
            ->when($request->filled('has_professed_faith'), fn($q) => $q->where('has_professed_faith', $request->has_professed_faith))
            ->when($request->filled('birth_month'), fn($q) => $q->whereMonth('birth_date', $request->birth_month))
            ->orderBy('name')
            ->get();

        $data = [
            'title' => 'Relatório de Membros',
            'members' => $members,
            'generate_date' => date("d/m/Y"),
        ];

        $pdf = PDF::loadView('pdf.report_members', $data);
        return $pdf->stream('report.pdf');
    }
}
