/**
 * Classic WooCommerce forms mark invalid rows only visually (class .woocommerce-invalid).
 * Mirror that state as aria-invalid and link each field to its error message so screen readers
 * announce which field needs attention. The block checkout already does this itself.
 */
( function () {
	var syncing = false;

	function sync() {
		if ( syncing ) {
			return;
		}
		syncing = true;
		document.querySelectorAll( 'form .form-row' ).forEach( function ( row ) {
			var invalid = row.classList.contains( 'woocommerce-invalid' );
			row.querySelectorAll( 'input:not([type="hidden"]), select, textarea' ).forEach( function ( field ) {
				var message = field.id ? document.querySelector( '[data-id="' + field.id + '"]' ) : null;
				var described = ( field.getAttribute( 'aria-describedby' ) || '' ).split( ' ' ).filter( Boolean );
				if ( invalid ) {
					field.setAttribute( 'aria-invalid', 'true' );
					if ( message ) {
						message.id = message.id || 'cp-error-' + field.id;
						if ( described.indexOf( message.id ) === -1 ) {
							described.push( message.id );
						}
					}
				} else {
					field.removeAttribute( 'aria-invalid' );
					described = described.filter( function ( id ) {
						return id.indexOf( 'cp-error-' ) !== 0;
					} );
				}
				if ( described.length ) {
					field.setAttribute( 'aria-describedby', described.join( ' ' ) );
				} else {
					field.removeAttribute( 'aria-describedby' );
				}
			} );
		} );
		syncing = false;
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		if ( ! document.querySelector( 'form.checkout, form.woocommerce-form, form.woocommerce-EditAccountForm, form.edit-address' ) && ! document.querySelector( '.woocommerce form .form-row' ) ) {
			return;
		}
		new MutationObserver( sync ).observe( document.body, { subtree: true, childList: true, attributes: true, attributeFilter: [ 'class' ] } );
		sync();
	} );
}() );
