<?php

namespace App\Http\Controllers\Cabinet\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clients;
use App\Pack;
use App\Deals;
use App\Organization;
use Auth;

class ClientsController extends Controller
{
    public function index(){
    	if(Pack::getPack()['pack'] == 1){ return redirect()->route('cabinet.organization.pay', app()->getLocale()); }

    	$clients = Clients::where('user_id', Auth::user()->id)->get();
    	return view('cabinet.organization.clients.index', compact('clients'));
    }

    public function add(){
    	if(Pack::getPack()['pack'] == 1){ return redirect()->route('cabinet.organization.pay', app()->getLocale()); }

    	return view('cabinet.organization.clients.add');
    }

    public function save(Request $r){
    	Clients::saveNew($r);

    	return redirect()->route('cabinet.organization.clients.index', app()->getLocale());
    }

    public function delete(Request $r){
    	Clients::where('id', $r->id)->delete();

    	return redirect()->route('cabinet.organization.clients.index', app()->getLocale());
    }

    public function edit($lang, $id){
    	if(Pack::getPack()['pack'] == 1){ return redirect()->route('cabinet.organization.pay', app()->getLocale()); }

    	$client = Clients::where('id', $id)->first();
    	$organization = Organization::where('user_id', Auth::user()->id)->first();
    	$lists = Deals::where('phone_user', $client->phone)->where('organization_id', $organization->id)->get();
    	return view('cabinet.organization.clients.edit', compact('client', 'lists'));
    }

    public function update(Request $r){
    	Clients::updateNew($r);

    	return redirect()->back();
    }
}
