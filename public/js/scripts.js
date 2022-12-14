/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
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

});

function sumDaysToDate(dateString, numberOfDays) {
    let tmp = dateString.split('/')
    let date = new Date(`${tmp[2]}-${tmp[1]}-${tmp[0]} 00:00:00.000`)
    let newDate = date.setDate(date.getDate() + parseInt(numberOfDays))
    newDate = new Date(newDate)
    let day = newDate.getDate()
    day = day <= 9 ? `0${day}` : `${day}`
    let month = newDate.getMonth() + 1
    month = month <= 9 ? `0${month}` : `${month}`
    let year = newDate.getFullYear()

    return `${day}/${month}/${year}`
}

jQuery(function($){
    $.datepicker.regional['pt-BR'] = {
        closeText: 'Fechar',
        prevText: '&#x3c;Anterior',
        nextText: 'Pr&oacute;ximo&#x3e;',
        currentText: 'Hoje',
        monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
        'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
        'Jul','Ago','Set','Out','Nov','Dez'],
        dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
        dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
});

$('.date').mask('00/00/0000')

function confirmDelete(itemId, formId = 'btn-delete') {

    Swal.fire({
        title: 'Aten????o',
        text: 'Deseja realmente remover o registro selecionado?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, remover!',
      }).then((result) => {
        if (result.isConfirmed) {
            $(`#${formId}-${itemId}`).submit()
        }
      })
}

function logout() {
    event.preventDefault()

    Swal.fire({
        title: 'Procapri',
        text: 'Deseja realmente sair do sistema?',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sair',
        confirmButtonColor: '#0d4b85',
    }).then(result => {

        if (! result.value) {
            return false
        }

        return $('#logout-form').submit()
    })
}

function getAddressData(input) {
    let cep = this.value

}

async function getAddress(input) {
    let cep = input.value
    cep = cep.replace(/\D/g, '')
    const regexCep = /^[0-9]{8}$/
    alert(regexCep.test(cep))
    if(regexCep.test(cep)) {
        let response = await fetch(`https://viacep.com.br/ws/${cep}/json`)
        const jsonResponse = await response.json()
        console.log(jsonResponse)
    }
}

function sAlert(text) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: text,
      })
}