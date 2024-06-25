document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([38.9637, 35.2433], 6); // Türkiye'nin merkez koordinatları
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Veritabanından alınan konum bilgilerini içeren bir dizi
    var locations = [
        { id: 1, lat: 41.0082, lng: 28.9784, name: "İstanbul" },
        { id: 2, lat: 39.9208, lng: 32.8541, name: "Ankara" },
        { id: 3, lat: 38.4237, lng: 27.1428, name: "İzmir" },
        // Diğer konumlar burada yer alabilir
    ];

    var currentLocation;

    function showRandomLocation() {
        // Rastgele bir konum seç
        var randomIndex = Math.floor(Math.random() * locations.length);
        currentLocation = locations[randomIndex];

        // Önceki marker'ı kaldır
        if (typeof marker !== 'undefined') {
            map.removeLayer(marker);
        }

        // Seçilen konumu haritada göster
        marker = L.marker([currentLocation.lat, currentLocation.lng]).addTo(map)
            .bindPopup("Bu konum neresi?")
            .openPopup();

        // Formdaki gizli alanları doldur
        document.getElementById('actual_location').value = currentLocation.name;
        document.getElementById('location_id').value = currentLocation.id;
    }

    // İlk konumu göster
    showRandomLocation();

    document.getElementById('guess-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var userGuess = document.getElementById('location_name').value;
        var actualLocation = document.getElementById('actual_location').value;

        // Kullanıcı tahminini kontrol et
        if (userGuess.toLowerCase() === actualLocation.toLowerCase()) {
            alert("Tebrikler, doğru tahmin! 10 puan kazandınız.");
            showRandomLocation(); // Yeni konumu göster
        } else {
            alert("Üzgünüz, yanlış tahmin. Doğru cevap: " + actualLocation);
        }

        // Formu temizle
        document.getElementById('location_name').value = '';
    });

    map.on('click', function(e) {
        var popup = L.popup()
            .setLatLng(e.latlng)
            .setContent("Konum: " + e.latlng.toString())
            .openOn(map);
    });
});
