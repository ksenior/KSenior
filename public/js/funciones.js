 function filtro() {
  // Declare variables
  var input, filter, table, tr, td, i, select;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabla_datos");
  tr = table.getElementsByTagName("tr");
  select = $("#select_filtro").val();
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[select];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function download_xls(data, name){
  var wb = XLSX.utils.book_new();
  wb.SheetNames.push(name);
  var ws_data = data;
  var ws = XLSX.utils.json_to_sheet(ws_data);
  wb.Sheets[name] = ws;
  var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
  function s2ab(s) {
          var buf = new ArrayBuffer(s.length);
          var view = new Uint8Array(buf);
          for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i);
          return buf;
          
  }
  //console.log(s2ab(wbout));
  saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), name + ".xlsx");
}

function download_xls_table(table, name){
  console.log('table#'+table+' tr');
  var tbl = $('table#'+table+' tr').get().map(function(row) {
  return $(row).find('td').get().map(function(cell) {
    return $(cell).html();
  });
});
  console.log(tbl);
  var wb = XLSX.utils.book_new();
  wb.SheetNames.push("datos");
  var ws = XLSX.utils.table_to_sheet(document.getElementById(table), {'cellDates':'true', 'dateNF': 'yyyy/mm/dd hh:mm:ss'});
  wb.Sheets["datos"] = ws;  
  var wbout = XLSX.write(wb, {bookType:'xlsx', type: 'binary'});
  function s2ab(s) {
          var buf = new ArrayBuffer(s.length);
          var view = new Uint8Array(buf);
          for (var i=0; i<=s.length; i++){
            //console.log(s.charCodeAt(i) & 0xFF);
            view[i] = s.charCodeAt(i) & 0xFF;
          } 
          return buf;        
  }
  saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), name + ".xlsx");
  //saveAs(new Blob([wbout],{type:"application/octet-stream"}), "prueba.xlsx");
}

function export_xls_table(table, name, formato){
  var wb = XLSX.utils.book_new();
  wb.SheetNames.push("datos");
  if(formato == 1){
    var ws = XLSX.utils.table_to_sheet(document.getElementById(table), {'cellDates':'true', 'dateNF': 'dd/mm/yyyy hh:mm:ss'});
  } else {
    var ws = XLSX.utils.table_to_sheet(document.getElementById(table), {'cellDates':'true', 'dateNF': 'yyyy/mm/dd'});
  }
  wb.Sheets["datos"] = ws;  
  console.log(wb);
  var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
  console.log(wbout);
  function s2ab(s) {
          var buf = new ArrayBuffer(s.length);
          var view = new Uint8Array(buf);
          for (var i=0; i<=s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
          return buf;        
  }
  saveAs(new Blob([s2ab(wbout)],{type:"application/vnd.ms-excel"}), name + ".xlsx");
  //saveAs(new Blob([wbout],{type:"application/octet-stream"}), "prueba.xlsx");
}

var formatNumber = {
  separador: ".", // separador para los miles
  sepDecimal: ',', // separador para los decimales
  formatear:function (num){
    num +='';
    var splitStr = num.split('.');
    var splitLeft = splitStr[0];
    var splitRight = splitStr.length &gt; 1 ? this.sepDecimal + splitStr[1] : '';
    var regx = /(\d+)(\d{3})/;
    while (regx.test(splitLeft)) {
    splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
    }
    return this.simbol + splitLeft +splitRight;
  },
  new:function(num, simbol){
    this.simbol = simbol ||'';
    return this.formatear(num);
  }
}

$(document).ready(function(){
  // Initialize collapse button
  $('.button-collapse').sideNav({
    menuWidth: 300, // Default is 300
    edge: 'left', // Choose the horizontal origin
    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
    draggable: true, // Choose whether you can drag to open on touch screens,
    onOpen: function(el) { }, // A function to be called when sideNav is opened
    onClose: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is closed
  });

  $('.datepicker').pickadate({
    todayHighlight: true,
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    format: 'yyyy-mm-dd',
    closeOnSelect: false, // Close upon selecting a date,
    onOpen: function() { 
      //$('.datepicker').pickadate('picker').set('select', new Date(), { format: 'dd/mm/yyyy' }).trigger("change");
    }
  });

  $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'Seleccionar', // text for done-button
    cleartext: 'Limpiar', // text for clear-button
    canceltext: 'Cerrar', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });

  $('.button-collapse').sideNav();

  $('ul.tabs').tabs();

  //$('#tabla_datos_').DataTable({
  $('#table').DataTable({
    "paging":   true,
    "order": [],
    "language":{
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });

  //$("select").val('10');
  $('select').material_select();
  $('.modal').modal();
  $('.tooltipped').tooltip({delay: 50});
  /*$('#tabla_datos').tableExport({
    formats: ['xlsx'],
  });*/
});

/*$("form").submit() function () {
  alert(this);
  $('#loading').show();
});*/

$("form").submit(function(event) {
  if(this.id != 'export'){
    $('#loading').show();
  }
});