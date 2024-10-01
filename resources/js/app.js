import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import './bootstrap';

/*
  Add custom scripts here
*/
import.meta.glob([
  './custom/index.js',
], { eager: true });

import '../assets/vendor/js/bootstrap.js'
import '../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js';
import Swal from 'sweetalert2';
window.Swal = Swal

import '../assets/vendor/libs/popper/popper.js'
import '../assets/vendor/libs/node-waves/node-waves.js'
import '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'
import '../assets/vendor/js/menu.js'
import '../assets/vendor/js/template-customizer.js'
import '../assets/js/main.js'

// import './custom/index.js';