<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('app.Edit') }}: {{ $company->business_name }}
            </h2>
            <a href="{{ route('dashboard') }}" class="btn btn-danger">{{ __('Dashboard') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('companies-update', $company) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- General Information -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="business_name" :value="__('app.Business_Name')" />
                            <x-text-input id="business_name" name="business_name" type="text" class="mt-1 block w-full"
                                :value="old('business_name', $company->business_name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('business_name')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('app.Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                                :value="old('phone', $company->phone)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('app.Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $company->email)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <!-- AEAT / Banking Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                        <div>
                            <x-input-label for="iban_para_aeat" :value="__('IBAN AEAT')" />
                            <x-text-input id="iban_para_aeat" name="iban_para_aeat" type="text"
                                class="mt-1 block w-full" :value="old('iban_para_aeat', $company->iban_para_aeat)" />
                            <x-input-error class="mt-2" :messages="$errors->get('iban_para_aeat')" />
                        </div>
                        <div>
                            <x-input-label for="swift_bic_para_aeat" :value="__('SWIFT/BIC AEAT')" />
                            <x-text-input id="swift_bic_para_aeat" name="swift_bic_para_aeat" type="text"
                                class="mt-1 block w-full" :value="old('swift_bic_para_aeat', $company->swift_bic_para_aeat)" />
                            <x-input-error class="mt-2" :messages="$errors->get('swift_bic_para_aeat')" />
                        </div>
                    </div>

                    <!-- Tax Regimes & Checkboxes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center">
                            <input type="checkbox" name="inscrito_registro_devolucion_mensual"
                                id="inscrito_registro_devolucion_mensual" value="1" {{ old('inscrito_registro_devolucion_mensual', $company->inscrito_registro_devolucion_mensual) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="inscrito_registro_devolucion_mensual"
                                class="ms-2 text-sm text-gray-600">{{ __('Inscrito Reg. Dev. Mensual') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="tributa_exclusivamente_regimen_simplificado"
                                id="tributa_exclusivamente_regimen_simplificado" value="1" {{ old('tributa_exclusivamente_regimen_simplificado', $company->tributa_exclusivamente_regimen_simplificado) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="tributa_exclusivamente_regimen_simplificado"
                                class="ms-2 text-sm text-gray-600">{{ __('Régimen Simplificado') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="autoliquidacion_conjunta" id="autoliquidacion_conjunta"
                                value="1" {{ old('autoliquidacion_conjunta', $company->autoliquidacion_conjunta) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="autoliquidacion_conjunta"
                                class="ms-2 text-sm text-gray-600">{{ __('Autoliquidación Conjunta') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="regimen_especial_criterio_caja"
                                id="regimen_especial_criterio_caja" value="1" {{ old('regimen_especial_criterio_caja', $company->regimen_especial_criterio_caja) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="regimen_especial_criterio_caja"
                                class="ms-2 text-sm text-gray-600">{{ __('Régimen Especial Criterio Caja') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="opcion_criterio_caja" id="opcion_criterio_caja" value="1" {{ old('opcion_criterio_caja', $company->opcion_criterio_caja) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="opcion_criterio_caja"
                                class="ms-2 text-sm text-gray-600">{{ __('Opción Criterio Caja') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="destinatario_operaciones_regimen_especial_criterio_caja"
                                id="destinatario_operaciones_regimen_especial_criterio_caja" value="1" {{ old('destinatario_operaciones_regimen_especial_criterio_caja', $company->destinatario_operaciones_regimen_especial_criterio_caja) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="destinatario_operaciones_regimen_especial_criterio_caja"
                                class="ms-2 text-sm text-gray-600">{{ __('Destinatario Criterio Caja') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="aplicacion_prorrata_especial" id="aplicacion_prorrata_especial"
                                value="1" {{ old('aplicacion_prorrata_especial', $company->aplicacion_prorrata_especial) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="aplicacion_prorrata_especial"
                                class="ms-2 text-sm text-gray-600">{{ __('Aplicación Prorrata Especial') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="revocacion_prorrata_especial" id="revocacion_prorrata_especial"
                                value="1" {{ old('revocacion_prorrata_especial', $company->revocacion_prorrata_especial) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="revocacion_prorrata_especial"
                                class="ms-2 text-sm text-gray-600">{{ __('Revocación Prorrata Especial') }}</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="exonerado_modelo_390" id="exonerado_modelo_390" value="1" {{ old('exonerado_modelo_390', $company->exonerado_modelo_390) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="exonerado_modelo_390"
                                class="ms-2 text-sm text-gray-600">{{ __('Exonerado Modelo 390') }}</label>
                        </div>
                    </div>

                    <!-- Legal / Concurso Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="declarado_concurso_acreedores"
                                    id="declarado_concurso_acreedores" value="1" {{ old('declarado_concurso_acreedores', $company->declarado_concurso_acreedores) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <label for="declarado_concurso_acreedores"
                                    class="ms-2 text-sm text-gray-600">{{ __('Declarado en Concurso') }}</label>
                            </div>
                            <div>
                                <x-input-label for="fecha_concurso_acreedores" :value="__('Fecha Concurso')" />
                                <x-text-input id="fecha_concurso_acreedores" name="fecha_concurso_acreedores"
                                    type="date" class="mt-1 block w-echaull" :value="old('fecha_concurso_acreedores', $company->fecha_concurso_acreedores)" />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_concurso_acreedores')" />
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="concurso_acreedores_autoliquidacion_preconcursal"
                                    id="concurso_acreedores_autoliquidacion_preconcursal" value="1" {{ old('concurso_acreedores_autoliquidacion_preconcursal', $company->concurso_acreedores_autoliquidacion_preconcursal) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <label for="concurso_acreedores_autoliquidacion_preconcursal"
                                    class="ms-2 text-sm text-gray-600">{{ __('Autoliquidación Preconcursal') }}</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="concurso_acreedores_autoliquidacion_postconcursal"
                                    id="concurso_acreedores_autoliquidacion_postconcursal" value="1" {{ old('concurso_acreedores_autoliquidacion_postconcursal', $company->concurso_acreedores_autoliquidacion_postconcursal) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <label for="concurso_acreedores_autoliquidacion_postconcursal"
                                    class="ms-2 text-sm text-gray-600">{{ __('Autoliquidación Postconcursal') }}</label>
                            </div>
                        </div>
                    </div>

                    <!-- Others -->
                    <div class="pt-4 border-t border-gray-100">
                        <x-input-label for="volumen_operaciones_modelo_390" :value="__('Volumen de Operaciones Modelo 390')" />
                        <x-text-input id="volumen_operaciones_modelo_390" name="volumen_operaciones_modelo_390"
                            type="number" step="0.01" class="mt-1 block w-full"
                            :value="old('volumen_operaciones_modelo_390', $company->volumen_operaciones_modelo_390)" />
                        <x-input-error class="mt-2" :messages="$errors->get('volumen_operaciones_modelo_390')" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="btn btn-primary px-6 py-2">
                            {{ __('app.Edit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>