@extends('layouts.admin')
@section('content')
@can('scooter_create')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('admin.scooters.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.scooter.title_singular') }}
        </a>
    </div>
@endcan
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100 bg-red-600">
            <h2 class="font-semibold text-white">TROTINETE IN LUCRU</h2>
        </header>
        <div class="p-3">
            <div class="overflow-x-auto">
                @if (count($working_scooters) > 0)
                <table class="stripe hover bordered datatable datatable-Working">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.scooter.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.barcode') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.model') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.date') }}
                            </th>
                            <th>
                                {{ trans('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($working_scooters as $key => $scooter)
                            <tr data-entry-id="{{ $scooter->id }}">
                                <td align="center">
                                    {{ $scooter->name ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->phone ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->barcode ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->model ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->created_at && $scooter->created_at != '' ? date('d-m-Y', strtotime($scooter->created_at)) : '' }}
                                    
                                </td>
                                <td align="center">
                                    @can('scooter_show')
                                        <a class="btn-sm btn-indigo" href="{{ route('admin.scooters.show', $scooter->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('scooter_edit')
                                        <a class="btn-sm btn-blue" href="{{ route('admin.scooters.edit', $scooter->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="flex p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                    <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        <span class="font-medium">Info alert!</span> There is nothing working scooter list yet.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100 bg-green-500">
            <h2 class="font-semibold text-white">TROTINETE FINALIZATE</h2>
        </header>
        <div class="p-3">
            <div class="overflow-x-auto">
                @if (count($ready_scooters) > 0)
                <table class="stripe hover bordered datatable datatable-Ready">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.scooter.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.barcode') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.model') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.scooter.fields.date') }}
                            </th>
                            <th>
                                {{ trans('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ready_scooters as $key => $scooter)
                            <tr data-entry-id="{{ $scooter->id }}">
                                <td align="center">
                                    {{ $scooter->name ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->phone ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->barcode ?? '' }}
                                </td>
                                <td align="center">
                                    {{ $scooter->model ?? '' }}
                                </td>
                                <td align="center">
                                    {{--  $scooter->price ? number_format($scooter->price, 2) . 'LEI' : '' --}}
                                     {{ $scooter->price }}
                                </td>
                                <td align="center">
                                    {{ $scooter->updated_at && $scooter->updated_at != '' ? date('d-m-Y', strtotime($scooter->updated_at)) : '' }}
                                </td>
                                <td align="center">
                                    @can('scooter_show')
                                        <a class="btn-sm btn-indigo" href="{{ route('admin.scooters.show', $scooter->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('scooter_edit')
                                        <a class="btn-sm btn-blue" href="{{ route('admin.scooters.edit', $scooter->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="flex p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                    <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        <span class="font-medium">Info alert!</span> There is nothing ready scooter list yet.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
        $('.datatable-Working').DataTable({
            order: [[5, 'asc']],
        });
        $('.datatable-Ready').DataTable({
            order: [[6, 'asc']],
        });
    });
</script>
@endsection