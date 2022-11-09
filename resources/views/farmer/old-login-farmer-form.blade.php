<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
                            <div class="col-lg-12">
                                <form action="{{ route('old-login.farmer') }}" method="POST">
                                    @csrf
                                    <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                        <div class="card-header">
                                            <h3 class="text-center font-weight-light my-4">Procapri</h3>
                                        </div>
                                        <div class="card-body">                                        
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crcodigo" class="form-label">Código do criador</label>
                                                        <input type="text" class="form-control @error('crcodigo') is-invalid @enderror" name="crcodigo" id="crcodigo" value="{{ old('crcodigo', $farmer->crcodigo ?? null) }}">
                                                        @error('crcodigo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crnome" class="form-label">Nome do criador</label>
                                                        <input type="text" class="form-control @error('crnome') is-invalid @enderror" name="crnome" id="crnome" value="{{ old('crnome', $farmer->crnome ?? null) }}">
                                                        @error('crnome')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crfazenda" class="form-label">Nome da fazenda</label>
                                                        <input type="text" class="form-control @error('crfazenda') is-invalid @enderror" name="crfazenda" id="crfazenda" value="{{ old('crfazenda', $farmer->crfazenda ?? null) }}">
                                                        @error('crfazenda')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crprop" class="form-label">Nome da propriedade</label>
                                                        <input type="text" class="form-control @error('crprop') is-invalid @enderror" name="crprop" id="crprop" value="{{ old('crprop', $farmer->crprop ?? null) }}">
                                                        @error('crprop')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crcep1" class="form-label">CEP</label>
                                                        <input type="text" class="form-control @error('crcep1') is-invalid @enderror" name="crcep1" id="crcep1" value="{{ old('crcep1', $farmer->crcep1 ?? null) }}">
                                                        @error('crcep1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crendereco" class="form-label">Endereço da propriedade</label>
                                                        <input type="text" class="form-control @error('crendereco') is-invalid @enderror" name="crendereco" id="crendereco" value="{{ old('crendereco', $farmer->crendereco ?? null) }}">
                                                        @error('crendereco')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                                                
                                                <div class="col-md-5 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crmunic" class="form-label">Município</label>
                                                        <input type="text" class="form-control @error('crmunic') is-invalid @enderror" name="crmunic" id="crmunic" value="{{ old('crmunic', $farmer->crmunic ?? null) }}">
                                                        @error('crmunic')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crestado" class="form-label">Estado</label>
                                                        <select class="form-select @error('crestado') is-invalid @enderror" name="crestado" id="crestado">
                                                            <option value="">-Selecione-</option>
                                                            @foreach ($states as $state)
                                                                <option 
                                                                    {{ set_selected(old('crestado'), $state->uf) }}
                                                                    value="{{ $state->uf }}">{{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('crestado')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crpostal" class="form-label">Caixa postal</label>
                                                        <input type="text" class="form-control @error('crpostal') is-invalid @enderror" name="crpostal" id="crpostal" value="{{ old('crpostal', $farmer->crpostal ?? null) }}">
                                                        @error('crpostal')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crfonef" class="form-label">Telefone</label>
                                                        <input type="text" class="form-control @error('crfonef') is-invalid @enderror" name="crfonef" id="crfonef" value="{{ old('crfonef', $farmer->crfonef ?? null) }}">
                                                        @error('crfonef')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crcepc1" class="form-label">CEP de correspondência</label>
                                                        <input type="text" class="form-control @error('crcepc1') is-invalid @enderror" name="crcepc1" id="crcepc1" value="{{ old('crcepc1', $farmer->crcepc1 ?? null) }}">
                                                        @error('crcepc1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-xs-12">
                                                    <div class="mb-3">
                                                        <label for="crcorrespc" class="form-label">Endereço de correspondência</label>
                                                        <input type="text" class="form-control @error('crcorrespc') is-invalid @enderror" name="crcorrespc" id="crcorrespc" value="{{ old('crcorrespc', $farmer->crcorrespc ?? null) }}">
                                                        @error('crcorrespc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="crbairroc" class="form-label">Bairro de correspondência</label>
                                                        <input type="text" class="form-control @error('crbairroc') is-invalid @enderror" name="crbairroc" id="crbairroc" value="{{ old('crbairroc', $farmer->crbairroc ?? null) }}">
                                                        @error('crbairroc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="crcidadec" class="form-label">Cidade de correspondência</label>
                                                        <input type="text" class="form-control @error('crcidadec') is-invalid @enderror" name="crcidadec" id="crcidadec" value="{{ old('crcidadec', $farmer->crcidadec ?? null) }}">
                                                        @error('crcidadec')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="crestadoc" class="form-label">Estado de correspondência</label>
                                                        <select class="form-select @error('crestadoc') is-invalid @enderror" name="crestadoc" id="crestadoc">
                                                            <option value="">-Selecione-</option>
                                                            @foreach ($states as $state)
                                                                <option 
                                                                    {{ set_selected(old('crestadoc'), $state->uf) }}
                                                                    value="{{ $state->uf }}">{{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('crestadoc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="crpostalc" class="form-label">Caixa postal de correspondência</label>
                                                        <input type="text" class="form-control @error('crpostalc') is-invalid @enderror" name="crpostalc" id="crpostalc" value="{{ old('crpostalc', $farmer->crpostalc ?? null) }}">
                                                        @error('crpostalc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="crfaxc" class="form-label">Telefone de correspondência</label>
                                                        <input type="text" class="form-control @error('crfonec') is-invalid @enderror" name="crfonec" id="crfonec" value="{{ old('crfonec', $farmer->crfonec ?? null) }}">
                                                        @error('crfonec')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="crfaxc" class="form-label">Fax de correspondência</label>
                                                        <input type="text" class="form-control @error('crfaxc') is-invalid @enderror" name="crfaxc" id="crfaxc" value="{{ old('crfaxc', $farmer->crfaxc ?? null) }}">
                                                        @error('crfaxc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2022</div>
                            <div>
                                <a href="#">Política de Privacidade</a>
                                &middot;
                                <a href="#">Termos &amp; Condições</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
			  crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="{{ asset('js/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script>
            document.getElementById('crcep1').addEventListener('blur', async () => {
                let cep = event.target.value                
                const regexCep = /^[0-9]{5}[0-9]{3}$/
                cep = cep.replace(/[^\d]/g, '')
                if(regexCep.test(cep)) {
                    let response = await fetch(`https://viacep.com.br/ws/${cep}/json`)
                    const data = await response.json()
                    document.getElementById('crendereco').value = data.logradouro
                    document.getElementById('crcep1').value = data.cep
                    document.getElementById('crmunic').value = data.localidade
                    document.getElementById('crestado').value = data.uf
                } else {
                    sAlert('Cep inválido')
                }
            })

            document.getElementById('crcepc1').addEventListener('blur', async () => {
                let cep = event.target.value                
                const regexCep = /^[0-9]{5}[0-9]{3}$/
                cep = cep.replace(/[^\d]/g, '')
                if(regexCep.test(cep)) {
                    let response = await fetch(`https://viacep.com.br/ws/${cep}/json`)
                    const data = await response.json()
                    document.getElementById('crcepc1').value = data.cep
                    document.getElementById('crcorrespc').value = data.logradouro
                    document.getElementById('crcidadec').value = data.localidade
                    document.getElementById('crestadoc').value = data.uf
                } else {
                    sAlert('Cep inválido')
                }
            })
        </script>
    </body>
</html>