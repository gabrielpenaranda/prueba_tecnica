<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageGenerationService;

class CompanyController extends Controller
{
    protected $imageService;

    public function __construct(ImageGenerationService $imageService)
    {
        $this->imageService = $imageService;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('dashboard.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        $user = Auth::user();

        // Genera imagenes
        $this->imageService->generateUserImage($user);
        $this->imageService->generateCompanyImage($user->company);

        return redirect()->route('dashboard');
    }

}
