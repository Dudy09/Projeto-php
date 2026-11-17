const area = document.getElementById('drop-area');
const arquivo = document.getElementById('fileInput');
const texto = document.getElementById('drop-text');
const imagemPrevia = document.getElementById('imagem-previa');
let urlPrevia = null;

function mostrarPrevia(arquivoSelecionado) {
    if (!arquivoSelecionado) return;

    texto.textContent = arquivoSelecionado.name;
    if (!arquivoSelecionado.type.startsWith('image/')) return;

    if (urlPrevia) URL.revokeObjectURL(urlPrevia);
    urlPrevia = URL.createObjectURL(arquivoSelecionado);
    imagemPrevia.src = urlPrevia;
}

function configurarDropArea() {
    arquivo.addEventListener('change', () => mostrarPrevia(arquivo.files[0]));
    area.addEventListener('dragover', (evento) => {
        evento.preventDefault();
        area.classList.add('highlight');
    });
    area.addEventListener('dragleave', () => area.classList.remove('highlight'));
    area.addEventListener('drop', (evento) => {
        evento.preventDefault();
        area.classList.remove('highlight');
        arquivo.files = evento.dataTransfer.files;
        mostrarPrevia(arquivo.files[0]);
    });
}

configurarDropArea();
