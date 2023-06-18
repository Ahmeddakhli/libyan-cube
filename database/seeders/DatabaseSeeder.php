<?php
namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\DBHelpers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->command->info('Seeding...');
        DBHelpers::setFKCheckOff();

        $this->call(GroupsTableDataSeeder::class);
        $this->call(PermissionsTableDataSeeder::class);
        $this->call(GroupPermissionsTableDataSeeder::class);
        $this->call(UsersTableDataSeeder::class);
        $this->call(UserPermissionsTableDataSeeder::class);

        $this->call(ModulesTableDataSeeder::class);
        $this->call(PackagesTableDataSeeder::class);
        $this->call(PackageModulesTableDataSeeder::class);
        $this->call(HostnamesDataSeeder::class);
        $this->call(LanguagesDataSeeder::class);

        // Modules Seeders
        $this->call(\Modules\Dashboard\Database\Seeders\DashboardDatabaseSeeder::class);
        $this->call(\Modules\Inventory\Database\Seeders\InventoryDatabaseSeeder::class);
        $this->call(\Modules\Blog\Database\Seeders\BlogDatabaseSeeder::class);
        $this->call(\Modules\Services\Database\Seeders\ServicesDatabaseSeeder::class);
        $this->call(\Modules\Careers\Database\Seeders\CareersDatabaseSeeder::class);
        // $this->call(\Modules\Events\Database\Seeders\EventsDatabaseSeeder::class);
        $this->call(\Modules\WelcomeMessages\Database\Seeders\WelcomeMessagesDatabaseSeeder::class);
        $this->call(\Modules\Socials\Database\Seeders\SocialsDatabaseSeeder::class);
        $this->call(\Modules\Testimonials\Database\Seeders\TestimonialsDatabaseSeeder::class);
        $this->call(\Modules\Settings\Database\Seeders\SettingsDatabaseSeeder::class);
        $this->call(\Modules\Tags\Database\Seeders\TagsDatabaseSeeder::class);
        // $this->call(\Modules\Ratings\Database\Seeders\RatingsDatabaseSeeder::class);
        // $this->call(\Modules\Meetings\Database\Seeders\MeetingsDatabaseSeeder::class);
        $this->call(\Modules\Messages\Database\Seeders\MessagesDatabaseSeeder::class);
        $this->call(\Modules\ContactUS\Database\Seeders\ContactUSDatabaseSeeder::class);
        $this->call(\Modules\Notifications\Database\Seeders\NotificationsDatabaseSeeder::class);
        $this->call(\Modules\Attachments\Database\Seeders\AttachmentsDatabaseSeeder::class);
        $this->call(\Modules\Compares\Database\Seeders\ComparesDatabaseSeeder::class);
        $this->call(\Modules\Locations\Database\Seeders\LocationsDatabaseSeeder::class);
        $this->call(\Modules\KeyWords\Database\Seeders\KeyWordsDatabaseSeeder::class);
        $this->call(\Modules\About\Database\Seeders\AboutDatabaseSeeder::class);
        $this->call(\Modules\CMS\Database\Seeders\CMSDatabaseSeeder::class);
        $this->call(\Modules\SEO\Database\Seeders\SeoDatabaseSeeder::class);
        
        DBHelpers::setFKCheckOn();
        $this->command->info('All tables seeded!');
        Model::reguard();
    }
}
