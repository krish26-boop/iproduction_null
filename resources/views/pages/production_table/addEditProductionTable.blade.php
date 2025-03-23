@extends('layouts.app')
@section('script_top')
@endsection

@section('content')
    <section class="main-content-wrapper">
        <section class="content-header">
            <h3 class="top-left-header">
                {{ isset($title) && $title ? $title : '' }}
            </h3>
        </section>


        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                {!! Form::model(isset($obj) && $obj ? $obj : '', [
                    'method' => isset($obj) && $obj ? 'PATCH' : 'POST',
                    'route' => ['production_table.update', isset($obj->id) && $obj->id ? $obj->id : ''],
                ]) !!}
                @csrf
                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.table_name') <span class="required_star">*</span></label>
                                <input type="text" name="table_name" id="table_name" class="form-control @error('table_name') is-invalid @enderror" placeholder="Table Name" value="{{ isset($obj) && $obj->table_name ? $obj->table_name : old('table_name') }}">
                                @error('table_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label for="">@lang('index.floor_select') {!! starSign() !!}</label>
                                <select name="floor_id" id="floor_id"
                                    class="form-control @error('floor_id') is-invalid @enderror select2">
                                    <option value="">@lang('index.select')</option>
                                    @foreach ($floors as $floor)
                                        <option value="{{ $floor->id }}" {{ (isset($obj) && $obj->floor_id == $floor->floor_id) == $floor->id || old('floor_id') == $floor->floor_id ? 'selected' : '' }}>
                                            {{ $floor->name ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('floor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.number_of_seats')<span class="required_star">*</span></label>
                                <input type="number" name="number_of_seats" id="number_of_seats" class="form-control @error('number_of_seats') is-invalid @enderror" placeholder="Number of Seats" value="{{ isset($obj) && $obj->number_of_seats ? $obj->number_of_seats : old('number_of_seats') }}">
                                @error('number_of_seats')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.description_floor')<span class="required_star">*</span></label>
                                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="description" value="{{ isset($obj) && $obj->description ? $obj->description : old('description') }}">
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="row mt-2">
                    <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                        <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon icon="solar:check-circle-broken"></iconify-icon>@lang('index.submit')</button>
                        <a class="btn bg-second-btn" href="{{ route('production_table.index') }}"><iconify-icon icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('script_bottom')
@endsection
