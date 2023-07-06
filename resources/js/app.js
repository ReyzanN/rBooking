import './bootstrap';
import $ from "jquery";
import 'datatables.net'
import L from 'leaflet';

/*
DataTables Definitions
*/
$(document).ready(function(){
    $('#MembersTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json',
        },
        lengthMenu: [5,10,20,30,40,50]
    });
})
