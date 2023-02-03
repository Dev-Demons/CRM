<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScooterRequest;
use App\Http\Requests\StoreScooterRequest;
use App\Http\Requests\UpdateScooterRequest;
use App\Scooter;
use App\ScooterStatus;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ScootersImport;
use App\Services\SMSGatewayService;
use Gate;
use PDF;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScootersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scooter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scooters =  Scooter::all();

        return view('admin.scooters.index', compact('scooters'));
    }

    public function create()
    {
        abort_if(Gate::denies('scooter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = ScooterStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.scooters.create', compact('statuses'));
    }

    public function store(StoreScooterRequest $request, Scooter $scooter)
    {
        $check = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'barcode' => ['required', 'numeric', 'digits:6'],
            'model' => ['required', 'string'],
            'termen' => ['required', 'string'],
            'price' => ['required', 'string'],
            'problem' => ['required', 'string'],
            'status_id' => ['required','string']
        ]);
            
        $scooter = Scooter::create($request->all());

        return view('admin.scooters.show', compact('scooter'));
    }

    public function edit(Scooter $scooter)
    {
        abort_if(Gate::denies('scooter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = ScooterStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scooter->load('status');

        return view('admin.scooters.edit', compact('statuses', 'scooter'));
    }

    public function update(UpdateScooterRequest $request, Scooter $scooter, SMSGatewayService $SMSGateway)
    {
        $scooter->update($request->all());
        $ready_status = ScooterStatus::where('name', 'FINALIZAT')->first();
        if ($request->status_id == $ready_status->id) {
            $message = "Buna ziua,\nTrotineta dvs este gata.\nCost " . $scooter->price . "lei!\n\n";
            $message .= "O zi buna !\n";
            $message .= "Doctortrotineta.ro\n0723110511\nProgram luni-vineri 08.00-17.00";

            $messageId = $SMSGateway->sendMessage($scooter->phone, $message);
        }
        return view('admin.scooters.show', compact('scooter'));

    }

    public function show(Scooter $scooter)
    {
        abort_if(Gate::denies('scooter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scooter->load('status');

        return view('admin.scooters.show', compact('scooter'));
    }

    public function destroy(Scooter $scooter)
    {
        abort_if(Gate::denies('scooter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scooter->delete();

        return back();
    }

    public function massDestroy(MassDestroyScooterRequest $request)
    {
        Scooter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function import(Request $request)
    {
        Excel::import(new ScootersImport, $request->file('file')->store('temp'));
        return back();
    }

    public function generatePDF(Request $request)
    {
        $scooter = Scooter::where('id', $request->id)->first()->toArray();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif', 'images' => true])->loadView('admin.scooters.pdf', ['scooter' => $scooter]);

        return $pdf->download('scooter-' . time() . '.pdf');
    }
    
    public function uploadSIGN(Request $request)
    {
        $scooter = Scooter::where('id', $request->id)->first()->toArray();
        
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:20480'
        ]);

        $imageName = $scooter['barcode'] .'.'.$request->image->extension();

        $request->image->move(public_path('signatures'), $imageName);

        return back()->with('success', 'Signature uploaded Successfully!');
    }
}
