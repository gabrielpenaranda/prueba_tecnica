<?php

namespace App\Services;

use App\Models\User;
use App\Models\Company;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageGenerationService
{
    protected $fontPath;
    protected $manager;

    public function __construct()
    {
        $this->fontPath = public_path('fonts/DejaVuSans.ttf');
        $this->manager = new ImageManager(new Driver());
    }

    public function generateUserImage(User $user)
    {
        // Canvas
        $width = 600;
        $height = 400;
        $img = $this->manager->createImage($width, $height)->fill('#ffffff');

        // Foto del usuario
        if ($user->photo && Storage::disk('public')->exists(str_replace('storage/', '', $user->photo))) {
            $photoPath = storage_path('app/public/' . str_replace('storage/', '', $user->photo));
            $userPhoto = $this->manager->decodePath($photoPath);
            $userPhoto->cover(150, 150);

            $img->insert($userPhoto, 0, 50, 'top-center');
        }

        // Nombre
        $img->text($user->name, $width / 2, 240, function ($font) {
            $font->file($this->fontPath);
            $font->size(36);
            $font->color('#1f2937'); // gray-800
            $font->align('center');
            // valign() eliminado por no existir en esta version
        });

        $img->text($user->email, $width / 2, 280, function ($font) {
            $font->file($this->fontPath);
            $font->size(24);
            $font->color('#1f2937'); // gray-800
            $font->align('center');
            // valign() eliminado por no existir en esta version
        });

        $img->text($user->company->business_name, $width / 2, 340, function ($font) {
            $font->file($this->fontPath);
            $font->size(30);
            $font->color('#1f2937'); // gray-800
            $font->align('center');
            // valign() eliminado por no existir en esta version
        });

        $fileName = 'user_' . $user->id . '.jpg';
        $path = 'images/' . $fileName;

        if (!Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $img->save(storage_path('app/public/' . $path));

        return 'storage/' . $path;
    }

    public function generateCompanyImage(?Company $company)
    {
        if (!$company) {
            return null;
        }

        // Canvas
        $width = 800;
        $height = 800;
        $img = $this->manager->createImage($width, $height)->fill('#ffffff');

        // Nombre Compañia
        /* $img->text($company->business_name, 50, 50, function ($font) {
            $font->file($this->fontPath);
            $font->size(32);
            $font->color('#1f2937');
            $font->align('left');
        }); */

        // Compañia
        $data = [
            'Teléfono' => $company->phone,
            'Email' => $company->email,
            'IBAN AEAT' => $company->iban_para_aeat,
            'SWIFT/BIC AEAT' => $company->swift_bic_para_aeat,
            'Inscrito en Registro de Devolución Mensual' => $company->inscrito_registro_devolucion_mensual ? 'Sí' : 'No',
            'Tributa Exclusivamente en Régimen Simplificado' => $company->tributa_exclusivamente_regimen_simplificado ? 'Sí' : 'No',
            'Autoliquidación Conjunta' => $company->autoliquidacion_conjunta ? 'Sí' : 'No',
            'Declarado en Concurso de Acreedores' => $company->declarado_concurso_acreedores ? 'Sí' : 'No',
            'Fecha Concurso' => \Carbon\Carbon::parse($company->fecha_concurso_acreedores)->format('d/m/Y') ?? '---',
            'Autoliquidación Concurso Acreedores Preconcursal' => $company->concurso_acreedores_autoliquidacion_preconcursal ? 'Sí' : 'No',
            'Autoliquidación Concurso Acreedores Postconcursal' => $company->concurso_acreedores_autoliquidacion_postconcursal ? 'Sí' : 'No',
            'Régimen Especial de Criterio de Caja' => $company->regimen_especial_criterio_caja ? 'Sí' : 'No',
            'Opción Régimen Especial de Criterio de Caja' => $company->opcion_criterio_caja ? 'Sí' : 'No',
            'Destinatario Operaciones Régimen Especial de Criterio de Caja' => $company->destinatario_operaciones_regimen_especial_criterio_caja ? 'Sí' : 'No',
            'Aplicación Prorrata Especial' => $company->aplicacion_prorrata_especial ? 'Sí' : 'No',
            'Revocación Prorrata Especial' => $company->revocacion_prorrata_especial ? 'Sí' : 'No',
            'Exonerado del Modelo 390' => $company->exonerado_modelo_390 ? 'Sí' : 'No',
            'Volumen de Operaciones Modelo 390' => $company->volumen_operaciones_modelo_390,
        ];

        $y = 40;
        foreach ($data as $label => $value) {
            $text = "$label: " . ($value ?? '---');
            $img->text($text, 50, $y, function ($font) {
                $font->file($this->fontPath);
                $font->size(18);
                $font->color('#4b5563'); // gray-600
                $font->align('left');
                // valign() eliminado
            });
            $y += 40;
        }

        $fileName = 'company_' . $company->id . '.jpg';
        $path = 'images/' . $fileName;

        if (!Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $img->save(storage_path('app/public/' . $path));

        return 'storage/' . $path;
    }
}
