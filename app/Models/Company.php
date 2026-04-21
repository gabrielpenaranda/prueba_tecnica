<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'phone',
        'email',
        'iban_para_aeat',
        'swift_bic_para_aeat',
        'inscrito_registro_devolucion_mensual',
        'tributa_exclusivamente_regimen_simplificado',
        'autoliquidacion_conjunta',
        'declarado_concurso_acreedores',
        'fecha_concurso_acreedores',
        'concurso_acreedores_autoliquidacion_preconcursal',
        'concurso_acreedores_autoliquidacion_postconcursal',
        'regimen_especial_criterio_caja',
        'opcion_criterio_caja',
        'destinatario_operaciones_regimen_especial_criterio_caja',
        'aplicacion_prorrata_especial',
        'revocacion_prorrata_especial',
        'exonerado_modelo_390',
        'volumen_operaciones_modelo_390',
    ];

    
    public function users()
    {
        return $this->hasMany(User::class);
    }


}
