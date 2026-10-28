<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberAdmission;
use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Helpers\DateHelper;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MemberController extends Controller
{
    /**
     * Show the member's page.
     */
    public function index(): Response
    {
        $this->authorize('members.index');

        $map = [
            'active' => 1,
            'separated' => 2,
            'dismissed' => 3
        ];

        $active = $this->getMembers($map['active']);
        $total_active = $this->getTotalMembersType($map['active']);

        $separated = $this->getMembers($map['separated']);
        $total_separated = $this->getTotalMembersType($map['separated']);

        $dismissed = $this->getMembers($map['dismissed']);
        $total_dismissed = $this->getTotalMembersType($map['dismissed']);

        return Inertia::render('members/index', [
            'members_active' => $active,
            'members_separated' => $separated,
            'members_dismissed' => $dismissed,
            'total_active' => $total_active,
            'total_separated' => $total_separated,
            'total_dismissed' => $total_dismissed,
        ]);
    }

    /**
     * Show the member's create page.
     */
    public function create(): Response
    {
        $this->authorize('members.create');

        return Inertia::render('members/create');
    }

    /**
     * Stores the member information.
     */
    public function store(MemberStoreRequest $request): RedirectResponse
    {
        return $this->withToastFeedback(
            action: function () use ($request) {
                $data = $request->safe()->merge([
                    'birth_date' => DateHelper::toDatabaseDate($request->input('birth_date')),
                    'marriage_date' => DateHelper::toDatabaseDate($request->input('marriage_date')),
                    'baptism_date' => DateHelper::toDatabaseDate($request->input('baptism_date')),
                    'profession_of_faith_date' => DateHelper::toDatabaseDate($request->input('profession_of_faith_date')),
                    'admission' => [
                        ...$request->input('admission'),
                        'admission_date' => DateHelper::toDatabaseDate($request->input('admission.admission_date')),
                        'dismissal_date' => DateHelper::toDatabaseDate($request->input('admission.dismissal_date')),
                    ],
                ])->all();

                $admissionData = $data['admission'];
                unset($data['admission']);

                $member = Member::create($data);

                $admission = new MemberAdmission($admissionData);
                $admission->user_id = $request->user()->id;
                $member->admissions()->save($admission);
            },
            successMessage: __('Membro cadastrado.'),
            errorMessage: __('Membro não pôde ser cadastrado.'),
            redirectRoute: 'members.index',
            errorRoute: 'members.create',
        );
    }

    /**
     * Show the member's edit page.
     */
    public function edit(Member $member): Response
    {
        $this->authorize('members.edit');

        return Inertia::render('members/edit', [
            'member' => $member->load('currentAdmission'),
            'admissions' => $member->admissions()->get(),
        ]);
    }

    /**
     * Update the member information.
     */
    public function update(MemberUpdateRequest $request, Member $member): RedirectResponse
    {
        return $this->withToastFeedback(
            action: function () use ($request, $member) {
                $data = $request->safe()->merge([
                    'birth_date' => DateHelper::toDatabaseDate($request->input('birth_date')),
                    'marriage_date' => DateHelper::toDatabaseDate($request->input('marriage_date')),
                    'baptism_date' => DateHelper::toDatabaseDate($request->input('baptism_date')),
                    'profession_of_faith_date' => DateHelper::toDatabaseDate($request->input('profession_of_faith_date')),
                    'admission' => [
                        ...$request->input('admission'),
                        'admission_date' => DateHelper::toDatabaseDate($request->input('admission.admission_date')),
                        'dismissal_date' => DateHelper::toDatabaseDate($request->input('admission.dismissal_date')),
                    ],
                ])->all();

                $admissionData = $data['admission'];
                unset($data['admission']);

                $member->update($data);

                $current = $member->currentAdmission;

                $statusChanged = $current === null
                    || $current->membership_status->value !== (int) $admissionData['membership_status'];


                if ($statusChanged) {
                    $admission = new MemberAdmission($admissionData);
                    $admission->user_id = $request->user()->id;
                } else {
                    $admission = $current;
                    $admission->fill($admissionData);
                }

                $member->admissions()->save($admission);

                return true;
            },
            successMessage: __('Membro editado.'),
            errorMessage: __('Membro não pôde ser editado.'),
            redirectRoute: 'members.index',
            errorRoute: 'members.edit',
        );
    }

    /**
     * Delete the member.
     */
    public function destroy(Member $member): RedirectResponse
    {
        $this->authorize('members.destroy');

        return $this->withToastFeedback(
            action: function () use ($member) {
                return $member->delete();
            },
            successMessage: __('Membro deletado.'),
            errorMessage: __('Membro não pôde ser deletado.'),
            redirectRoute: 'members.index',
            errorRoute: 'members.index',
        );
    }

    /**
     * Get members of a specific membership _type.
     */
    public function getMembers(int $membership_type)
    {
        return Member::with('currentAdmission')
            ->whereHas('currentAdmission', fn($q) => $q->where('membership_type', $membership_type))
            ->orderBy('name')
            ->paginate(50);
    }

    /**
     * Get total count of members of a specific membership type.
     */
    public function getTotalMembersType(int $membership_type)
    {
        return Member::whereHas('currentAdmission', fn($q) => $q->where('membership_type', $membership_type))
            ->count();
    }
}
