<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => fake()->name(),
            'apellidos' => fake()->lastName(),
            'correo' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'nacimiento' => fake()->date(),
            'documento' => fake()->numberBetween(100000000, 999999999),
            'genero' => fake()->randomElement(['Masculino', 'Femenino']),
            'fecha_creacion' => now(),
            'fecha_modificacion' => now(),
            'rol' => fake()->numberBetween(0, 1),
            'estado' => fake()->numberBetween(0, 1),
        ];
    }
}
