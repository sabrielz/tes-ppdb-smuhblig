<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->

<?php $segments ??= request()->segments(); $segcrement = []; ?>

<div id="breadcrumb" class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0">{{ $metadata['title'] ?? '' }}</h1>
	</div>
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			@foreach ($segments as $segment)
				<?php $segcrement[] = $segment ?>

				@if ($loop->last) {{-- Last Item --}}
					<li class="breadcrumb-item active">{{ Str::title($segment) }}</li>
				@else {{-- Normal Breadcrumb Link --}}
					<li class="breadcrumb-item">
						<a href="/{{ implode('/', $segcrement) }}">{{ Str::title($segment) }}</a>
					</li>
				@endif
			@endforeach
		</ol>
	</div>
</div>
