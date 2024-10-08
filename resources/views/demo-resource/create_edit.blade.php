@extends('admin.admin')

@section('content')
    <div class="card <!--card-outline--> card-secondary">
        <div class="card-header">
            <h3 class="card-title">
                <span><i class="fa fa-edit"></i></span>
                <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new DemoResource' }}</span>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

            <div class="card-body">
                @include('admin.partials.info')

                <fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control {{ form_error_class('name', $errors) }}" id="name" name="name" placeholder="Enter Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                {!! form_error_message('name', $errors) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-6">
                            <div class="form-group">
                                <label for="active_from">Active From</label>
                                <div class="input-group">
                                    <input type="text" class="form-control {{ form_error_class('active_from', $errors) }}" id="active_from" name="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" placeholder="Enter Active From" value="{{ ($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : '')) }}">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                {!! form_error_message('active_from', $errors) !!}
                            </div>
                        </div>

                        <div class="col col-6">
                            <div class="form-group">
                                <label for="active_to">Active To</label>
                                <div class="input-group">
                                    <input type="text" class="form-control {{ form_error_class('active_to', $errors) }}" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="Enter Active To" value="{{ ($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : '')) }}">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                {!! form_error_message('active_to', $errors) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo (400 x 180)</label>
                                <div class="input-group input-group-sm">
                                    <input id="photo-label" type="text" class="form-control {{ form_error_class('photo', $errors) }}" readonly placeholder="Browse for a Logo">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" onclick="document.getElementById('photo').click();">Browse</button>
                                    </span>
                                    <input id="photo" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="photo" onchange="document.getElementById('photo-label').value = this.value">
                                </div>
                                {!! form_error_message('photo', $errors) !!}
                            </div>
                            @if(isset($item) && $item && $item->image)
                                <div>
                                    <img src="{{ $item->image_url }}" style="max-width: 100%; max-height: 300px;">
                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Document (Max 5MB)
                                    @if(isset($item) && $item->document)
                                        <a target="_blank" href="{{ $item->document_url }}">{!! $item->document->name !!}</a>
                                    @endif
                                </label>
                                <div class="input-group input-group-sm">
                                    <input id="file-label" type="text" class="form-control {{ form_error_class('file', $errors) }}" readonly placeholder="Browse for a document">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-default" onclick="document.getElementById('file').click();">Browse</button>
                                    </span>
                                    <input id="file" style="display: none" accept=".pdf" type="file" name="file" onchange="document.getElementById('file-label').value = this.value">
                                </div>
                                {!! form_error_message('file', $errors) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ form_error_class('content', $errors) }}">
                        <label for="content">Content</label>
                        <textarea class="form-control summernote" id="content" name="content" rows="18">{{ ($errors && $errors->any()? old('content') : (isset($item)? $item->content : '')) }}</textarea>
                        {!! form_error_message('content', $errors) !!}
                    </div>
                </fieldset>
            </div>
            <div class="card-footer">
                @include('admin.partials.form.form_footer')
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            initSummerNote('.summernote');

            setDateTimePickerRange('#active_from', '#active_to');
        })
    </script>
@endsection
