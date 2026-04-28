# Mejoras a PRUEBA TÉCNICA

## Migración 2026_04_21_185722_create_companies_table

Cambiar el campo email a nullable ya que si en el momento se desconoce el email no se detiene el proceso de creación

**$table->string('email', 255)->nullable()->unique();**

## Migración 2026_04_21_221055_add_company_and_photo_to_users

Evita que se eliminen los usuarios en caso de que se elimine la compañia

**$table->foreignId('company_id')->constrained()->nullOnDelete();**

## Modelo Company

Agregar casts para la conversión automática de los datos al leerlos

``` php
protected $casts = [
    'fecha_concurso_acreedores' => 'date',
    'inscrito_registro_devolucion_mensual' => 'boolean',
    'tributa_exclusivamente_regimen_simplificado' => 'boolean',
    'autoliquidacion_conjunta' => 'boolean',
    'declarado_concurso_acreedores' => 'boolean',
    'concurso_acreedores_autoliquidacion_preconcursal' => 'boolean',
    'concurso_acreedores_autoliquidacion_postconcursal' => 'boolean',
    'regimen_especial_criterio_caja' => 'boolean',
    'aplicacion_prorrata_especial' => 'boolean',
    'revocacion_prorrata_especial' => 'boolean',
    'exonerado_modelo_390' => 'boolean',
    'volumen_operaciones_modelo_390' => 'float:2',
];
```
A partir de **Laravel 10.40** se puede usar *decimal* en lugar de *float*

## Cambiar el seeder actual por uno con factory

Crear factory

**php artisan make:factory CompanyFactory**

Configurar factory

```php
namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        // Lógica coherente para concursos: solo 20% de probabilidad
        $enConcurso = $this->faker->boolean(20);

        return [
            'business_name' => $this->faker->company(),
            'phone'         => $this->faker->optional(0.8)->numerify('+34 9## ### ###'),
            'email'         => $this->faker->unique()->safeEmail(),
            
            // IBAN español (ES + 2 dígitos control + 20 dígitos)
            'iban_para_aeat' => $this->faker->iban('ES'),
            // SWIFT/BIC: 8 u 11 caracteres (4 banco + 2 país + 2 ubicación + 3 sucursal opcional)
            'swift_bic_para_aeat' => strtoupper($this->faker->lexify('????')) . 'ES' . strtoupper($this->faker->lexify('??')),

            // Flags booleanos (50% true/false por defecto)
            'inscrito_registro_devolucion_mensual' => $this->faker->boolean(),
            'tributa_exclusivamente_regimen_simplificado' => $this->faker->boolean(),
            'autoliquidacion_conjunta' => $this->faker->boolean(),
            
            // Concurso de acreedores (coherente)
            'declarado_concurso_acreedores' => $enConcurso,
            'fecha_concurso_acreedores' => $enConcurso ? $this->faker->dateTimeBetween('-5 years', 'now') : null,
            'concurso_acreedores_autoliquidacion_preconcursal' => $enConcurso ? $this->faker->boolean() : false,
            'concurso_acreedores_autoliquidacion_postconcursal' => $enConcurso ? $this->faker->boolean() : false,

            // Régimen criterio caja
            'regimen_especial_criterio_caja' => $this->faker->boolean(),
            'opcion_criterio_caja' => $this->faker->randomElement(['activa', 'renunciada', 'pendiente']),
            'destinatario_operaciones_regimen_especial_criterio_caja' => $this->faker->randomElement(['cliente', 'proveedor', 'agencia_tributaria']),

            // Prorrata
            'aplicacion_prorrata_especial' => $this->faker->boolean(),
            'revocacion_prorrata_especial' => $this->faker->boolean(),

            // Modelo 390
            'exonerado_modelo_390' => $this->faker->boolean(),
            'volumen_operaciones_modelo_390' => $this->faker->randomFloat(2, 5000, 6000000),
        ];
    }
}
```

Cambiar el código de **DatabaseSeeder**

``` php
namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Generar 10 empresas con datos realistas aleatorios
        Company::factory(10)->create();

        // 2. Empresa específica para desarrollo/pruebas
        Company::factory()->create([
            'business_name' => 'Tecnología Fiscal S.L.',
            'email'         => 'admin@fiscal.dev',
            'phone'         => '+34 911 234 567',
            'volumen_operaciones_modelo_390' => 250000.00,
            'exonerado_modelo_390' => true,
            'regimen_especial_criterio_caja' => false,
        ]);

    }
}
```

## Mejora de busqueda en **ImageController::index** para evitar N+1

En lugar de:
**$user = auth()->user();**

// Usar:
**$user = User::with('company')->find(auth()->id());**

## Acceso de usuario en **UpdateCompanyRequest** para mejora de seguridad

Sustituir *return true* en la funcion authorize por

``` php
public function authorize(): bool
{
    // Obtiene el modelo Company desde los parámetros de la URL
    $company = $this->route('company');
    
    // Compara la empresa asignada al usuario con la de la ruta
    if ($this->user()->company_id === $company->id) {
        return true;
    }

    return false
}
```

