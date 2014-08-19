function elegirTabTaskForce( tf_id ) {
	document.getElementById( 'tabber_tf' ).tabber.tabShow( tf_id - 1 );
}
function showLoading() {
	$('#popup').html('<div style="height: 100px">Cargando datos...</div>').dialog( 
		{ modal: true,
		  buttons: {},
		  title: 'Por favor espere...' }
	);
}
function showModal( html, title ) {
	$('#popup').html('<div style="height: 380px; overflow: auto">' + html + '</div>').dialog( 
		{ modal: true,
		  buttons: {},
		  width: 800,
		  title: title }
	);
}
function showSmallModal( html, title ) {
	$('#popup').html('<div style="overflow: auto">' + html + '</div>').dialog( 
		{ modal: true,
		  width: '400px',
		  buttons: {},
		  title: title }
	).css('padding-top', '0px');
}
function showModalW( html, title, width ) {
	$('#popup').html('<div style="height: 380px; overflow: auto">' + html + '</div>').dialog( 
		{ modal: true,
		  buttons: {},
		  width: width,
		  title: title }
	);
}
/*
function abrirReportados( userid ) {
//       var mylink = "http://srvca/caisd/pdmweb.exe?OP=SEARCH+FACTORY=cr+QBE.EQ.log_agent.userid="+userid+"+QBE.NE.status.description=Cerrada+QBE.NE.assignee.userid="+userid;
       window.open(mylink, "Tickets", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=1200, height=900");
           }
  */      
