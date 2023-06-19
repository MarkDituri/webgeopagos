$(document).ready(function() {
	var btnPerfil = '<ul class="app-menu"><li><i class="fa fa-user"></i></li></ul>';
	var treeviewMenu = $('.app-menu');
	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');	
		$('.app-menu_qr').toggleClass('d-none');
		$('#user-imgMin').toggleClass('d-none');
		$('#user-iconMin').toggleClass('d-none');
		$('#app-sidebar__user').toggleClass('app-menu__item');
		$('#app-sidebar__user').toggleClass('app-sidebar__user');
		$('.notiPedidos').toggleClass('d-none');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();	

})
