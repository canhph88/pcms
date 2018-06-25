<?php

namespace Modules\Excel\Entities;

use App\User;
use Maatwebsite\Excel\Facades\Excel;

class UsersExcel
{

    public function __construct()
    {
        $this->count = 0;
    }

    public function export()
    {
        $users = User::all();
        return Excel::create('user_'.time(), function($excel) use ($users) {
            $excel->sheet('users', function($sheet) use ($users)
            {
                $sheet->row(1, array('#', 'id', 'name', 'username', 'email', 'role', 'phone', 'address'));
                /**
                 * @var User $item
                 */
                foreach($users as $index=>$item) {

                    $rolesString = '';
                    foreach($item->roles as $miniIndex=>$role)
                    {
                        $rolesString =$rolesString.''.$role['name'];
                        if ($miniIndex < ($item->roles->count()) - 1) {
                            $rolesString = $rolesString.',';
                        }
                    }

                    $sheet->appendRow(array(
                        $index+1,
                        $item['id'],
                        $item['name'],
                        $item['username'],
                        $item['email'],
                        $rolesString,
                        $item['phone'],
                        $item['address']
                    ));
                }
            });
        })->download('xlsx');

    }
}
