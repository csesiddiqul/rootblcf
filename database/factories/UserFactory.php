<?php

use Illuminate\Support\Str;
use App\User;
use App\School;
use App\Section;
use App\Department;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => e($faker->name),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => Str::random(10),
        'active' => 1,
        'role' => $faker->randomElement(['student', 'teacher', 'admin', 'accountant', 'librarian']),
        'role_title' => $faker->randomElement(['Student', 'Teacher', 'Admin', 'Accountant', 'Librarian']),
        'school_id' => function () use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'code' => function () use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('code')->toArray());
            else return factory(School::class)->create()->code;
        },
        'student_code' => $faker->unique()->randomNumber(7, false),
        'address' => e($faker->address),
        'about' => $faker->sentences(3, true),
        'pic_path' => $faker->imageUrl(640, 480),
        'phone_number' => $faker->unique()->phoneNumber,
        'verified' => 1,
        'section_id' => function () use ($faker) {
            if (Section::count())
                return $faker->randomElement(Section::where('section_number', 'Not like', 'Admission')->pluck('id')->toArray());
            else return factory(Section::class)->create()->id;
        },
        'department_id' => function () use ($faker) {
            if (Department::count())
                return $faker->randomElement(Department::pluck('id')->toArray());
            else return factory(Department::class)->create()->id;
        },
        'blood_group' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9']),
        'nationality' => 14,
        'gender' => $faker->randomElement(['1', '2', '3']),
        'stripe_id' => null,
        'card_brand' => null,
        'card_last_four' => null,
        'trial_ends_at' => null,
    ];
});

$factory->state(User::class, 'master', [
    'role' => 'master'
]);

$factory->state(User::class, 'accountant', [
    'role' => 'accountant'
]);

$factory->state(User::class, 'admin', [
    'role' => 'admin'
]);

$factory->state(User::class, 'librarian', [
    'role' => 'librarian'
]);

$factory->state(User::class, 'teacher', [
    'role' => 'teacher'
]);

$factory->state(User::class, 'student', [
    'role' => 'student'
]);
