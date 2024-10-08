
@extends('admin.admin')

@section('content')
    <div class="card <!--card-outline--> card-secondary">
        <div class="card-header">
            <h3 class="card-title">Demo-resources - {{ $item->name }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @include('admin.partials.info')

            <form>
                <fieldset>
                    <div class="row">
                        <div class="col col-6">
                            <div class="form-group">
                                <label>DemoResource</label>
                                <input type="text" class="form-control" value="{{ $item->name }}" readonly>
                            </div>
                        </div>

                        <div class="col col-6">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control" value="{{ $item->slug }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <div class="well well-light well-form-description">
                            {!! $item->description !!}
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="card-footer">
            @include('admin.partials.form.form_footer', ['submit' => false])
        </div>
    </div>
@endsection
