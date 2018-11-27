<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;

class GoodsController extends Controller
{
    
    public function index(Request $req) {

        $perPage = max(1, (int)$req->per_page);

        $sortBy = ($req->sortby== 'id' || $req->sortby=='created_at') ? $req->sortby : 'id';

        $order = ($req->order == 'asc' || $req->order == 'desc') ? $req->order : 'desc';

        // with : 取出关联表中的数据
        $data = Goods::with('attirubtes','images','skus')
                   ->where('goods_name', 'like', '%'.$req->keywords.'%')
                   ->orderBy($sortBy, $order)
                   ->paginate( $perPage  );


        return $data;
    }
}
