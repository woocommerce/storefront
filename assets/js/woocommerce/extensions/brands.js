/**
 * brands.js
 *
 * Adds sticky functionality to the brands index.
 */
 ( function() {
 	document.addEventListener( 'DOMContentLoaded', function() {
		var brandsAZ = document.getElementsByClassName( 'brands_index' );

		if ( ! brandsAZ.length ) {
			return;
		}

		var adminBar              = document.body.classList.contains( 'admin-bar' ) ? 32 : 0,
			brandsContainerHeight = document.getElementById( 'brands_a_z' ).scrollHeight,
			brandsAZHeight        = brandsAZ[0].scrollHeight + 40;

		var stickyBrandsAZ = function() {
			if ( window.innerWidth > 768 && brandsAZ[0].getBoundingClientRect().top < 0 ) {
				brandsAZ[0].style.paddingTop = Math.min( ( Math.abs( brandsAZ[0].getBoundingClientRect().top ) + 20 + adminBar ), brandsContainerHeight - brandsAZHeight ) + 'px';
			} else {
				brandsAZ[0].style.paddingTop = 0;
			}
		};

		stickyBrandsAZ();

		window.addEventListener( 'scroll', function() {
			stickyBrandsAZ();
		} );
 	} );
} )();
