<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{


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

        return redirect()->route('dashboard');
    }

}
