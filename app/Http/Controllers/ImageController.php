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

        // Segmento de codigo para generar pdf con las imagenes generadas
        /*
        $userImage = 'storage/images/user_' . $user->id . '.jpg';
        $companyImage = 'storage/images/company_' . $user->company->id . '.jpg';

        $data = [
            'userImage' => $userImage,
            'companyImage' => $companyImage,
        ]; */

        // Genera pdf con datos de usuario y compañia
        $company = $user->company;

        $userPhoto = $user->photo;

        // Si la foto no existe físicamente, se pone null, DomPDF falla si no existe la imagen.
        if ($userPhoto && !file_exists(public_path($userPhoto))) {
            $userPhoto = null;
        }

        // Elementos con coordenadas específicas (x, y)
        $data = [
            ['text' => 'FICHA RESUMEN DE USUARIO Y EMPRESA', 'x' => 150, 'y' => 50, 'size' => 18],
            ['text' => 'Generado el: ' . now()->format('d/m/Y H:i'), 'x' => 250, 'y' => 75, 'size' => 10],

            // Datos del Usuario
            ['text' => 'DATOS DEL USUARIO', 'x' => 50, 'y' => 100, 'size' => 14],
            ['text' => 'Nombre: ' . $user->name, 'x' => 50, 'y' => 220, 'size' => 12],
            ['text' => 'Email: ' . $user->email, 'x' => 50, 'y' => 240, 'size' => 12],
            ['text' => 'Compañia: ' . $user->company->business_name, 'x' => 50, 'y' => 260, 'size' => 12],

            // Datos de la Compañia
            ['text' => 'DATOS DE LA COMPAÑIA', 'x' => 50, 'y' => 310, 'size' => 14],
            ['text' => 'Razón Social: ' . $company->business_name, 'x' => 50, 'y' => 335, 'size' => 10],
            ['text' => 'Teléfono: ' . $company->phone, 'x' => 50, 'y' => 355, 'size' => 10],
            ['text' => 'Email Empresa: ' . $company->email, 'x' => 50, 'y' => 375, 'size' => 10],
            ['text' => 'IBAN AEAT: ' . ($company->iban_para_aeat ?? '---'), 'x' => 50, 'y' => 395, 'size' => 10],
            ['text' => 'SWIFT/BIC AEAT: ' . ($company->swift_bic_para_aeat ?? '---'), 'x' => 50, 'y' => 415, 'size' => 10],
            ['text' => 'Inscrito en Registro de Devolución Mensual: ' . ($company->inscrito_registro_devolucion_mensual ? 'Sí' : 'No'), 'x' => 50, 'y' => 435, 'size' => 10],
            ['text' => 'Tributa Exclusivamente en Régimen Simplificado: ' . ($company->tributa_exclusivamente_regimen_simplificado ? 'Sí' : 'No'), 'x' => 50, 'y' => 455, 'size' => 10],
            ['text' => 'Autoliquidación Conjunta: ' . ($company->autoliquidacion_conjunta ? 'Sí' : 'No'), 'x' => 50, 'y' => 475, 'size' => 10],
            ['text' => 'Declarado en Concurso de Acreedores: ' . ($company->declarado_concurso_acreedores ? 'Sí' : 'No'), 'x' => 50, 'y' => 495, 'size' => 10],
            ['text' => 'Fecha Concurso Acreedores: ' . ($company->fecha_concurso_acreedores ? \Carbon\Carbon::parse($company->fecha_concurso_acreedores)->format('d/m/Y') : '---'), 'x' => 50, 'y' => 515, 'size' => 10],
            ['text' => 'Autoliquidación Concurso Acreedores Preconcursal: ' . ($company->concurso_acreedores_autoliquidacion_preconcursal ? 'Sí' : 'No'), 'x' => 50, 'y' => 535, 'size' => 10],
            ['text' => 'Autoliquidación Concurso Acreedores Postconcursal: ' . ($company->concurso_acreedores_autoliquidacion_postconcursal ? 'Sí' : 'No'), 'x' => 50, 'y' => 555, 'size' => 10],
            ['text' => 'Régimen Especial de Criterio de Caja: ' . ($company->regimen_especial_criterio_caja ? 'Sí' : 'No'), 'x' => 50, 'y' => 575, 'size' => 10],
            ['text' => 'Opción Régimen Especial de Criterio de Caja: ' . ($company->opcion_criterio_caja ? 'Sí' : 'No'), 'x' => 50, 'y' => 595, 'size' => 10],
            ['text' => 'Destinatario Operaciones Régimen Especial de Criterio de Caja: ' . ($company->destinatario_operaciones_regimen_especial_criterio_caja ? 'Sí' : 'No'), 'x' => 50, 'y' => 615, 'size' => 10],
            ['text' => 'Aplicación Prorrata Especial: ' . ($company->aplicacion_prorrata_especial ? 'Sí' : 'No'), 'x' => 50, 'y' => 635, 'size' => 10],
            ['text' => 'Revocación Prorrata Especial: ' . ($company->revocacion_prorrata_especial ? 'Sí' : 'No'), 'x' => 50, 'y' => 655, 'size' => 10],
            ['text' => 'Exonerado Modelo 390: ' . ($company->exonerado_modelo_390 ? 'Sí' : 'No'), 'x' => 50, 'y' => 675, 'size' => 10],
            ['text' => 'Volumen Operaciones Modelo 390: ' . ($company->volumen_operaciones_modelo_390 ?? '0.00'), 'x' => 50, 'y' => 695, 'size' => 10],
        ];

        $pdf = Pdf::loadView('dashboard.images.pdf', [
            'data' => $data,
            'userPhoto' => $userPhoto
        ]);

        return $pdf->download('datos_usuario_compania_' . $user->id . '.pdf');
    }
}
