function toggleMenu() {
    const navList = document.querySelector('.nav-list');
    navList.classList.toggle('show');
}

function confirma_excluir() {
    return confirm("Confirma Exclusão?");
}

// api mapa
// Inicializa o mapa no centro do Brasil
var map = L.map('map').setView([-14.2350, -51.9253], 5); // Centro do Brasil

// Adiciona o layer do mapa
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Função para localizar o usuário e atualizar o mapa
function locateUser() {

    if (navigator.geolocation) {
        console.log('Geolocalização suportada, tentando obter localização...');

        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            console.log('Localização obtida: ', lat, lon); // Verifica as coordenadas

            // Atualiza o mapa para a localização do usuário
            map.setView([lat, lon], 13);

            // Adiciona um marcador na localização atual
            L.marker([lat, lon]).addTo(map)
                .bindPopup('Você está aqui!')
                .openPopup();

            // Faz uma requisição à API Nominatim para obter o nome da cidade
            var geocodeUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;

            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    console.log('Dados obtidos da API: ', data); // Verifica os dados retornados

                    if (data.address) {
                        var locationName = data.address.city || data.address.town || data.address.village || "localidade desconhecida";
                        document.getElementById('location-result').innerText = `Você está em: ${locationName}`;
                    } else {
                        document.getElementById('location-result').innerText = "Não foi possível determinar a cidade.";
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar dados de geocodificação:', error);
                    document.getElementById('location-result').innerText = "Ocorreu um erro ao buscar a cidade.";
                });
        }, function(error) {
            console.error('Erro ao obter localização: ', error.message);
            document.getElementById('location-result').innerText = 'Não foi possível obter sua localização.';
        });
    } else {
        alert('Geolocalização não é suportada pelo seu navegador.');
    }
}

// Adiciona o evento de clique ao botão
document.getElementById('locate-button').onclick = locateUser;

