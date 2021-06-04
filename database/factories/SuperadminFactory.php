<?php

namespace Database\Factories;

use App\Models\Superadmin;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuperadminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Superadmin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'SuperAdmin',
            'email' => 'auperadmin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}