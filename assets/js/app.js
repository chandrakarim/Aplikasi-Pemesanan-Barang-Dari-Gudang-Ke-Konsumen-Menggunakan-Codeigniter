$(document).ready(function () {
	// On Load (disable class barang_keluar sama dengan true)
	$(".barang_keluar").attr('disabled', true);
	// On choise
	$("form input:radio").change(function () {
		if ($(this).val() == "barang_masuk") {
			$(".barang_keluar").attr('disabled', true); // (disable class barang_keluar sama dengan true)
		} else {
			$(".barang_keluar").attr('disabled', false); // (disable class barang_keluar sama dengan false)
		}
	});
});
