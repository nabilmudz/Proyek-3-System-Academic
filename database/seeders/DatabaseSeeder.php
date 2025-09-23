<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Student;
use Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'id' => Str::uuid(),
            'username' => 'admin',
            'email' => 'admin@polban.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'full_name' => 'Administrator',
        ]);
        $user = User::create([
            'id' => Str::uuid(),
            'username' => 'Mahasiswa',
            'email' => '12345678@polban.sch.id',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
            'full_name' => 'Mahasiswsa',
        ]);

        Student::create([
            'id'=> Str::uuid(),
            'user_id'=>$user->id,
            'name'=>$user->username,
            'nim'=>'12345678',
            'class'=>'1A',
            'study_program'=>'D3 Teknik Informatika',
            'major'=> 'Teknik Informatika',
            'gender'=>'L',
            'birth_date'=>'2006-01-01'
        ]);

        $courses=[
            [
                'id'=> 1,
                'code'=>'JTK001',
                'name'=>'Proyek 3',
                'description'=>'',
                'credits'=> 1,
                'semester'=> 3,
                'major'=> 'Teknik Informatika'
            ],
            [
                'id'=> 2,
                'code'=>'JTK002',
                'name'=>'Pemograman Proyek',
                'description'=>'',
                'credits'=> 1,
                'semester'=> 3,
                'major'=> 'Teknik Informatika'
            ],
            [
                'id'=> 3,
                'code'=>'JTK003',
                'name'=>'Pengenalan Rekayasa Perangkat Lunak',
                'description'=>'',
                'credits'=> 1,
                'semester'=> 3,
                'major'=> 'Teknik Informatika'
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
