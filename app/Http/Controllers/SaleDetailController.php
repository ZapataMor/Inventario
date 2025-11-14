<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;

class SaleDetailController extends Controller
{
    public function destroy(SaleDetail $saleDetail)
    {
        $saleDetail->delete();
        return back()->with('success', "Detalle eliminado.");
    }
}
