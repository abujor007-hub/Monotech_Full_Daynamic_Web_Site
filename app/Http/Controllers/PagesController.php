<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
     $data['cpu']= Products::where('category', '=', 'CPU')->take(4)->get();
     $data['gpu']= Products::where('category', '=', 'GPU')->take(4)->get();
     $data['ram']= Products::where('category', '=', 'RAM')->take(4)->get();
     $data['storage']= Products::where('category', '=', 'Storage')->take(4)->get();
     $data['motherboard']= Products::where('category', '=', 'Motherboard')->take(4)->get();
     $data['psu']= Products::where('category', '=', 'Psu')->take(4)->get();
     $data['monitor']= Products::where('category', '=', 'Monitor')->take(4)->get();
     $data['accessories']= Products::where('category', '=', 'Accessories')->take(4)->get();
     $data['slider']= Products::where('category', '=', 'Slider')->take(4)->get();
        return view('pages.main.index',compact('data'));
    }

    public function product()

    {
        $product= Products::all();
    $data['cpu']= Products::where('category', '=', 'CPU')->take(4)->get();
     $data['gpu']= Products::where('category', '=', 'GPU')->take(4)->get();
     $data['ram']= Products::where('category', '=', 'RAM')->take(4)->get();
     $data['storage']= Products::where('category', '=', 'Storage')->take(4)->get();
     $data['motherboard']= Products::where('category', '=', 'Motherboard')->take(4)->get();
     $data['psu']= Products::where('category', '=', 'Psu')->take(4)->get();
     $data['monitor']= Products::where('category', '=', 'Monitor')->take(4)->get();
     $data['accessories']= Products::where('category', '=', 'Accessories')->take(4)->get();
     $data['accessories']= Products::where('category', '=', 'Slider')->take(4)->get();


        return view('pages.main.products', compact('product','data'));
    }

    public function about()
    {
        return view('pages.main.about');
    }
        public function contact()
    {
        return view('pages.main.contact');
    }

    public function productdetails()
    {
        return view('pages.main.product-details');
    }


        public function checkout()
    {
        return view('pages.main.checkout');
    }

            public function Login()
    {
        return view('pages.main.login');
    }


    
}
