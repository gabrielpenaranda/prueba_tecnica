<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'business_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => ['required', 'email', 'max:255', Rule::unique('companies')->ignore($this->route('company'))],
            'iban_para_aeat' => 'nullable|string|max:34',
            'swift_bic_para_aeat' => 'nullable|string|max:11',
            'inscrito_registro_devolucion_mensual' => 'nullable|boolean',
            'tributa_exclusivamente_regimen_simplificado' => 'nullable|boolean',
            'autoliquidacion_conjunta' => 'nullable|boolean',
            'declarado_concurso_acreedores' => 'nullable|boolean',
            'fecha_concurso_acreedores' => 'nullable|date',
            'concurso_acreedores_autoliquidacion_preconcursal' => 'nullable|boolean',
            'concurso_acreedores_autoliquidacion_postconcursal' => 'nullable|boolean',
            'regimen_especial_criterio_caja' => 'nullable|boolean',
            'opcion_criterio_caja' => 'nullable|boolean',
            'destinatario_operaciones_regimen_especial_criterio_caja' => 'nullable|boolean',
            'aplicacion_prorrata_especial' => 'nullable|boolean',
            'revocacion_prorrata_especial' => 'nullable|boolean',
            'exonerado_modelo_390' => 'nullable|boolean',
            'volumen_operaciones_modelo_390' => 'nullable|numeric|min:0',
        ];
    }
}
