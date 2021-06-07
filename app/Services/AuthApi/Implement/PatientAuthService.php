<?php

namespace App\Services\AuthApi\Implement;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\AuthApi\Implement\PatientAuthRepository;
use App\Services\AuthApi\AuthService;
use Illuminate\Support\Facades\Auth;


class PatientAuthService implements AuthService
{


    protected $patientAuthRepository;

    public function __construct(PatientAuthRepository $patientRepository)
    {
        $this->patientAuthRepository = $patientRepository;
    }

    public function login(LoginRequest $request)
    {
        if ($request->validated()) {
            $loginData = collect($request);

            Auth::guard('patient')->attempt($loginData->all());

            $patient = Auth::guard('patient')->user();

            return $patient;
        }
    }

    public function register(RegisterRequest $request)
    {

        if ($request->validated()) {
            $dataExceptPassword = collect($request->except('password'));
            $dataWithHashPassword = $dataExceptPassword->merge([
                'password' => bcrypt($request->password)
            ]);

            $patientData = $this->patientAuthRepository->saveUser($dataWithHashPassword->all());

            return $patientData;
        }
    }

    public function logout(LogoutRequest $request): bool
    {
        if ($request->validated()) {

            $isDeleted = $this->patientAuthRepository->deleteAccessToken($request->token_id);

            return $isDeleted;
        } else {
            return false;
        }
    }

    public function createAccessToken($patient)
    {
        $tokenResult = $patient->createToken('AccessToken');
        $token = $tokenResult->token;

        $this->patientAuthRepository->saveAccessToken($token);

        return $tokenResult;
    }

    public function recreateAccessToken($patient)
    {
        $patientTokenId = $this->patientAuthRepository->getTokenId($patient->id);

        if ($patientTokenId != null) {
            $isDeleted = $this->patientAuthRepository->deleteAccessToken($patientTokenId);

            if ($isDeleted) {
                $patientNewAccessToken = $this->createAccessToken($patient);
                return $patientNewAccessToken;
            }
        }

        return;
    }
}
