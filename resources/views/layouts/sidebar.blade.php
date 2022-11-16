<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link @setActiveLink('Home')" href="{{ route('home') }}" onclick="setActiveAba('Dashboard')">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Rebanho</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" onclick="setActiveAba('Movimentação')" data-bs-target="#collapseRebanho" aria-expanded="false" aria-controls="collapseRebanho">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Movimentação
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse @setActiveAba('Movimentação')" id="collapseRebanho" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @setActiveMenu('animals.index')" href="{{ route('animals.index') }}">Entrada de animais</a>
                        <a class="nav-link @setActiveMenu('animal-exit')" href="{{ route('animal-exit') }}">Saída de animais</a>
                        <a class="nav-link @setActiveMenu('animal-change-location')" href="{{ route('animal-change-location') }}">Movimento entre instalações</a>
                        <a class="nav-link @setActiveMenu('animal-weaning.index')" href="{{ route('animal-weaning.index') }}">Registro de desmame</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" onclick="setActiveAba('Sanidade')" data-bs-target="#collapseSanidade" aria-expanded="false" aria-controls="collapseSanidade">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Sanidade
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse @setActiveAba('Sanidade')" id="collapseSanidade" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @setActiveMenu('animal-health.index')" href="{{ route('animal-health.index') }}">Animal/Doença</a>
                        {{-- <a class="nav-link" href="#">Doença/Medicamento</a> --}}
                        <a class="nav-link @setActiveMenu('animal-treatments.index')" href="{{ route('animal-treatments.index') }}">Ocorrências</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" onclick="setActiveAba('Reprodutivo')" data-bs-target="#collapseReprodutivo" aria-expanded="false" aria-controls="collapseReprodutivo">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Reprodutivo
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse @setActiveAba('Reprodutivo')" id="collapseReprodutivo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @setActiveMenu('animal-heat.index')" href="{{ route('animal-heat.index') }}">Controle de coberturas</a>
                        <a class="nav-link @setActiveMenu('pregnancy-diagnoses.index')" href="{{ route('pregnancy-diagnoses.index') }}">Diagnóstico de prenhes</a>
                        <a class="nav-link @setActiveMenu('parturition-entries.index')" href="{{ route('parturition-entries.index') }}">Controle de Partos</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" onclick="setActiveAba('Produtivo')" data-bs-target="#collapseProdutivo" aria-expanded="false" aria-controls="collapseProdutivo">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Produtivo
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse @setActiveAba('Produtivo')" id="collapseProdutivo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @setActiveMenu('weight-controls.index')" href="{{ route('weight-controls.index') }}">Controle ponderal</a>
                        <a class="nav-link @setActiveMenu('dairy-controls.index')" href="{{ route('dairy-controls.index') }}">Controle leiteiro</a>
                        <a class="nav-link @setActiveMenu('dryoff-controls.index')" href="{{ route('dryoff-controls.index') }}">Encerrar lactação</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Manutenção</div>
                <a class="nav-link" href="charts.html" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Cadastro de animais
                </a>
                <a class="nav-link @setActiveMenu('animal-heat.index')" href="{{ route('animal-heat.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de cios
                </a>
                <a class="nav-link @setActiveMenu('animal-birth.index')" href="{{ route('animal-birth.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de partos
                </a>
                <a class="nav-link @setActiveMenu('animal-weight.index')" href="{{ route('animal-weight.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de pesagens
                </a>
                <a class="nav-link @setActiveMenu('animal-milk.index')" href="{{ route('animal-milk.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de produção de leite
                </a>
                <a class="nav-link @setActiveMenu('lote.index')" href="{{ route('lote.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de lotes
                </a>
                <a class="nav-link @setActiveMenu('local.index')" href="{{ route('local.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de locais
                </a>
                <a class="nav-link @setActiveMenu('animal-treatments.index')" href="{{ route('animal-treatments.index') }}" onclick="setActiveAba('Manutenção')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Cadastro de ocorrências diversas
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->farmer->crnome }}
        </div>
    </nav>
</div>