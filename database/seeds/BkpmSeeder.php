<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Models\Role;
use App\User;
use App\Position;
use App\Dept;
use App\Grade;

class BkpmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: Seed User
        $role = Role::where('name', 'admin')->firstOrFail();
        $data = Storage::disk('local')->get("dataalumni.json", true);
        $datas = json_decode($data);
        $data_slice = $datas;            
        foreach ($data_slice as $ds) {
            $user = User::where('email', $ds->email)->orWhere('name', $ds->nama)->orWhere('username', str_replace(' ', '-', $ds->nip))->first();
            if (empty($user)) {
                User::create([
                    'username' => str_replace(' ', '-', $ds->nip),
                    'name' => $ds->nama,
                    'email' => $ds->email,
                    'mobile' => $ds->hp_telp,
                    'password' => Hash::make($ds->nama),
                    'password_encrypt' => my_encrypt($ds->nama),
                    'role_id' => $role->id,
                    'status' => 'finish',
                ]);
            }
        }

        $f_dept = Storage::disk('local')->get('bkpm_dept.json', true);
        $f_post = Storage::disk('local')->get('bkpm_position.json', true);
        $f_grade = Storage::disk('local')->get('bkpm_grade.json', true);

        // TODO: Seed Dept
        foreach (json_decode($f_dept) as $d) {
            if (!empty(Dept::where('title', $d->dept)->first())) {
                $dept = Dept::create([
                    'title' => $d->dept,
                ]);
            }
        }

        // TODO: Seed Position
        foreach (json_decode($f_post) as $p) {
            if (!empty(Position::where('title', $p->position)->first())) {
                $post = Position::create([
                    'title' => $p->position,
                ]);
            }
        }

        // TODO: Seed Grade
        foreach (json_decode($f_grade) as $g) {
            if (!empty(Grade::where('title', $g->grade)->first())) {
                $grade = Grade::create([
                    'title' => $g->grade,
                ]);
            }
        }
    }
}
