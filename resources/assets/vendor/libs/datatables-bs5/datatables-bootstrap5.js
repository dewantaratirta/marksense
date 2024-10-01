import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
// import JSZip from 'jszip';
// import pdfMake from 'pdfmake';
// import 'pdfmake/build/vfs_fonts';
import DataTable from "datatables.net-bs5";
window.DataTable = DataTable;
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-select-bs5';
import 'datatables.net-buttons';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-responsive';
import 'datatables.net-responsive-bs5';
// import 'datatables.net-rowgroup-bs5';
// import Checkbox from 'jquery-datatables-checkboxes';

// window.DataTable = Datatables;

// This solution related to font issues with pdfMake
// pdfMake.fonts = {
//   Roboto: {
//     normal: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Regular.ttf',
//     bold: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Medium.ttf',
//     italics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Italic.ttf',
//     bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-MediumItalic.ttf'
//   }
// };
// $.fn.dataTable.ext.Checkbox = Checkbox(window, $);
// $.fn.dataTable.ext.buttons.pdfMake = pdfMake;
// window.JSZip = JSZip;
