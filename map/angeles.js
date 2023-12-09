maptilersdk.config.apiKey = "AvR1M1nUMgOQSUEpg5Hz";

const map = new maptilersdk.Map({
  container: "map", // container's id or the HTML element in which SDK will render the map
  // style: maptilersdk.MapStyle.OPENSTREETMAP,
  // style: maptilersdk.MapStyle.STREETS.PASTEL,
  style: maptilersdk.MapStyle.OUTDOOR,
  center: [120.588, 15.136857], // starting position [lng, lat]
  zoom: 13.5, // starting zoom
  // zoom: 16,
});

// MARKER
const marqueeTerminal = new maptilersdk.Marker({
  color: "cyan", // Marker Color
  symbol: "marker", // Marker Icon (custom image URL)
})
  .setLngLat([120.6081, 15.162422])
  .addTo(map);

const AngelesTerminal = new maptilersdk.Marker({
  color: "black", // Marker Color
  symbol: "marker", // Marker Icon (custom image URL)
})
  .setLngLat([120.588, 15.136857])
  .addTo(map);

// GEOJSON -> DIRECTION
// Dau - Marquee
map.on("load", async function () {
  map.addSource("gps_tracks", {
    type: "geojson",
    data: "Marquee_-_Angeles.geojson",
  });

  map.addLayer({
    id: "Marquee",
    type: "line",
    source: "gps_tracks",
    layout: {},
    paint: {
      "line-color": "#e11",
      "line-width": 4,
    },
  });
});
