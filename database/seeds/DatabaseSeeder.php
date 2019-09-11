<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('roles')->truncate();
        // DB::table('users')->truncate();

        // $role = Role::create([
        //     'name' => 'superAdmin',
        //     'label' => 'Super Admin',
        // ]);

        // $role = Role::create([
        //     'name' => 'admin',
        //     'label' => 'Administration',
        // ]);

        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserPermissionTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);

        $this->call(ValidationsTableSeeder::class);
        $this->call(LookupsTableSeeder::class);
        $this->call(SiteSettingsTableSeeder::class);
        $this->call(ZipCodesTableSeeder::class);
        $this->call(UserSettingsTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(DeveloperNotesTableSeeder::class);
        $this->call(LayoutBuilderSettingSeeder::class);

        $this->call(TableMaintenancesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);

        $this->call(StatesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CountiesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);

        $this->call(EmailSettingsTableSeeder::class);
        $this->call(ProgramTableSeeder::class);
        $this->call(ProgramDefaultTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
