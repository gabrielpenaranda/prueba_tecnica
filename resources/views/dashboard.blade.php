<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('companies-edit', Auth::user()->company) }}" class="btn btn-primary">
                {{ __('app.editCompany') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2">
                        <div class="space-y-4">
                            <img src="{{ asset(Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                                class="w-32 h-32 object-cover shadow-lg border-4 border-gray-100 mx-auto">
                            <h3 class="font-bold text-3xl text-gray-800 text-center">{{ Auth::user()->name }}</h3>
                        </div>
                        <div class="flex flex-col space-y-4 border-l pl-8 border-gray-100">
                            <div class="mb-2">
                                <h3 class="font-bold text-3xl text-gray-800">{{ Auth::user()->company->business_name }}
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 gap-1 text-xs text-gray-600 overflow-y-auto max-h-96">
                                <p><strong>Teléfono:</strong> {{ Auth::user()->company->phone ?? "---" }}</p>
                                <p><strong>Correo Electrónico:</strong> {{ Auth::user()->company->email ?? "---" }}</p>
                                <p><strong>IBAN AEAT:</strong> {{ Auth::user()->company->iban_para_aeat ?? "---" }}</p>
                                <p><strong>SWIFT/BIC AEAT:</strong>
                                    {{ Auth::user()->company->swift_bic_para_aeat ?? "---" }}</p>
                                <p><strong>Inscrito en Registro de Devolución Mensual:</strong>
                                    {{ Auth::user()->company->inscrito_registro_devolucion_mensual ? "Sí" : "No" }}</p>
                                <p><strong>Tributa Exclusivamente en Régimen Simplificado:</strong>
                                    {{ Auth::user()->company->tributa_exclusivamente_regimen_simplificado ? "Sí" : "No" }}
                                </p>
                                <p><strong>Autoliquidación Conjunta:</strong>
                                    {{ Auth::user()->company->autoliquidacion_conjunta ? "Sí" : "No" }}</p>
                                <p><strong>Declarado en Concurso de Acreedores:</strong>
                                    {{ Auth::user()->company->declarado_concurso_acreedores ? "Sí" : "No" }}</p>
                                <p><strong>Fecha Concurso Acreedores:</strong>
                                    {{ Auth::user()->company->fecha_concurso_acreedores ?? "---" }}</p>
                                <p><strong>Autoliquidación Conjunta:</strong>
                                    {{ Auth::user()->company->concurso_acreedores_autoliquidacion_preconcursal ? "Sí" : "No" }}
                                </p>
                                <p><strong>Autoliquidación Postconcursal:</strong>
                                    {{ Auth::user()->company->concurso_acreedores_autoliquidacion_postconcursal ? "Sí" : "No" }}
                                </p>
                                <p><strong>Régimen Especial de Criterio de Caja:</strong>
                                    {{ Auth::user()->company->regimen_especial_criterio_caja ? "Sí" : "No" }}</p>
                                <p><strong>Opción Régimen Especial de Criterio de Caja:</strong>
                                    {{ Auth::user()->company->opcion_criterio_caja ? "Sí" : "No" }}</p>
                                <p><strong>Destinatario Operaciones Régimen Especial de Criterio de Caja:</strong>
                                    {{ Auth::user()->company->destinatario_operaciones_regimen_especial_criterio_caja ? "Sí" : "No" }}
                                </p>
                                <p><strong>Aplicación Prorrata Especial:</strong>
                                    {{ Auth::user()->company->aplicacion_prorrata_especial ? "Sí" : "No" }}</p>
                                <p><strong>Revocación Prorrata Especial:</strong>
                                    {{ Auth::user()->company->revocacion_prorrata_especial ? "Sí" : "No" }}</p>
                                <p><strong>Exonerado Modelo 390:</strong>
                                    {{ Auth::user()->company->exonerado_modelo_390 ? "Sí" : "No" }}</p>
                                <p><strong>Volumen Operaciones Modelo 390:</strong>
                                    {{ Auth::user()->company->volumen_operaciones_modelo_390 ?? "---" }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('images') }}" class="btn btn-info">
                {{ __('app.verDatos') }}</a>
        </div>
    </div>
</x-app-layout>