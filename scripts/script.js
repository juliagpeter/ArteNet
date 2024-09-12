function toggleMenu() {
    const navList = document.querySelector('.nav-list');
    navList.classList.toggle('show');
}

function confirma_excluir() {
    return confirm("Confirma Exclusão?");
}

// api mapa

function getLocation() {
    console.log('Botão clicado'); // Para verificar se o botão foi clicado

    if (navigator.geolocation) {
        console.log('Geolocalização suportada, tentando obter localização...');

        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            console.log('Localização obtida: ', lat, lon); // Para verificar as coordenadas

            // URL da API Nominatim para reverse geocoding
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
            alert('Não foi possível obter sua localização.');
        });
    } else {
        alert('Geolocalização não é suportada pelo seu navegador.');
    }
}
