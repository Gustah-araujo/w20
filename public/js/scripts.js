/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    //
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    const datatablesSimple = document.getElementById('datatable');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Procurar...",
                searchTitle: "Procurar dentro da tabela",
                pageTitle: "Página {page}",
                perPage: "resultados por página",
                noRows: "Nenhum resultado encontrado",
                info: "Mostrando resultados de {start} a {end}, de {rows} resultados",
                noResults: "Nenhum resultado encontrado",
            }
        });
    }

    $(".select-search").select2({
        theme: "bootstrap-5"
    });

    VMasker(document.querySelector(".date")).maskPattern("99/99/9999");

    VMasker(document.querySelector(".currency")).maskMoney({
        // Decimal precision -> "90"
        precision: 2,
        // Decimal separator -> ",90"
        separator: ',',
        // Number delimiter -> "12.345.678"
        delimiter: '.',
        // Money unit -> "R$ 12.345.678,90"
        unit: 'R$',
        // Money unit -> "12.345.678,90 R$"
        // suffixUnit: 'R$',
        // Force type only number instead decimal,
        // masking decimals with ",00"
        // Zero cents -> "R$ 1.234.567.890,00"
        zeroCents: false
    });

});
