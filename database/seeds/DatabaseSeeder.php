<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //        $this->call(UsersTableSeeder::class);
        \App\attendance::create([
            'users_id' => 75,
            'date' => '2018-06-01',
            'check_in' => '07:15:44',
            'check_out' => '17:00:00',
            'attendance_status' => 'present',
        ]);
        \App\attendance::create([
            'users_id' => 75,
            'date' => '2018-06-02',
            'check_in' => '07:15:44',
            'check_out' => '17:00:00',
            'attendance_status' => 'present',
        ]);
        \App\attendance::create([
            'users_id' => 75,
            'date' => '2018-06-03',
            'check_in' => '07:15:44',
            'check_out' => '17:00:00',
            'attendance_status' => 'present',
        ]);
        // \App\attendance::create([
        //     'users_id' => 75,
        //     'date' => '2019-05-04',
        //     'check_in' => '07:15:44',
        //     'check_out' => '17:00:00',
        //     'attendance_status' => 'present',
        // ]);
        // \App\attendance::create([
        //     'users_id' => 75,
        //     'date' => '2019-05-05',
        //     'check_in' => '07:15:44',
        //     'check_out' => '17:00:00',
        //     'attendance_status' => 'present',
        // ]);
        // \App\attendance::create([
        //     'users_id' => 75,
        //     'date' => '2019-05-06',
        //     'check_in' => '07:15:44',
        //     'check_out' => '17:00:00',
        //     'attendance_status' => 'present',
        // ]);
        // \App\attendance::create([
        //     'users_id' => 75,
        //     'date' => '2019-05-07',
        //     'check_in' => '07:15:44',
        //     'check_out' => '17:00:00',
        //     'attendance_status' => 'present',
        // ]);
        
        // // -----------------------------
        \App\userHasPeformance::create([
            'attendance_id' => 13,
            'workingDays_id' => 3,
        ]);
        \App\userHasPeformance::create([
            'attendance_id' => 14,
            'workingDays_id' => 3,
        ]);
        \App\userHasPeformance::create([
            'attendance_id' => 15,
            'workingDays_id' => 3,
        ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 4,
        //     'workingDays_id' => 2,
        // ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 5,
        //     'workingDays_id' => 2,
        // ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 6,
        //     'workingDays_id' => 2,
        // ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 7,
        //     'workingDays_id' => 3,
        // ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 33,
        //     'workingDays_id' => 1,
        // ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 34,
        //     'workingDays_id' => 1,
        // ]);
        // \App\userHasPeformance::create([
        //     'attendance_id' => 35,
        //     'workingDays_id' => 1,
        // ]);
 
    }
}
