function toggleMenu() {
    const navList = document.querySelector('.nav-list');
    navList.classList.toggle('show');
}

function confirma_excluir() {
    return confirm("Confirma Exclusão?");
}

// api mapa

// Inicializar o mapa na coordenada central e no nível de zoom desejado
var map = L.map('map').setView([-23.5505, -46.6333], 13); // São Paulo como exemplo

// Adicionar o layer do mapa
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Função para obter a localização atual do usuário
function locateUser() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // Atualizar a posição do mapa para a localização atual do usuário
            map.setView([lat, lon], 13);

            // Adicionar um marcador na localização atual
            var marker = L.marker([lat, lon]).addTo(map)
                .bindPopup('Você está aqui!')
                .openPopup();
        }, function() {
            alert('Não foi possível obter sua localização.');
        });
    } else {
        alert('Geolocalização não é suportada pelo seu navegador.');
    }
}

// Adicionar evento de clique ao botão
document.getElementById('locate-button').addEventListener('click', locateUser);
