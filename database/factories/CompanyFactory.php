<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
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

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->unique()->companyEmail,
        'logo' => 'storage/company_logos/' . $faker->image(storage_path() . '/app/public/company_logos', 200, 200, null, false),
        'website' => $faker->unique()->domainName,
    ];
});
