<!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->

<div class="modal fade" id="modal-detail-siswa">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Siswa</h4> {{-- Modal Title --}}

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> {{-- Modal Close Button --}}
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body"> {{-- Modal Body Content --}}

			</div>

			<div class="modal-footer justify-content-between"> {{-- Modal Footer --}}
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

@push('html_scripts')
	<script>
		$('#modal-detail-siswa').change(function () {
			console.log('changed')
			// function ajaxStudentDetail (elem) {
			// 	elem = $(elem)
			// 	let user_id = elem.data('id')
			// 	$.ajax({
			// 		url: "{{ route('api.student.detail') }}",
			// 		type: 'GET',
			// 		data: { user_id },
			// 		success: function (res) {
			// 			console.log(res)
			// 		},
			// 		error: function (err) {
			// 			console.log(err)
			// 		}
			// 	})
			// }
		})
	</script>
@endpush
