<?php 

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('portal.payment');
    }

    public function postBuy(Request $request)
    {
        $user = \App\User::find(1);

        // $user->subscription($request->get('plan'))->create(, [
        //         'email' => $user->email
        //     ]);


        $user->charge($request->get('price'), [
            //'source' => $request->get('StripeToken'),
            'source' => $request->get('stripeToken'),
            'receipt_email' => $user->email,
        ]);

        return redirect($this->homePath());

    }

    public function homePath()
    {
        return property_exists($this, 'homePath') ? $this->homePath : '/home';
    }

}