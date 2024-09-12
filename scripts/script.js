function obterLocalizacao() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (posicao) {
                var latitude = posicao.coords.latitude;
                var longitude = posicao.coords.longitude;

                // Chama a função para obter o nome da cidade
                obterCidade(latitude, longitude);
            },
            function (erro) {
                console.log("Erro ao obter localização:", erro);
                document.getElementById("resultado").innerHTML =
                    "Erro ao obter localização: " + erro.message;
            }
        );
    } else {
        document.getElementById("resultado").innerHTML =
            "Geolocation não é suportado neste navegador.";
    }
}

function obterCidade(latitude, longitude) {
    var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&addressdetails=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data.address) {
                var cidade = data.address.city || data.address.town || data.address.village;
                document.getElementById("resultado").innerHTML += "<br>Cidade: " + (cidade || "Cidade não encontrada");
            } else {
                document.getElementById("resultado").innerHTML += "<br>Cidade não encontrada";
            }
        })
        .catch(error => {
            console.log("Erro na geocodificação reversa:", error);
            document.getElementById("resultado").innerHTML += "<br>Erro ao obter a cidade";
        });
}

function toggleMenu() {
    const navList = document.querySelector('.nav-list');
    navList.classList.toggle('show');
}

function confirma_excluir() {
    return confirm("Confirma Exclusão?");
}