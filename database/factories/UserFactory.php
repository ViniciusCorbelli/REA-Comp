<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $fname = $this->faker->firstName;
        $lname = $this->faker->lastName;
        $fullname = Str::lower($fname).Str::lower($lname);
        $status = $this->faker->numberBetween(0,2);
        switch ($status) {
            case 1:
                $status = User::ACTIVE;
                break;

            case 2:
                $status = User::INACTIVE;
                break;

                default:
                $status = User::PENDING;
                break;
        }
        return [
            'username' => $fullname,
            'first_name' => $fname,
            'last_name' => $lname,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'phone_number' => $this->faker->phoneNumber,
            'user_type' => User::USER_TYPE_USER,
            'status' => $status
        ];
    }
}
