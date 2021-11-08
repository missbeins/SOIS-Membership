<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [

            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'student_number' => [
                'required', 
                'string', 
                'max:50',
                Rule::unique('users')->ignore($user)],
            'course_id' => ['required', 'string'],
            'year_and_section' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string'], 
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->user_id,'user_id'),
            ],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'student_number' =>$input['student_number'],
                'year_and_section' => $input['year_and_section'],
                'course_id' => $input['course_id'],
                'mobile_number' => $input['mobile_number'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
                'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'student_number' =>$input['student_number'],
                'year_and_section' => $input['year_and_section'],
                'course_id' => $input['course_id'],
                'mobile_number' => $input['mobile_number'],
                'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
