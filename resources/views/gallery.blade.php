@extends('layouts.dodolan2')
@section('title', 'Our Gallery')
@section('content')
<section id="page-content">
	<div class="container">
		<div class="row pd-bt-30">
		@foreach ($galleries as $gallery)
			<div class="col-md-3 mg-bt-10">
				<div class="gallery-display" title="{{ $gallery->title }}">
					<div class="gallery-overlay">
						<div class="gallery-caption pd-10">
							<h3 class="gallery-caption-title nowrap">{{ $gallery->title }}</h3>
							<p>
								@if (strlen($gallery->description) <= 100)
									{{ $gallery->description }}
								@else
									{{ substr($gallery->description, 0, 100).'...' }}
								@endif
							</p>
							<p>
							@for ($i=0; $i<$gallery->rating; $i++)
								<i class="fa fa-star"></i>
							@endfor
							</p>
						</div>
					</div>
					<img src="{{ asset('/uploads/'.$gallery->picture) }}" class="gallery-display-img" alt="{{ $gallery->title }}" title="{{ $gallery->title }}" />
				</div>
			</div>
		@endforeach
		</div>
	</div>
</section>
@endsection