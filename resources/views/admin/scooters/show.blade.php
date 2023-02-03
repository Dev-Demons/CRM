@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.show') }} {{ trans('cruds.scooter.title') }}
    </div>

    <div class="body">
        <div class="block pb-4">
            <a class="btn-md btn-gray" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <div id="scooterItemTable">
            <table class="striped bordered show-table">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.id') }}
                        </th>
                        <td>
                            {{ $scooter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.name') }}
                        </th>
                        <td>
                            {{ $scooter->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.phone') }}
                        </th>
                        <td>
                            {{ $scooter->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.barcode') }}
                        </th>
                        <td>
                            {{ $scooter->barcode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.model') }}
                        </th>
                        <td>
                            {{ $scooter->model }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.termen') }}
                        </th>
                        <td>
                            {{ $scooter->termen }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.problem') }}
                        </th>
                        <td>
                            <textarea style="background-color: transparent; border: 0px; outline: 0px; width: 100%;height: fit-content" disabled>{{ $scooter->problem }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.price') }}
                        </th>
                        <td>
                            {{ $scooter->price . '  LEI' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.solved') }}
                        </th>
                        <td>
                            {{ $scooter->solved }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.created_at') }}
                        </th>
                        <td>
                            {{ $scooter->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $scooter->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.status') }}
                        </th>
                        <td>
                            <span class="bg-blue-300 text-blue-800 text-sm font-semibold mr-2 px-1 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $scooter->status->name ?? '' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Signature:
                        </th>
                        <td>
                            <span>

                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @endif
                                
                                @if (File::exists(public_path('/signatures/'.$scooter->barcode.'.png')))
                                    <img src="{{ asset('signatures/'.$scooter->barcode.'.png') }}" style="width:150px; height:100px;" />
                                @else 
                                    <form method="POST" action="{{ route('admin.scooter-sign', [$scooter->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" class="form-control" name="image" accept="image/png" />
                            
                                        <button type="submit" class="signature-button">Upload</button>
                                    </form>
                                @endif
                        
                                
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-3">
               
            </div>
        </div>

        <div class="block pt-4">
            <a class="btn-md btn-blue import_btn" href="{{ route('admin.scooter-pdf', [$scooter->id]) }}">Print PDF</a>
            <a class="btn-md btn-green" href="{{ route('admin.scooters.edit', $scooter->id) }}">{{ trans('global.edit') }}</a>

        </div>
    </div>
</div>
@endsection
