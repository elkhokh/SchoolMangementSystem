<?php
namespace App\Services\Admin;

use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class ClassService
{

    public function indexService(int $paginate = 10, ?string $search = null)
    { {
            $data = Classes::query();
            // $data = DB::table('classes');;
            if ($search) {
                //make operation in $data or query
                $data->where('name', 'like', "% $search %");
            }

            return $data->orderBy('id', 'asc')->paginate($paginate);


        }
    }
}
