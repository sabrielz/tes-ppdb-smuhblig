<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->

<?php

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="/dashboard" class="brand-link">
		<img src="{{ asset($brand['logo']) ?? '' }}"
			alt="{{ $brand['name'] ?? '' }}"
			class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Alexander Pierce</a>
			</div>
		</div>

		<!-- SidebarSearch Form -->
		<div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				@foreach ($menu as $item)
					@if (isset($item['dropdowns']) && count($item['dropdowns']))
						<li class="nav-item {{ is_active_link($item)?'menu-open':'' }}">
							<a href="javascript:void()" class="nav-link {{ is_active_link($item)?'active':'' }}">
								<i class="nav-icon {{ $item['icon'] ?? 'fas' }}">
									{{ $item['icontext'] ?? '' }}
								</i>
								<p>
									{{ $item['label'] ?? '' }}
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								@foreach ($item['dropdowns'] as $dropdown)
									<li class="nav-item">
										<a href="{{ $dropdown['href'] ?? '' }}"
											title="{{ $dropdown['title'] ?? $dropdown['label'] ?? '' }}"
											class="nav-link {{ is_active_link($dropdown)?'active':'' }}">
											<i class="{{ $dropdown['icon'] ?? 'fa' }} nav-icon">
												{{ $dropdown['icontext'] ?? '' }}
											</i>
											<p>{{ $dropdown['label'] ?? '' }}</p>
										</a>
									</li>
								@endforeach
							</ul>
						</li>
					@elseif (isset($item['label']) && !isset($item['href']))
						<li class="nav-header"> {{ $item['label'] }} </li>
					@else
						<li class="nav-item">
							<a href="{{ $item['href'] ?? '' }}"
								title="{{ $item['title'] ?? $item['label'] ?? '' }}"
								class="nav-link {{  is_active_link($item)?'active':'' }}">
								<i class="nav-icon {{ $item['icon'] ?? 'fas' }}">
									{{ $item['icontext'] ?? '' }}
								</i>
								<p>
									{{ $item['label'] ?? '' }}
									<!-- <span class="right badge badge-danger">New</span> -->
								</p>
							</a>
						</li>
					@endif
				@endforeach
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