/*   
function abrirAsignados( userid )
{
//	var mylink = "http://srvca/caisd/pdmweb.exe?OP=SEARCH+FACTORY=cr+QBE.NE.status.description=Cerrada+QBE.EQ.assignee.userid="+userid;
	window.open(mylink, "Tickets", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=1200, height=900");
}
*/
function abrirAuto( mylink )
{
	window.open(mylink, "Tickets", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=1200, height=900");
}
/*
function abrirTotalAbiertos()
{
//	var mylink = "http://srvca/caisd/pdmweb.exe?OP=SEARCH+FACTORY=cr+QBE.NE.status.description=Cerrada";
	window.open(mylink, "Tickets", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=1200, height=900");
}
*/

$.ajaxSetup({
	// Evitar problemas de cache en IE
	cache: false	
});

function setupCalendarios() {
	$('.calendario').datepicker({dateFormat: 'dd-mm-yy', 
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
			'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		firstDay: 1
	 });
	$('.calendario_time').datetimepicker({dateFormat: 'dd-mm-yy', 
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
			'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		timeText: "Hora",
		hourText: "Hora",
		minuteText: "Minuto",
		stepMinute: 5,
		hourMin: 8,
		hourMax: 21,
		currentText: 'Ahora',
		closeText: 'Aceptar',
		firstDay: 1
	 });
}

var notif_t = null;

function generarPopupNotificaciones( pendientes ) {
	var htmlpop = '';
	var htmlemb = '';
	for( var i = 0; i < pendientes.length; i++ ) {
		var pendiente = pendientes[i];
		var html = "<div class='notificacion'>";
		html += "<div class='close adivsoft'><a class='softbtn' href='#' nid='" + pendiente['id'] + "'>Eliminar</a></div>";
		html += "<div class='posponer adivsoft'><a href='#' class='softbtn' minutos='30' nid='" + pendiente['id'] + "'>Posponer 30'</a></div>";
		html += "<div class='fecha'>De " + pendiente['fecha'] + ":</div>";
		html += "<div class='mensaje'>" + pendiente['mensaje'] + "</div>";
		if( pendiente['link'] )
			html += "<div class='seguir adivsoft'><a class='softbtn' href='" + pendiente['link'] + "'>Seguir link</a></div>";
		html += "<div style='clear: both'></div></div>";
		if( pendiente['embebida'] )
			htmlemb += html;
		else
			htmlpop += html;
	}
	if( htmlpop.length )	
		showSmallModal( htmlpop, "Notificaciones pendientes" );
	if( htmlemb.length )
		$('#notificaciones').html( htmlemb );
}

function runBucleNotificaciones() {
	if( typeof( raiz ) != 'undefined' ) {
		$.ajax( { url: raiz + 'notificaciones/check',
			error: function() {},
			success: function(data) {
				var ev = eval('(' + data + ')');
				if( ev['cantidad'] > 0 ) {
					generarPopupNotificaciones( ev['pendientes'] );
				}
			} 
		} );
		notif_t = setTimeout( 'runBucleNotificaciones()', 60000 );
	}
}

function iniciarBucleNotificaciones() {
	notif_t = setTimeout( 'runBucleNotificaciones()', 2000 );
	$('.notificacion .close a').live('click', function(e) {
		e.preventDefault();
		$.ajax( { url: raiz + 'notificaciones/delete?id=' + $(this).attr('nid'),
			error: function() { alert( 'Error' ); },
			success: function( data ) {
				$('#popup').dialog('close');
				clearTimeout( notif_t );
				runBucleNotificaciones();
			} } );
	} );
	$('.notificacion .posponer a').live('click', function(e) {
		e.preventDefault();
		$.ajax( { url: raiz + 'notificaciones/posponer?id=' + $(this).attr('nid') + '&minutos=' 
			+ $(this).attr('minutos'),
			error: function() { alert( 'Error' ); },
			success: function( data ) {
				$('#popup').dialog('close');
				clearTimeout( notif_t );
				runBucleNotificaciones();
			} } );
	} );
}

function prepareAutoContacts() {
	$('.autocontact').each( function() { 
		var src = $(this).attr('src');
		if( !src )
			alert('Un autocontact siempre debe tener el atributo src');
		$(this).autocomplete( { source: src } );	
	} );
	$('.autocontact_ex').each( function() { 
		var src = $(this).attr('src');
		if( !src )
			alert('Un autocontact siempre debe tener el atributo src');
		$(this).autocomplete( { source: src } );
		$(this).change( function( e ) {
			var exclude = $(this).attr('exclude');
			$(exclude).val('');
		} );
	} );
}

$(document).ready( function() {
	iniciarBucleNotificaciones();
	setupCalendarios();
/*
	$('.reportados').click( function(e ) {
		e.preventDefault();
		abrirReportados( $(this).attr('iniciales') );
	} );
*/
/*
	$('.asignados').click( function(e ) {
		e.preventDefault();
		abrirAsignados( $(this).attr('iniciales') );
	} );
*/
	$('.autoopen').live('click', function(e ) {
		e.preventDefault();
		abrirAuto( $(this).attr('href') );
	} );
	$('.autodialog').live('click', function(e ) {
		e.preventDefault();
		$.ajax( { url: $(this).attr('href'),
			error: function() { 
				alert('Error');
			},
			success: function(data) {
				showModalW( data, 'Filtro',600 );
			}
		} );
	} );
	prepareAutoContacts();
	$('.confirmarDelete').live('click', function(e) {
		if( !(confirm( '¿Confirmas que deseas borrar o desactivar el registro?') ) ) {
			e.preventDefault();
		}
	} );
	$('#crearTicketABM').click( function(e) {
		e.preventDefault();
		var url = $(this).attr('url');
		$.ajax( { url: url,
			error: function() { 
				$('#popup').dialog('close');
				alert( 'Error' ); 
			},
			success: function( data ) {
				if(parseInt(data) != undefined ) {
					$('.error_crear_ticket').html(data.replace(/\n/g,"<br/>")).show();
					$('#crid').val( '' );
					$('#popup').dialog('close');
				} else {
					$('#crid').val( data );
					$('#popup').dialog('close');
					$('.error_crear_ticket').hide();
				}
			}
		} );
	} );
/*
	$('.total_abiertos').click( function(e ) {
		e.preventDefault();
		abrirTotalAbiertos();
	} );
*/
} );
