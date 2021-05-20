<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthApi\Implement\PatientAuthService;
use App\Services\UserService\Implement\PatientService;
use Exception;

class PatientProfileController extends Controller
{
    protected $patientAuthService;
    protected $patientService;

    public function __construct(
        PatientAuthService $patientAuth,
        PatientService $patientService
    ) {
        $this->patientAuthService = $patientAuth;
        $this->patientService = $patientService;
    }



    public function update(Request $request)
    {

        try {
            $patientUpdated = $this->patientService->updateUser($request);

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'message' => 'data pasien telah di update',
                'user' => [
                    'id' => $patientUpdated->id,
                    'name' => $patientUpdated->name,
                    'email' => $patientUpdated->email,
                    'jenis_kelamin' => $patientUpdated->jenis_kelamin,
                    'alamat' => $patientUpdated->alamat,
                    'tanggal_lahir' => $patientUpdated->tanggal_lahir,
                    'phone' => $patientUpdated->phone,
                    'created_at' => $patientUpdated->created_at,
                    'updated_at' => $patientUpdated->updated_at,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'message' => 'data gagal diupdate'
            ]);
        }
    }



    public function saveUserProfile(Request $request)
    {

        try {
            $patientPhoto = $this->patientService->updateUserPhoto($request);

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'message' => 'foto profil berhasil ditambahkan',
                'user' => [
                    'id' => $patientPhoto->id,
                    'name' => $patientPhoto->name,
                    'photo' => $patientPhoto->photo,
                    'created_at' => $patientPhoto->created_at,
                    'updated_at' => $patientPhoto->updated_at
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'message' => 'gambar gagal diupload'
            ]);
        }
    }



    public function getUserPhoto(Request $request)
    {
        $base64Format = $this->patientService->getUserPhoto($request);

        if ($base64Format != null) {
            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'message' => $base64Format
            ]);
        }

        return response()->json([
            'code' => 400,
            'status' => 'gagal',
            'message' => 'gambar gagal diupload'
        ]);
    }
}
