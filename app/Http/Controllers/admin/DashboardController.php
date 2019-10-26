<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Slider;
use App\Contact;
use App\Category;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $categoryCount = Category::count();
        $itemCount = Item::count();
        $sliderCount = Slider::count();
        $reservations = Reservation::where('status',false)->get(); //obteniendo el status de la reservacion = false
        $contactCount = Contact::count();
        return view('admin.dashboard',compact('categoryCount','itemCount','sliderCount','reservations','contactCount'));
    }
}
