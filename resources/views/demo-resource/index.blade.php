@extends('admin.admin')

@section('content')
	<div class="card <!--card-outline--> card-secondary">
        <div class="card-header">
            <h3 class="card-title">List All Demo-resources</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @include('admin.partials.info')

			@include('admin.partials.card.buttons')

            <table id="tbl-list" data-page-length="25" class="dt-table table table-sm table-bordered table-striped table-hover">
                <thead>
				<tr>
					<th>DemoResource</th>
					<th class="desktop">Description</th>
					<th>Created</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($items as $item)
					<tr>
						<td>{{ $item->name }}</td>
						<td>{!! $item->content !!}</td>
						<td>{{ $item->created_at->format('d M Y') }}</td>
						<td>{!! action_row($selectedNavigation->url, $item->id, $item->name, ['show', 'edit', 'delete']) !!}</td>
					</tr>
				@endforeach
				</tbody>
            </table>
        </div>
    </div>
@endsection
