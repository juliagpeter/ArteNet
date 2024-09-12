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
document.getElementById('locate-button').onclick = function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // URL da API Nominatim para reverse geocoding
            var geocodeUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;

            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.address && data.address.city) {
                        document.getElementById('location-result').innerText = `Você está em: ${data.address.city}`;
                    } else if (data.address && data.address.town) {
                        document.getElementById('location-result').innerText = `Você está em: ${data.address.town}`;
                    } else if (data.address && data.address.village) {
                        document.getElementById('location-result').innerText = `Você está em: ${data.address.village}`;
                    } else {
                        document.getElementById('location-result').innerText = "Não foi possível determinar a cidade.";
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar dados de geocodificação:', error);
                    document.getElementById('location-result').innerText = "Ocorreu um erro ao buscar a cidade.";
                });
        }, function() {
            alert('Não foi possível obter sua localização.');
        });
    } else {
        alert('Geolocalização não é suportada pelo seu navegador.');
    }
};