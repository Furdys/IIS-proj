<?php
use Faker\Generator as Faker;
use App\Sale;
use App\Branch;
use App\Classes\CartItem;
use App\Medicine;
use App\User;
use App\InsuranceCompany;
use Carbon\Carbon;

$factory->define(Sale::class, function (Faker $faker) {


    $medicines = Medicine::inRandomOrder()->limit($faker->numberBetween(1, 5))->get();

    $prescripted = false;
    foreach ($medicines as $medicine) {
        if ($medicine->prescription)
            $prescripted = true;
    }

    $branch = Branch::inRandomOrder()->first();

    $cart = [];
    foreach($medicines as $medicine)
    {
        $amount = $faker->numberBetween(1, 5);
        $branch->addSupply([$medicine->id => $amount]);
        $cart[] = new CartItem($medicine, $amount);
    }

    $createdAt = Carbon::parse($faker->dateTimeBetween('-1 year', 'now', 'Europe/Prague')->format("Y-m-d H:i:s"));

    $confimedAt = clone $createdAt;
    $createdAt->addSeconds($faker->numberBetween(1, 900));



    if($prescripted)
    {
        return $branch->addSale([
            'user_id' => User::inRandomOrder()->first()->id,
            'customer_nin' => 123,
            'insurance_company_id' => InsuranceCompany::inRandomOrder()->first()->id,
            'created_at' => $createdAt,
            'updated_at' => $confimedAt,
            'confirmed_at' => $confimedAt,
            'confirmed' => true,
        ], $cart);
    }
    else
    {
        return $branch->addSale([
            'user_id' => User::inRandomOrder()->first()->id,
            'created_at' => $createdAt,
            'updated_at' => $confimedAt,
            'confirmed_at' => $confimedAt,
            'confirmed' => true,
        ], $cart);
    }
});
