@extends('layouts.admin')
@section('content')
@can('scooter_create')
    <div class="block my-4">
        <a class="btn-md btn-green" href="{{ route('admin.scooters.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.scooter.title_singular') }}
        </a>
        <form class="inline-block" id="import_form" action="{{ route('admin.scooters-import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" id="selectedFile" name="file" style="display: none;" />
            <button class="btn-md btn-blue import_btn">Import Excel</button>
        </form>
    </div>
@endcan
<div class="main-card">
    <div class="header">
        {{ trans('cruds.scooter.title_singular') }} {{ trans('global.list') }}
    </div>
    
    <div class="body">
        <div class="w-full">
            <table class="stripe hover bordered datatable datatable-Scooter">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.scooter.fields.id') }}
                        </th>
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
                            {{ trans('cruds.scooter.fields.termen') }}
                        </th>
                        <th>
                            {{ trans('cruds.scooter.fields.problem') }}
                        </th>
                        <th>
                            {{ trans('cruds.scooter.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.scooter.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.scooter.fields.updated_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.scooter.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scooters as $key => $scooter)
                        <tr data-entry-id="{{ $scooter->id }}">
                            <td align="center">
                                {{ $scooter->id ?? '' }}
                            </td>
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
                                {{ $scooter->termen ?? '' }}
                            </td>
                            <td align="center">
                                {{ $scooter->problem ?? '' }}
                            </td>
                            <td align="center">
                                {{ $scooter->price . ' LEI' ?? '' }}
                            </td>
                            <td align="center">
                                {{ $scooter->created_at ?? '' }}
                            </td>
                            <td align="center">
                                {{ $scooter->updated_at ?? '' }}
                            </td>
                            <td align="center">
                                <span class="bg-blue-300 text-blue-800 text-sm font-semibold mr-2 px-1 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $scooter->status->name ?? '' }}</span>
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

                                @can('scooter_delete')
                                    <form action="{{ route('admin.scooters.destroy', $scooter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn-sm btn-red" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });
        let table = $('.datatable-Scooter:not(.ajaxTable)').DataTable()
        
        
        $(".import_btn").click(function (e) {
            e.preventDefault();
            $('#selectedFile').click();
        });
        $("#selectedFile").change(function () {
            if (confirm('Are you sure ?')) {
                $("#import_form").submit()
            }
        });
    })

</script>
@endsection