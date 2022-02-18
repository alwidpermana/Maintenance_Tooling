$(document).ready(function(){
	$('.btnUser').on('click', function(){
		$('#modal-profil').modal('show');
	})
	redirectLogin();
});
function redirectLogin() {
	var nik = '<?=$this->session->userdata("NIK")?>';
	if (nik == '') {
		window.location.href= '<?=base_url("Auth/Login")?>';
	}
}