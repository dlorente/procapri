<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Core</div>
        <a class="nav-link @setActiveLink('Home')" href="{{ route('home') }}" onclick="setActiveAba('Dashboard')">
          <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
          Dashboard
        </a>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRebanho" aria-expanded="false" aria-controls="collapseRebanho">
          <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
          Rebanho
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseRebanho" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#rebanhoCollapseMovimentacao" aria-expanded="false" aria-controls="rebanhoCollapseMovimentacao">
              Movimentação
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="rebanhoCollapseMovimentacao" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link @setActiveMenu('animals.create')" href="{{ route('animals.create') }}">Entrada de animais</a>
                <a class="nav-link @setActiveMenu('animal-exit')" href="{{ route('animal-exit') }}">Saída de animais</a>
                <a class="nav-link @setActiveMenu('animal-change-location')" href="{{ route('animal-change-location') }}">Movimento entre instalações</a>
                <a class="nav-link @setActiveMenu('animal-weaning.index')" href="{{ route('animal-weaning.index') }}">Registro de desmame</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#rebanhoCollapseSanidade" aria-expanded="false" aria-controls="rebanhoCollapseSanidade">
              Sanidade
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="rebanhoCollapseSanidade" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link @setActiveMenu('animal-health.create')" href="{{ route('animal-health.create') }}">Animal/Doença</a>
                {{-- <a class="nav-link" href="#">Doença/Medicamento</a> --}}
                <a class="nav-link @setActiveMenu('animal-treatments.index')" href="{{ route('animal-treatments.index') }}">Ocorrências</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#rebanhoCollapseReprodutivo" aria-expanded="false" aria-controls="rebanhoCollapseReprodutivo">
              Reprodutivo
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="rebanhoCollapseReprodutivo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link @setActiveMenu('animal-heat.create')" href="{{ route('animal-heat.create') }}">Controle de coberturas</a>
                <a class="nav-link @setActiveMenu('pregnancy-diagnoses.index')" href="{{ route('pregnancy-diagnoses.index') }}">Diagnóstico de prenhes</a>
                <a class="nav-link @setActiveMenu('parturition-entries.index')" href="{{ route('parturition-entries.index') }}">Controle de Partos</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#rebanhoCollapseProdutivo" aria-expanded="false" aria-controls="rebanhoCollapseProdutivo">
              Produtivo
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="rebanhoCollapseProdutivo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link @setActiveMenu('weight-controls.index')" href="{{ route('weight-controls.index') }}">Controle ponderal</a>
                <a class="nav-link @setActiveMenu('dairy-controls.index')" href="{{ route('dairy-controls.index') }}">Controle leiteiro</a>
                <a class="nav-link @setActiveMenu('dryoff-controls.index')" href="{{ route('dryoff-controls.index') }}">Encerrar lactação</a>
              </nav>
            </div>
          </nav>
        </div>
        
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Manutenção
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @setActiveMenu('animal-registrations.index')" href="{{ route('animal-registrations.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de animais
              </a>
              <a class="nav-link @setActiveMenu('animal-heat.index')" href="{{ route('animal-heat.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de cios
              </a>
              <a class="nav-link @setActiveMenu('animal-birth.index')" href="{{ route('animal-birth.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de partos
              </a>
              <a class="nav-link @setActiveMenu('animal-weight.index')" href="{{ route('animal-weight.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de pesagens
              </a>
              <a class="nav-link @setActiveMenu('animal-milk.index')" href="{{ route('animal-milk.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de produção de leite
              </a>
              <a class="nav-link @setActiveMenu('lote.index')" href="{{ route('lote.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de lotes
              </a>
              <a class="nav-link @setActiveMenu('local.index')" href="{{ route('local.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de locais
              </a>
              <a class="nav-link @setActiveMenu('animal-treatments.index')" href="{{ route('animal-treatments.index') }}" onclick="setActiveAba('Manutenção')">
                Cadastro de ocorrências diversas
              </a>
            </nav>
        </div>
        
      </div>
    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Logged in as:</div>
      {{ auth()->user()->farmer->crnome }}
    </div>
  </nav>
</div>