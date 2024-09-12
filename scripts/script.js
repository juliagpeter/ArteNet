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

// api mapa

// Inicializar o mapa centrado em Pelotas, RS
var map = L.map('map').setView([-31.7654, -52.3376], 13);

// Adicionar o layer do mapa
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Função para obter a localização atual do usuário
function locateUser() {
    console.log('Tentando obter localização...');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            console.log('Localização obtida com sucesso!');
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // Atualizar a posição do mapa para a localização atual do usuário
            map.setView([lat, lon], 13);

            // Adicionar um marcador na localização atual
            var marker = L.marker([lat, lon]).addTo(map)
                .bindPopup('Você está aqui!')
                .openPopup();
        }, function(error) {
            console.error('Erro ao obter localização: ', error.message);
            alert('Não foi possível obter sua localização: ' + error.message);
        });
    } else {
        alert('Geolocalização não é suportada pelo seu navegador.');
    }
}

// Adicionar evento de clique ao botão
document.getElementById('locate-button').addEventListener('click', locateUser);