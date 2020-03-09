<?php

namespace App\Http\Controllers;

use App\AccountTariff;
use App\ReferralCode;
use App\TrialPeriodGroup;
use Illuminate\Http\Request;

class ReferralCodeController extends Controller
{
    public function index()
    {
        $referralCodes = ReferralCode::with('trialperiodgroup');
        $referralCodes = $referralCodes->get();

        //$trialPeriodGroups = TrialPeriodGroup::all();

        //dd($referralCodes);

        return view('referral_codes.referral_codes_list', compact(['referralCodes', 'trialPeriodGroups']));
    }

    public function add(Request $request)
    {
        $referralCodes = ReferralCode::all();
        $trialPeriodGroups = TrialPeriodGroup::all();

//        dd($trialPeriodGroups);


        $randomReferralCode = self::getRandomReferralCode(6);

        return view('referral_codes.referral_code_create', compact([
                'referralCodes',
                'randomReferralCode',
                'trialPeriodGroups',
            ])
        );
    }

    public function getRandomReferralCode($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    public function store(Request $request)
    {
        $referralCode = $request->referral_code;
        $trialPeriodGroupId = $request->trial_period_group_id;

        $referralCodeModel = new ReferralCode();
        $referralCodeModel->referral_code = $referralCode;
        $referralCodeModel->trial_period_group_id = $trialPeriodGroupId;

        $referralCodeModel->save();

        return redirect('/referral_codes_list');

    }

    public function edit($id = false)
    {
        $referralCode = ReferralCode::find($id);
        $trialPeriodGroups = TrialPeriodGroup::all();

        //dd($trialPeriodGroups, $referralCode);

        return view('referral_codes.referral_code_edit', compact([
                'referralCode',
                'trialPeriodGroups',
            ])
        );
    }

    public function update(Request $request, $id = false)
    {
        $referralCode = $request->referral_code;
        $trialPeriodGroupId = $request->trial_period_group_id;


        $referralCodeModel = ReferralCode::find($id);
        //dd($referralCodeModel);
        $referralCodeModel->referral_code = $referralCode;
        $referralCodeModel->trial_period_group_id = $trialPeriodGroupId;

        $referralCodeModel->save();

        return redirect('/referral_codes_list');
    }

    public function delete($id)
    {
        $referralCodeModel = ReferralCode::find($id);
        $referralCodeModel->delete();

        return redirect('/referral_codes_list');
    }

}
