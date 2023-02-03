@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.scooter.title_singular') }}
    </div>

    <form method="POST" action="{{ route("admin.scooters.update", [$scooter->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="name" class="text-xs required">{{ trans('cruds.scooter.fields.name') }}</label>

                <div class="form-group">
                    <input type="text" id="name" name="name" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $scooter->name) }}" required>
                </div>
                @if($errors->has('name'))
                    <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.name_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="phone" class="text-xs required">{{ trans('cruds.scooter.fields.phone') }}</label>

                <div class="form-group">
                    <input type="text" id="phone" name="phone" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone', $scooter->phone) }}" required>
                </div>
                @if($errors->has('phone'))
                    <p class="invalid-feedback">{{ $errors->first('phone') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.phone_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="barcode" class="text-xs required">{{ trans('cruds.scooter.fields.barcode') }}</label>

                <div class="form-group">
                    <input type="text" id="barcode" name="barcode" class="{{ $errors->has('barcode') ? ' is-invalid' : '' }}" value="{{ old('barcode', $scooter->barcode) }}" required>
                </div>
                @if($errors->has('barcode'))
                    <p class="invalid-feedback">{{ $errors->first('barcode') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.barcode_helper') }}</span>
            </div>

            <div class="mb-3">
                <label for="model" class="text-xs required">{{ trans('cruds.scooter.fields.model') }}</label>

                <div class="form-group">
                    <input type="text" id="model" name="model" class="{{ $errors->has('model') ? ' is-invalid' : '' }}" value="{{ old('model', $scooter->model) }}" required>
                </div>
                @if($errors->has('model'))
                    <p class="invalid-feedback">{{ $errors->first('model') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.model_helper') }}</span>
            </div>
            
            <div class="mb-3">
                <label for="termen" class="text-xs required">{{ trans('cruds.scooter.fields.termen') }}</label>

                <div class="form-group">
                    <input type="text" id="termen" name="termen" class="{{ $errors->has('termen') ? ' is-invalid' : '' }}" value="{{ old('termen', $scooter->termen) }}" required>
                </div>
                @if($errors->has('termen'))
                    <p class="invalid-feedback">{{ $errors->first('termen') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.termen_helper') }}</span>
            </div>

            <div class="mb-3">
                <label for="problem" class="text-xs required">{{ trans('cruds.scooter.fields.problem') }}</label>

                <div class="form-group">
                    <textarea id="problem" name="problem" class="form-control w-full px-3 py-2 {{ $errors->has('problem') ? ' is-invalid' : '' }}" required>{{ old('problem', $scooter->problem) }}</textarea>
                </div>
                @if($errors->has('problem'))
                    <p class="invalid-feedback">{{ $errors->first('problem') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.problem_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="solved" class="text-xs required">{{ trans('cruds.scooter.fields.solved') }}</label>

                <div class="form-group">
                    <textarea id="solved" name="solved" class="form-control w-full px-3 py-2 {{ $errors->has('solved') ? ' is-invalid' : '' }}" required>{{ old('solved', $scooter->solved) }}</textarea>
                </div>
                @if($errors->has('solved'))
                    <p class="invalid-feedback">{{ $errors->first('solved') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.solved_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="price" class="text-xs required">{{ trans('cruds.scooter.fields.price') }}</label>

                <div class="form-group">
                    <input type="text" id="price" name="price" class="{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price', $scooter->price) }}" required>
                </div>
                @if($errors->has('price'))
                    <p class="invalid-feedback">{{ $errors->first('price') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.price_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="status" class="text-xs required">{{ trans('cruds.scooter.fields.status') }}</label>

                <div class="form-group">
                    <select class="select2{{ $errors->has('status_id') ? ' is-invalid' : '' }}" name="status_id" id="status" required>
                        @foreach($statuses as $id => $status)
                            <option value="{{ $id }}" {{ old('status_id', $scooter->status_id) == $id ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('status_id'))
                    <p class="invalid-feedback">{{ $errors->first('status_id') }}</p>
                @endif
                <span class="block">{{ trans('cruds.scooter.fields.status_helper') }}</span>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection