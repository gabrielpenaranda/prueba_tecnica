<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class ImageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $userImage = 'storage/images/user_' . $user->id . '.jpg';
        $companyImage = 'storage/images/company_' . $user->company->id . '.jpg';

        return view('dashboard.images.index', compact('userImage', 'companyImage'));
    }

    public function generate_pdf()
    {
        $user = auth()->user();

        $userImage = 'storage/images/user_' . $user->id . '.jpg';
        $companyImage = 'storage/images/company_' . $user->company->id . '.jpg';

        $data = [
            'userImage' => $userImage,
            'companyImage' => $companyImage,
        ];

        $pdf = Pdf::loadView('dashboard.images.pdf', $data);
        return $pdf->download('user_company_data.pdf');
    }
}
