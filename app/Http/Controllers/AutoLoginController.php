<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Http\Request;
use App\Services\GetOrgTypeService;
use App\Models\SOISGate;
use App\Services\DataLogServices\DataLogService;


class AutoLoginController extends Controller
{
    protected $dataLogger;

    /**
     * @param Integer $id, String $key
     * An autologin function that recieves requests from SOIS-HOMEPAGE
     * @return Redirect
     */ 
    public function login($id, $key)
    {
        // $this->dataLogger = new DataLogService();

        // Checks if URL has SSL, then appends it along with Host URL and  Request URI to get the full URL
        $urlString = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // Explode URL using "/" as separators
        $explodedString = explode ("/", $urlString); 

        // Get User ID from URL
        $userID = $explodedString[5];

        // Get Gate Key from URL
        $gateKey = $explodedString[7];

        $userData = SOISGate::where('user_id' , $userID)
            ->where('gate_key' ,$gateKey)
            ->where('is_logged_in' ,'1')
            ->firstOrFail();

        // If the URL provided an existing ID, Key, and the user is logged-in in SOIS-Homepage... 

        // Login User using ID
        Auth::loginUsingId($userData->user_id);

        // Redirect Logic for SOIS-MEMBERSHIP

        // Redirect STUDENT SERVICES Role
        if ( (Auth::user()->roles->pluck('role'))->containsStrict('Head of Student Affairs'))
        {
            $this->regenerateGateKey($userID, $gateKey);
            return redirect()->route('membership.student-services.academicOrgs');
        }
        else if ( (Auth::user()->roles->pluck('role'))->containsStrict('Membership Admin'))
        {
            $orgTypeId = (new GetOrgTypeService)->getOrganizationID();
            $TypeId = $orgTypeId->organization_type_id;

            if ($TypeId == 1) {
                $this->regenerateGateKey($userID, $gateKey);
                return redirect()->route('membership.academic.memberships-reports');
            }else {
                $this->regenerateGateKey($userID, $gateKey);
                return redirect()->route('membership.nonacademic.memberships-reports');
            }
           
        }
        // Redirect User|Officer|President|Other Admins
        else
        {
            $this->regenerateGateKey($userID, $gateKey);
            return redirect()->back();   
        }
    }

    /**
     * @param Integer $userID, String $gateKey
     * Function to regenerate a new Gate Key for each login of User from SOIS-Homepage
     */ 
    private function regenerateGateKey($userID, $gateKey)
    {   
        $newUUID = Str::uuid();
        while (SOISGate::where('gate_key' ,$newUUID)->exists()) {
            $newUUID = Str::uuid();
        }

        SOISGate::where('user_id' , $userID)
            ->where('gate_key' ,$gateKey)
            ->update([
                'gate_key' => Str::uuid(),
            ]);
    }
}
