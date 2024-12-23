<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{
    protected $owner_id;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($owner_id)
    {
        $this->owner_id = $owner_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected function generateUsernameCode()
    {
        do {
            $code = rand(11111111, 99999999);
            $data = User::where('username', $code)->first();
            if (!$data) return $code;
        } while (true);
    }
    public function model(array $row)
    {
        $user = User::where('email',$row['email'])->first();
        if (!$user) {
            return new User([
                'username' => $this->generateUsernameCode(),
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'owner_id' => $this->owner_id,
                'active' => 1,
            ]);
        }
    }
}
