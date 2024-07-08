import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;

import Swal from 'sweetalert2'
window.Swal = Swal

try {
    window.$.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    
    
} catch (e) {}