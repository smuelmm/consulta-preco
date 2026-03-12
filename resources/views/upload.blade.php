<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload TXT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"> 
    </head>
    <body class="bg-light p-4">
        <div class="container mt-5">
            <div class="card p-4 shadow-sm">
                <h3 class="mb-3">Carregar Arquivo TXT com conteúdo de MKT</h3>
                @if(session('ok'))
                    <div class="alert alert-success">{{ session('ok') }}</div>
                @endif
                <form action="/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Selecione o arquivo (.txt)</label>
                        <input type="file" name="arquivo" accept=".txt" class="form-control" required>
                    </div>
                    <button class="btn btn-primary"><i class="bi bi-filetype-txt"></i> Carregar Arquivo TXT</button>
                    <a id="btnProcessar" class="btn btn-primary" href="/executar" role="button">
                        <i class="bi bi-server"></i> Processar Carga
                    </a>
                </form>
                <script>
                    document.querySelector('form').addEventListener('submit', function() {
                        const btn = this.querySelector('button');
                        btn.disabled = true;
                        btn.innerHTML = 'Carregando... <span class="spinner-border spinner-border-sm"></span>';
                    });
                </script>
                <script>
                    document.getElementById('btnProcessar').addEventListener('click', function (e) {
                        // Impede múltiplos cliques
                        if (this.classList.contains('disabled')) {
                            e.preventDefault();
                            return;
                        }
                        // Bloqueia o botão
                        this.classList.add('disabled');
                        // Troca o texto para mostrar spinner (ampulheta)
                        this.innerHTML = 'Processando... <span class="spinner-border spinner-border-sm"></span>';
                    });
                </script>
            </div>
        </div>
    </body>
</html>
