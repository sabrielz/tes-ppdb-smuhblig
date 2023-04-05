<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->

@foreach ($alerts as $variant => $message)
	<?php
		$variant = $variant === 'error'
			? 'danger' : $variant;
		$icon = $variant === 'success'
			? 'fa fa-check'
			: 'fa fa-exclamation-triangle';
	?>

	<script>
		$(function () {
			$(document).Toasts('create', {
				title: 'Pemberitahuan',
				body: `{!! $message !!}`,
				class: 'bg-{{ $variant }}',
				close: true,
				autoHide: true,
				delay: 3000,
				icon: '{{ $icon }}'
			})
		})
	</script>
@endforeach
