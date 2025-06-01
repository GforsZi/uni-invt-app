<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // User::factory(10)->create();

        // Seed Roles
        for ($i = 0; $i < 10; $i++) {
            DB::table('roles')->insert([
                'rl_name'         => ucfirst($faker->unique()->word),
                'rl_description'  => $faker->sentence,
                'rl_created_at'      => now(),
                'rl_updated_at'      => now(),
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name'        => $faker->name,
                'email'       => $faker->unique()->safeEmail,
                'password'    => bcrypt('password'),
                'usr_role_id'     => $faker->numberBetween(1, 10),
                'usr_created_at'      => now(),
                'usr_updated_at'      => now(),
            ]);
        }

        // Seed CategoryAssets
        for ($i = 0; $i < 10; $i++) {
            DB::table('category_assets')->insert([
                'ctgy_ast_name'   => ucfirst($faker->unique()->word),
                'ctgy_ast_created_at'      => now(),
                'ctgy_ast_updated_at'      => now(),
            ]);
        }

        // Seed AssetOrigins
        for ($i = 0; $i < 10; $i++) {
            DB::table('asset_origins')->insert([
                'ast_orgn_name'   => ucfirst($faker->company),
                'ast_orgn_created_at'      => now(),
                'ast_orgn_updated_at'      => now(),
            ]);
        }

        // Seed Assets
        for ($i = 0; $i < 10; $i++) {
            DB::table('assets')->insert([
                'ast_name'        => $faker->word,
                'ast_category_id' => $faker->numberBetween(1, 10),
                'ast_origin_id'   => $faker->numberBetween(1, 10),
                'ast_created_by'  => $faker->numberBetween(1, 10),
                'ast_created_at'      => now(),
                'ast_updated_at'      => now(),
            ]);
        }

        // Seed DescriptionAssets
        for ($i = 0; $i < 10; $i++) {
            DB::table('description_assets')->insert([
                'desc_ast_description'   => $faker->sentence(3),
                'desc_ast_value'   => $faker->sentence(3),
                'desc_ast_created_at'      => now(),
                'desc_ast_updated_at'      => now(),
            ]);
        }

        // Seed AssetDescriptions (pivot)
        for ($i = 0; $i < 10; $i++) {
            DB::table('asset_descriptions')->insert([
                'ast_desc_description_id' => $faker->numberBetween(1, 10),
                'ast_desc_asset_id'        => $faker->numberBetween(1, 10),
            ]);
        }

        // Seed Locations
        for ($i = 0; $i < 10; $i++) {
            DB::table('locations')->insert([
                'lctn_name'       => $faker->city,
                'lctn_latitude'       => $faker->randomFloat(3, 10, 100),
                'lctn_longitude'       => $faker->randomFloat(3, 10, 100),
                'lctn_created_at'      => now(),
                'lctn_updated_at'      => now(),
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('relation_assets')->insert([
                'rltn_ast_room_id'     => $faker->numberBetween(1, 10),
                'rltn_ast_asset_id'    => $faker->numberBetween(1, 10),
                'rltn_ast_location_id' => $faker->numberBetween(1, 10),
            ]);
        }

        // Seed AssetLogs
        for ($i = 0; $i < 10; $i++) {
            DB::table('asset_logs')->insert([
                'ast_lg_asset_id'   => $faker->numberBetween(1, 10),
                'ast_lg_note' => $faker->sentence,
                'ast_lg_created_at'        => now(),
                'ast_lg_updated_at'        => now(),
            ]);
        }

        // Seed Loans
        for ($i = 0; $i < 10; $i++) {
            DB::table('loans')->insert([
                'ln_user_id'   => $faker->numberBetween(1, 10),
                'ln_loan_limit'      => $faker->dateTimeThisYear(),
                'ln_created_at'   => now(),
                'ln_updated_at'   => now(),
            ]);
        }

        // Seed LoaningAssets
        for ($i = 0; $i < 10; $i++) {
            DB::table('loaning_assets')->insert([
                'lng_ast_loan_id'  => $faker->numberBetween(1, 10),
                'lng_ast_asset_id' => $faker->numberBetween(1, 10),
                'lng_ast_created_at'       => now(),
                'lng_ast_updated_at'       => now(),
            ]);
        }

        // Seed LoanLocations
        for ($i = 0; $i < 10; $i++) {
            DB::table('loan_locations')->insert([
                'ln_lctn_loan_id'     => $faker->numberBetween(1, 10),
                'ln_lctn_asset_id'    => $faker->numberBetween(1, 10),
                'ln_lctn_location_id' => $faker->numberBetween(1, 10),
                'ln_lctn_created_at'          => now(),
                'ln_lctn_updated_at'          => now(),
            ]);
        }

        // Seed Returns
        for ($i = 0; $i < 10; $i++) {
            DB::table('returns')->insert([
                'rtrn_loan_id'  => $faker->numberBetween(1, 10),
                'rtrn_user_id'  => $faker->numberBetween(1, 10),
                'rtrn_created_at'    => now(),
                'rtrn_updated_at'    => now(),
            ]);
        }

        // Seed ReturningAssets
        for ($i = 0; $i < 10; $i++) {
            DB::table('returning_assets')->insert([
                'rtrng_ast_return_id' => $faker->numberBetween(1, 10),
                'rtrng_ast_asset_id'  => $faker->numberBetween(1, 10),
                'rtrng_ast_created_at'          => now(),
                'rtrng_ast_updated_at'          => now(),
            ]);
        }
        // $user->roles()->syncWithoutDetaching([$admin_role->id]);

        $admin_role = Role::firstOrCreate([
            'rl_name' => 'sapras',
            'rl_description' => 'saranaprasarana',
        ]);
        $user_role = Role::firstOrCreate([
            'rl_name' => 'user',
            'rl_description' => 'user role',
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'gfors',
                'password' => Hash::make('11111111'),
                'usr_activation' => true,
                'usr_role_id' => $admin_role->rl_id,
            ]
        );
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'zi',
                'password' => Hash::make('11111111'),
                'usr_activation' => true,
                'usr_role_id' => $user_role->rl_id,
            ]
        );
    }
}
